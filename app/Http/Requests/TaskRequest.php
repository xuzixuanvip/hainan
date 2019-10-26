<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
        return [
            'name'         => 'required|max:30',
            'platform_id'  => 'bail|required',
            'price'      => 'bail|required|max:200',
            'commission' => 'required',
            'num'        => 'required',
            'task_url'   => 'required',
        ];
    }

    /**
     * 错误信息
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'         => '请输入任务名称',
            'name.max'              => '任务名称不能超过15个字',
            'platform_id.required'  => '请选择平台',
            'price.required'        => '请输入价格',
            'commission.required'   => '请输入佣金', 
            'task_url.required'     => '请输入任务链接',
            'task.max'              => '宝贝链接不能超过100个字',
            //'task_url.url'          => '请输入有效的任务链接',          
        ];
    }

    
}
