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

class EventWebController extends Controller
{

    public function index()
    {
        $data['action']      = ['table_datatable_basic', 'uc_select2'];
        $data['page_title']  = 'Semua Acara';
        $data['card_title']  = 'Acara';
        $data['events']      = Event::with('notification')->get();
        $data['breadcrumbs'] = Layout::setBreadcrumbs([['name' => 'Acara'], ['name' => 'Daftar Acara']]);

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

            if(!$request->event_type == Event::EVENT_TYPE_MEMBER){
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
    public function destroy(Event $event)
    {
        $event->members()->detach();
        $event->delete();

        return R::redirectBackStatus('success','Event berhasil dihapus');
    }

    public function publish(Event $event)
    {
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
