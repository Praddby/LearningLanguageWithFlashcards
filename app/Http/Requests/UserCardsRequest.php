<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCardsRequest extends FormRequest
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
            'name_category'            => 'filled|string',
            'cards.*.name_original'    => 'nullable|string|unique:standard_cards,name_original',
            'cards.*.name_translation' => 'nullable|string',
        ];
    }
}
