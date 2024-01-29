<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefConfig extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const TYPE_FLIPTO = 1;
    const TYPE_KARISMA = 2;
    protected $table = 'ref_config';
    protected $fillable = [
        'key',
        'value',
        'status',
    ];

}
