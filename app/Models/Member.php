<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Member extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'members';

    protected $fillable = [
        'member_name',
        'member_shortname',
        'member_phone',
        'member_neighborhood'
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_member', 'member_id', 'event_id')->withPivot('presence', 'status');
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'member_tag', 'member_id', 'tag_id');
    }
}
