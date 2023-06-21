<?php

namespace App\Http\Controllers;

use App\Helper\DateHelper;
use App\Helper\LayoutHelper as Layout;
use App\Helper\RedirectHelper as R;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Member;
use App\Models\Tag;
use App\Notifications\MemberInvitation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EventWebController extends Controller
{

    public function index()
    {
        $data['action']      = ['table_datatable_basic', 'uc_select2'];
        $data['page_title']  = 'Semua Acara';
        $data['card_title']  = 'Acara';
        $data['events']      = [];
        $events              = Event::with('notification','members')->withCount('members')->get();
        $data['breadcrumbs'] = Layout::setBreadcrumbs([['name' => 'Acara'], ['name' => 'Daftar Acara']]);

        foreach($events as $event){
            $event['member_present'] = 0;
            $event['member_not_present'] = 0;
            $event['member_no_answer'] = 0;
            $event['date_string'] = $event->dateString($event['event_date']);
            foreach($event['members'] as $member){
                if($member->pivot->presence == 1){
                    $event['member_present'] = $event['member_presence']+1;
                }
                if($member->pivot->presence == 0){
                    $event['member_not_present'] = $event['member_not_presence']+1;
                }
                if($member->pivot->presence == 2){
                    $event['member_no_answer'] = $event['member_no_answer']+1;
                }
            }
            $data['events'][] = $event->toArray();
        }
        return view('admin.event.index', compact('data'));
    }


    public function create()
    {
        $data['action']         = ['form_wizard', 'form_pickers','uc_select2'];
        $data['page_title']     = 'Tambah Acara';
        $data['card_title']     = 'Acara';
        $data['breadcrumbs']    = Layout::setBreadcrumbs([['name' => 'Acara'], ['name' => 'Tambah Acara']]);
        $data['members']        = Member::get();
        $data['tags']           = Tag::get();
        return view('admin.event.create', compact('data'));

    }

    public function store(EventRequest $request)
    {
        try {
            $data = $request->validated();
            $data['event_day'] = DateHelper::getDayName($request->event_date);

            $event = Event::create($data);

            if($request->event_type == Event::EVENT_TYPE_MEMBER){
                if ($request->has('member_id')) {
                    foreach($request->member_id as $member){
                        $event->members()->attach($member);
                    }
                }
            }
            return R::redirectRouteStatus('admin.event.index','success','Event berhasil ditambahkan');
        } catch (\Throwable $th) {
            return R::redirectBackStatus('error',$th->getMessage());
        }


    }


    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->members()->detach();
        $event->notification()->delete();
        $event->delete();

        return R::redirectBackStatus('success','Event berhasil dihapus');
    }

    public function publish(Event $event)
    {
        //example
        // $data["phone_number"]= "6281359888622"; $data["member_name"]= "Amin"; $data["day_name"]= "Selasa"; $data["day_month_year"]= "20 Juni 2023"; $data["start_date"]= "19=00"; $data["end_date"]= "21=00 WIB"; $data["place"]= "Rumah Bapak Amin"; $data["event_name"]= "Rapat Perobohan Rumah"; $data["notes"]= "Harap membawa iuran minimal Rp. 2000"; $data["btn_link"]= "eyJpdiI6ImZENW50bTNhQ29ycWMrRGd0OWNDNlE9PSIsInZhbHVlIjoiUDc1dzFjNVlMbENGYlI2R0xGT2N4QT09IiwibWFjIjoiNDViMjJlOWM5OGY0NGEzNjg0NzBhZTBiZjU0MGExYmY3ZGI3ZGFkZWNkM2QwNjE0MzFiMmIwMTE5NjNiMDBkOCIsInRhZyI6IiJ9"
        try {
            if($event->event_type == Event::EVENT_TYPE_ALL_MEMBER){
                $members = Member::get();

                foreach($members as $member){
                    $data['phone_number']     = $member->member_phone;
                    $data['member_name']      = $member->member_name;
                    $data['day_name']         = $event->event_day;
                    $data['day_month_year']   = DateHelper::getDateString($event->event_date);
                    $data['start_date']       = DateHelper::formatTime($event->event_start);
                    $data['end_date']         = DateHelper::formatTime($event->event_end). ' WIB';
                    $data['place']            = $event->event_place;
                    $data['event_name']       = $event->event_name;
                    $data['notes']            = 'Harap membawa iuran minimal Rp. 2000';
                    $data['btn_link']         = Crypt::encryptString($member->id.':'.$event->id);

                    $member->notify(new MemberInvitation($data));
                }

                $event->notification()->create([
                    'status' => 0
                ]);
            } else if ($event->event_type == Event::EVENT_TYPE_MEMBER){
                $members = $event->members;

                foreach($members as $member){
                    $data['phone_number']     = $member->member_phone;
                    $data['member_name']      = $member->member_name;
                    $data['day_name']         = $event->event_day;
                    $data['day_month_year']   = DateHelper::getDateString($event->event_date);
                    $data['start_date']       = DateHelper::formatTime($event->event_start);
                    $data['end_date']         = DateHelper::formatTime($event->event_end). ' WIB';
                    $data['place']            = $event->event_place;
                    $data['event_name']       = $event->event_name;
                    $data['notes']            = 'Harap membawa iuran minimal Rp. 2000';
                    $data['btn_link']         = Crypt::encryptString($member->id.':'.$event->id);

                    $member->notify(new MemberInvitation($data));
                }

                $event->notification()->create([
                    'status' => 0
                ]);
            }

            return R::redirectBackStatus('success','Undangan berhasil dikirim');
        } catch (\Throwable $th) {
            return R::redirectBackStatus('error',$th->getMessage());
        }

    }

}
