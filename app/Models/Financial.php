<?php

namespace App\Models;

use App\Helper\DateHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Financial extends Model
{
    use HasFactory;

    protected $table = 'financials';

    protected $fillable = [
        'financial_name',
        'financial_date',
        'financial_amount',
        'financial_type',
        'financial_category_id',
        'file_path',
        'file_name'
    ];

    public static function getFilePath()
    {
        return public_path().Storage::url('public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'financial');
    }
    public static function getUploadPath()
    {
        return DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'financial';
    }

    public function category()
    {
        return $this->belongsTo(FinancialCategory::class, 'financial_category_id');
    }

    public function dateString($date)
    {
        $day_name    = DateHelper::getDayName($date);
        $date_string = DateHelper::getDateString($date);
        return $day_name . ', ' . $date_string;
    }
}
