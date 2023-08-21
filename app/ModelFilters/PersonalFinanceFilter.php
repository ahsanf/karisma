<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class PersonalFinanceFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    // public $relations = [];


    public function month($month)
    {
        return $this->where('month', $month);
    }

    public function year($year)
    {
        return $this->where('year', $year);
    }
}
