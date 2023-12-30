<?php

namespace App\Models;

use App\Helper\DateHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    use HasFactory;

    const EVENT_TYPE_ALL_MEMBER = 1;
    const EVENT_TYPE_MEMBER = 0;
    protected $table = 'events';

    protected $fillable = [
        'event_name',
        'event_date',
        'event_start',
        'event_place',
        'event_day',
        'event_end',
        'event_description',
        'event_type',
        'event_note',
        'zip_path'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function note(){
        return $this->hasOne(Note::class, 'event_id');
    }
    public function members()
    {
        return $this->belongsToMany(Member::class, 'event_member', 'event_id', 'member_id')
        ->withPivot('presence', 'status','image_path');
    }

    public function notification()
    {
        return $this->hasOne(Notification::class, 'event_id');
    }
    public function dateString($date)
    {
        $day_name = DateHelper::getDayName($date);
        $date_string = DateHelper::getDateString($date);
        return $day_name . ', ' . $date_string;
    }

    public static function getFilePath()
    {
        return public_path().Storage::url('public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'event');
    }
    public static function getUploadPath()
    {
        return DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'event';
    }
}
