<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class FinancialFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function financialCategory($financialCategories)
    {
        return $this->whereIn('financial_category_id', $financialCategories);
    }

    public function financialType($financialType)
    {
        return $this->where('financial_type', $financialType);
    }

    public function financialYear($financialYear)
    {
        return $this->whereYear('financial_date', $financialYear);
    }


}
