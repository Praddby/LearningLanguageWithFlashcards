<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StandardCardsRequest extends FormRequest
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
            'cards.*.name_original'    => 'filled|string|unique:standard_cards,name_original',
            'cards.*.name_translation' => 'filled|string',
            'card.name_original'       => 'filled|string|unique:standard_cards,name_original',
            'card.name_translation'    => 'filled|string'
        ];
    }
}
