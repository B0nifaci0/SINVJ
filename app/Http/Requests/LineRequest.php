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
            'name' => 'required|alpha|max:15|unique:lines,name',
            'price' => 'required|numeric',
        ];
    }


      public function messages(){
        return[
            'name.required' => 'El nombre es requerido y con solo 15 caracteres',
            'price.required' => 'El precio es requerido',
            
        ];
    }
}

