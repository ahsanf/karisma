<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    use HasFactory;
    protected $table = 'documentations';

    protected $fillable = [
        'name',
        'url',
        'date'
    ];
}
