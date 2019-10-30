<?php
namespace App\Filters;


class BodyFilters extends Filters
{
    public function name($name)
    {
        return $this->builder->where('name', 'like', '%'.$name.'%');
    }

}