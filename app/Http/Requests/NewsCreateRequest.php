<?php

namespace App\Http\Requests;

class NewsCreateRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'source_url' => 'required|url',
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'source_url.required' => '請輸入新聞網址',
            'title.required' => '請輸入新聞標題',
            'author.required' => '請輸入作者',
            'description.required' => '請輸入新聞內文'
        ];
    }

}
