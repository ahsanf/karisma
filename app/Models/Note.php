<?php

namespace App\Models;

use App\Helper\DateHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;


    protected $fillable = [
        'event_id',
        'note_title',
        'note_date',
        'note_content',
        'status'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function dateString($date)
    {
        $day_name = DateHelper::getDayName($date);
        $date_string = DateHelper::getDateString($date);
        return $day_name . ', ' . $date_string;
    }

}
