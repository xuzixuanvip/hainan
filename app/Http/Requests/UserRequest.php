<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'     => 'bail|required|unique:users|min:4|max:50',
            'email'    => 'required|unique:users|max:200',
            'password' => 'required',
            'password2'=> 'same:password',
        ];
    }

    /**
     * 错误信息
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'    => 'The :attribute and :other must match.',
            'email.required'   => 'The :attribute must be exactly :size.',
            'password2.same'   => 'The :attribute and :other must match.',

           
        ];
    }

    
}
