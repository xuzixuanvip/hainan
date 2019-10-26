<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerRequest extends FormRequest
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
            'mobile'     => 'bail|required|max:13',
            'truename'   => 'bail|required',
            'idnum'      => 'bail|required|max:200',
            'idcard_a'   => 'required',
            'idcard_b'   => 'required',
            'address'    => 'required',
            //'zhizhao_num' =>'required',
            'shop_name' => 'required',
        ];
    }

    /**
     * 错误信息
     * @return array
     */
    public function messages()
    {
        return [
            'mobile.required'       => '请输入手机号码',
            'mobile.unique'         => '此手机号码已注册',
            'truename.required'     => '请填写姓名',
            'idnum.required'        => '请填写身份证号码',
            'idcard_a.required'     => '请上传身份证正面', 
            'idcard_b.required'     => '请上传身份证背面',
            'address.required'      => '请填写地址信息',
            'zhizhao_num.required'  => '请填写营业执照编号',
            'shop_name.required'    => '请填写店铺名称',
                   
        ];
    }

    
}
