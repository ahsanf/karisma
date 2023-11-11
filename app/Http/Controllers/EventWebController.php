<?php

namespace App\Http\Controllers;

use App\Helper\DateHelper;
use App\Helper\FileHelper;
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
use Spatie\Browsershot\Browsershot;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf as PdfToImage;
use Illuminate\Support\Str;

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
        $data['action']         = ['form_wizard', 'form_pickers','uc_select2'];
        $data['page_title']     = 'Edit Acara';
        $data['card_title']     = 'Acara';
        $data['breadcrumbs']    = Layout::setBreadcrumbs([['name' => 'Acara'], ['name' => 'Edit Acara']]);
        $data['members']        = Member::get();
        $data['tags']           = Tag::get();
        $data['event']          = $event;
        return view('admin.event.edit', compact('data'));
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
        try {
            if($event->event_type == Event::EVENT_TYPE_ALL_MEMBER){
                $members = Member::get();
                $path = Event::getFilePath().DIRECTORY_SEPARATOR.
                        'invitation'.DIRECTORY_SEPARATOR.
                        Str::uuid();

                if(!is_dir($path)){
                    mkdir($path, 0777, true);
                }

                foreach($members as $member){
                    $data['phone_number']     = $member->member_phone;
                    $data['member_name']      = $member->member_shortname ?? $member->member_name;
                    $data['day_name']         = $event->event_day;
                    $data['day_month_year']   = DateHelper::getDateString($event->event_date);
                    $data['start_date']       = DateHelper::formatTime($event->event_start);
                    $data['end_date']         = DateHelper::formatTime($event->event_end). ' WIB';
                    $data['place']            = $event->event_place;
                    $data['event_name']       = $event->event_name;
                    $data['notes']            = $event->event_note ?? 'Harap membawa iuran minimal Rp. 2000';
                    $data['btn_link']         = Crypt::encryptString($member->id.':'.$event->event_name);
                    $fileName                 = Str::uuid();
                    $generatedPdf             = $this->generatePdf($data, $path, $fileName);
                    $generatedImage           = $this->generateImage($generatedPdf, $path, $fileName);
                    unlink($generatedPdf);
                    $member->events()->sync([
                        $event->id => [
                            'image_path' => $this->mappingPath($generatedImage),
                            'member_id'=> $member->id
                        ]
                    ]);
                }

                $event->notification()->create([
                    'status' => 0
                ]);
            } elseif ($event->event_type == Event::EVENT_TYPE_MEMBER){
                $members = $event->members;
                $path = Event::getFilePath().DIRECTORY_SEPARATOR.
                        'invitation'.DIRECTORY_SEPARATOR.
                        Str::uuid();

                foreach($members as $member){
                    $data['phone_number']     = $member->member_phone;
                    $data['member_name']      = $member->member_shortname ?? $member->member_name;
                    $data['day_name']         = $event->event_day;
                    $data['day_month_year']   = DateHelper::getDateString($event->event_date);
                    $data['start_date']       = DateHelper::formatTime($event->event_start);
                    $data['end_date']         = DateHelper::formatTime($event->event_end). ' WIB';
                    $data['place']            = $event->event_place;
                    $data['event_name']       = $event->event_name;
                    $data['notes']            = $event->event_note ?? 'Harap membawa iuran minimal Rp. 2000';
                    $data['btn_link']         = Crypt::encryptString($member->id.':'.$event->id);
                    $fileName                 = Str::uuid();
                    $generatedPdf             = $this->generatePdf($data, $path, $fileName);
                    $generatedImage           = $this->generateImage($generatedPdf, $path, $fileName);
                    unlink($generatedPdf);

                    $member->events()->sync([
                        $event->id => [
                            'image_path' => $this->mappingPath($generatedImage),
                            'member_id'=> $member->id
                        ]
                    ]);
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

    public function generatePdf(array $data, string $path, string $fileName): string {
        $pdf = Pdf::loadView('admin.template.invitation', ['data' => $data ])->setPaper('a4', 'potrait');
        $fullPath = $path.DIRECTORY_SEPARATOR.$fileName.'.pdf';
        $pdf->save($fullPath);

        return $fullPath;
    }

    public function generateImage(string $pdfFullPath, string $targetPath,string $fileName): string {
        $fullPath = $targetPath.DIRECTORY_SEPARATOR.$fileName.'.jpg';
        $pdf = new PdfToImage($pdfFullPath);
        $pdf->saveImage($fullPath);

        return $fullPath;
    }
    public function deleteInvitation(Event $event){
        foreach($event->members as $member){
            $this->deleteImage($member->pivot->image_path);
            $member->events()->sync([
                $event->id => [
                    'image_path' => null,
                    'member_id'=> $member->id
                ]
            ]);
        }
    }


    public function deleteImage(string | null $imagePath){
        if($imagePath == null){
            return;
        }
        $path = public_path().Storage::url('public' . DIRECTORY_SEPARATOR . 'uploads');
        $imagePath = $path.$imagePath;
     
        if(file_exists($imagePath)){
            unlink($imagePath);
        }
    }


    public function mappingPath($path): string
    {
        return explode("/uploads",$path)[1];
    }
}

