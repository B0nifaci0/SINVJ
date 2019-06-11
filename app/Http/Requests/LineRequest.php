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
          'name' => 'required|alpha|max:200',
          'price' => 'required|numeric',
        ];
    }


      public function messages(){
        return[
            'name.required' =>'El nombre de la Linea  es requerido',
            'name.alpha' => 'Solo se admiten caracteres alfabeticos en nombre ',
            'price.required' =>'El precio  es requerido',
            'price.numeric' => 'Solo se adminen caracteres alfabeticos',
        ];
    }
}

