<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class kfBodyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'PUT' :
                return [
                    'name'     => 'required|unique:kf_bodys,name',
                    'sex'    => 'required|numeric',
                ];
            case 'POST' :
                return [
                    'name'     => 'required|unique:kf_bodys,name',
                    'sex'    => 'required|numeric',
                    'pid'  => 'required|numeric',
                ];
            default:
                return [];
        }

    }

    /**
     * 错误信息
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'    => '名称不能为空',
            'name.unique'   => '名称已存在',
            'sex.required'   => '性别不能为空',
            'sex.numeric'   => '性别错误',
            'pid.required'   => '分类不能为空',
            'pid.numeric'   => '分类错误',
        ];
    }

    
}
