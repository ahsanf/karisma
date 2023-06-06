<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use App\Models\Financial;
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
        $token = env('WHATSAPP_TOKEN');
        if($request->hub_mode == 'subsribe' &&  $request->hub_verify_token == $token){
            return response()->json($request->hub_challenge);
        }
        return response()->json('Error, wrong validation token', 400);
    }

    public function postWebhook(Request $request)
    {
        try {
            return response()->json('Incoming webhook: '.$request->body() , 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 400);
        }

    }
}
