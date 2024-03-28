<?php

namespace App\Models;

use App\Helper\DateHelper;
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

    public function dateString($date)
    {
        $day_name    = DateHelper::getDayName($date);
        $date_string = DateHelper::getDateString($date);
        return $day_name . ', ' . $date_string;
    }
}
