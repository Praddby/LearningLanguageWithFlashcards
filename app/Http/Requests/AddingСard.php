<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddingСard extends FormRequest
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
            'name_category'      => 'bail|required|unique:card_groups|string|max:255',
            'name_original'      => 'array',
            'name_translation'   => 'array',
            'name_original.*'    => 'nullable|string|max:255',
            'name_translation.*' => 'nullable|string|max:255',
        ];
    }
}
