<?php

namespace App\Http\Requests\Frontend\Subscribe;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
           // 'email' => 'required|unique:subscribes,email',
            'email' =>  [
                'required',
                'email',
                Rule::unique('App\Entities\Subscribe'),
            ],
        ];
    }
}
