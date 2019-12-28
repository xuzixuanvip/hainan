<?php
namespace App\Filters;


class DoctorFilters extends Filters
{
    public function department($department)
    {
        $doctor_ids = \DB::table('kf_doctor_department')->where('department_id',$department)->get()->pluck('doctor_id')->all();
        return $this->builder->orWhereIn('id',$doctor_ids);
    }

}