<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
            'customer_name' => 'required|string',
            'telephone' => 'required|numeric|regex:/^[0-9]{10}$/',
            'total' => 'required|numeric|gt:paid_out',
            'paid_out' => 'required|numeric'
        ];
    }


      public function messages(){
        return[
            'customer_name.required' => 'El nombre del cliente es requerido',
            'telephone.required' => 'El telefono es requerido',
            'total' => 'El total a pagar es requerido',
            'paid_out' => 'El dinero recibido es requerido y debe ser menor que el total a pagar',
        ];
    }
}
