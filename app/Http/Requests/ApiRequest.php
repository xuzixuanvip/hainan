<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\DiancanUser;

class ApiRequest extends FormRequest
{
    public $user_id;
    public $user;

   

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(empty($this->token)) {
            return false;
        }
        $user = DiancanUser::where(['token'=>$this->token])->first();
        if($user) {
            $this->user_id = $user->id;
            $this->user    = $user;
            return true;
        }        
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    public function messages()
    {
       return [];
    }

    

    public function pure()
    {
        $data = array_except($this->all(), ['token']);      
        return $data;
    }
}
