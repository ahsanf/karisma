<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialCategory extends Model
{
    use HasFactory;

    protected $table = 'financial_categories';

    protected $fillable = [
        'category_name'
    ];

    public function financials()
    {
        return $this->belongsTo(Financial::class, 'financial_category_id' ,'id');
    }
}
