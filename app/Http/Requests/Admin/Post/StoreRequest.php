<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
           /* 'title' => 'required|string',
            'description' => 'required|string',
            'content' => 'required',
            'status' => 'boolean',
            'is_featured' => 'boolean',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png'*/
        ];
    }
}
