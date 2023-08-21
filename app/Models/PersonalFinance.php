<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalFinance extends Model
{
    use HasFactory, Filterable;
    const TYPE_INCOME = 'income';
    const TYPE_EXPENSE = 'expense';
    protected $table = 'personal_finances';
    protected $fillable = [
        'name',
        'amount',
        'date',
        'month',
        'year',
        'type',
    ];

}
