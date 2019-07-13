<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LineRequest extends FormRequest
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
          'name' => 'required|string',
          'price' => 'required|numeric',
        ];
    }


      public function messages(){
        return[
            'name.required' =>'El nombre de la Linea  es requerido',
            'name.string' => 'Solo se admiten caracteres alfanumericos en nombre ',
            'price.required' =>'El precio  es requerido',
            'price.numeric' => 'Solo se adminen caracteres numericos',
        ];
    }
}

