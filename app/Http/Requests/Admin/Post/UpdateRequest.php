<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date' => 'required',
            'description' => 'required',
            'content' => 'required',
            //'image' => 'nullable|image'
        ];
    }
}
