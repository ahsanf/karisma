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
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_member', 'member_id', 'event_id');
    }
}
