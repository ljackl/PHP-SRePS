<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimeRange extends FormRequest
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
              'select_from' => 'required|date_format:Y-m-d',
              'select_to' => 'required|date_format:Y-m-d',
          ];
      }

      public function messages()
      {
        return [
          'select_from.required' => 'Please enter from date.',
          'select_to.required' => 'Please enter to date.',
        ];
      }
}
