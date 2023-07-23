<?php

namespace App\Http\Controllers\Misc;

use App\Helper\DateHelper;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Financial;
use App\Models\Member;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MiscWebController extends Controller
{
    public function getMemberByTag($tag_id)
    {
        $tag = Tag::find($tag_id);
        $members = $tag->members;

        return response()->json($members);
    }

    public function getImage($finance_id)
    {
        $financial = Financial::findOrFail(Crypt::decryptString($finance_id));
        $path = $financial->file_path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        return response()->json(['data' => $base64]);
    }

    public function getWebhook(Request $request)
    {
        $token = env('VERIFY_TOKEN');
        $data['hub_mode'] = $request->hub_mode;
        $data['hub_verify_token'] = $request->hub_verify_token;
        $data['hub_challenge'] = $request->hub_challenge;

        if($data['hub_verify_token'] == $token){
            return response()->json($data['hub_challenge']);
        } else {
            return response()->json('Error, wrong validation token', 400);
        }

    }

    public function postWebhook(Request $request)
    {
        try {
            return response()->json('Incoming webhook: '.$request->body() , 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 400);
        }

    }

    public function invitation($key)
    {
        $data['action'] = ['dashboard_1'];
        $data['page_title'] = 'Konfirmasi Kehadiran';
        $data['key'] = $key;
        $decrypt     = $this->decryptKey($key);
        $data['event'] = Event::find($decrypt['event_id']);
        $data['member'] = Member::find($decrypt['member_id']);
        $data['date_string'] = DateHelper::getDateString($data['event']->date);
        $data['presence_status'] = $data['member']->events()->where('member_id', $decrypt['member_id'])->where('event_id', $decrypt['event_id'])->first()->pivot->status;

        return view('invitation.index', compact('data'));
    }

    public function storeInvitation(Request $request, $key)
    {
        try {
            $data['action'] = ['dashboard_1'];
            $data['page_title'] = 'Konfirmasi Kehadiran';
            $decrypt     = $this->decryptKey($key);
            $event       = Event::find($decrypt['event_id']);
            $event->members()->updateExistingPivot($decrypt['member_id'], [
                'presence' => $request->presence,
                'status' => 1
            ]);

            return view('invitation.success', compact('data'));
        } catch (\Throwable $th) {
            return view('invitation.success', compact('data'));
        }

    }

    public function decryptKey($key)
    {
        //KEY = member_id:event_id
        $decrypt_key         = Crypt::decryptString($key);
        $data_decrypt        = explode(':', $decrypt_key);
        $data['member_id']   = $data_decrypt[0];
        $data['event_id']    = $data_decrypt[1];

        return $data;

    }

    public function getMemberByEvent($event_id)
    {
        $event = Event::find($event_id);
        $members = $event->members->pluck('id');

        return response()->json($members);
    }

    public function getTagByMembers($member_id)
    {
        $members = Member::whereIn('id', $member_id)->with('tag')->get()->toArray();
        $tags = [];
        foreach($members as $member){
            foreach($member['tag'] as $tag){
                $tags[] = $tag['id'];
            }
        }


        return response()->json(array_unique($tags));
    }


}
