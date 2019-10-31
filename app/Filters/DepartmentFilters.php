<?php
namespace App\Filters;


class DepartmentFilters extends Filters
{
    public function name($name)
    {
        return $this->builder->where('name','like','%'. $name .'%');
    }

}