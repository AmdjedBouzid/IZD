<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // gate/permissions later if needed
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:offer_categories,name'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est obligatoire.',
            'name.unique'   => 'Cette catégorie existe déjà.',
        ];
    }
}
