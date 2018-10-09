<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItem extends FormRequest
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
            'name' => 'required|max:100',
            'category' => 'required',
            'description' => 'max:191',
            'stock' => 'required|numeric',
            'cost' => 'required|numeric',
        ];
    }

    public function messages()
    {
      return [
        'name.required' => 'Please enter the item name.',
        'stock.required' => 'Please enter how much stock.',
        'cost.required' => 'Please enter the per item cost.',
      ];
    }
}
