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
//        return false;
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
            'name' => 'bail|required|min:5|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed'
        ];
    }

    // 提示信息
    public function messages()
    {
        return [
            'name.required' => '名称不能为空~~~!!!',
            'email.required' => '输入邮箱~~~!!!'
        ];
    }
}
