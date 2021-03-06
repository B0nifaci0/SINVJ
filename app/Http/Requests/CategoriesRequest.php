<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriesRequest extends FormRequest
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
            'name' => 'required|string|max:15|regex:/^[0-9,A-Z,a-z,á,é,í,ó,ú, ]*$/',
        ];
    }
    public function messages(){
        return[
            'name.required' => 'El nombre es requerido y con solo 15 caracteres', 
        ];
    }
}
