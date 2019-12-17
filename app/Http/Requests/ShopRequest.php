<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'image' => 'image:mimes,png',
            'description' => 'required|string',
            'phone_number' => 'required|numeric|regex:/^[0-9]{10}$/',
            'municipality_id' => 'required|numeric',
            'state_id' => 'required|numeric',
            'email' => 'required|email'
        ];
    }
    
    public function messages(){
        return[
            'image.image' =>'La imagen  del producto  debe de ser .png',
            'description' => 'La descripcion es requerida',
            'phone_number' => 'El telefono es requerido y debe ser igual a 10',
            'municipality_id' => 'El municipio es requerido',
            'state_id' => 'El estado es requerido',
            'email' => 'El correo es requerido'
        ];
    }

    public function aliases() {
        return [
            'description' => 'descripción',
            'phone_number' => 'teléfono',
            'email' => 'correo electrónico'
        ];
    }
}
