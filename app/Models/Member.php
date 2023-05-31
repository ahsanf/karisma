<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';

    protected $fillable = [
        'member_name',
        'member_phone',
        'member_neighborhood'
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_member', 'member_id', 'event_id');
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'member_tag', 'member_id', 'tag_id');
    }
}
