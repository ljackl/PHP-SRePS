<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSale extends FormRequest
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
             'sale' => 'required|numeric',
             'quantity' => 'required|numeric',
             'item_id' => 'required|numeric',
         ];
     }

     public function messages()
     {
       return [
         'sale.required' => 'Please enter the sale price.',
         'quantity.required' => 'Please enter how many items were sold.',
         'item_id.required' => 'Please enter the item ID.',
       ];
     }
}
