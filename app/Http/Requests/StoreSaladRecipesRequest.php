<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaladRecipesRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:salad_recipes|max:255',
            'description' => 'required|min:20',
            'fruits' => 'required|array|min:2',
            'fruits.*.fruit_id' => 'required|numeric',
            'fruits.*.weight' => 'required|numeric|min:1'
        ];
    }
}
