<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'event_type'
    ];

    public function members()
    {
        return $this->belongsToMany(Member::class, 'event_member', 'event_id', 'member_id');
    }
}
