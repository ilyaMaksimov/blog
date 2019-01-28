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
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'date' => 'required|date|date_format:"Y-m-d"',
            'content' => 'required|string',
            'status' => 'boolean',
            'is_featured' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png'
        ];
    }
}
