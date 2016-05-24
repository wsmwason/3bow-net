<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;


class ContactUsRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'description' => 'required',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => '請輸入您的名字',
            'email.required' => '請輸入您的聯絡 Email',
            'email.email' => '請輸入正確的聯絡 Email',
            'description.required' => '請輸入您的聯絡內容',
        ];
    }

}
