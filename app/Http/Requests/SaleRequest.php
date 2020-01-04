<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            //'customer_name'=>Rule::requiredif($request->user_type == 1),
            //'customer_name' => 'required|string|max:50|min:3',
            //'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ];
    }


      public function messages(){
        return[
            'customer_name.required' => 'El nombre del cliente es requerido',
            'telephone.required' => 'El telefono es requerido y debe de contener 10 numeros',
            'total' => 'El total a pagar es requerido',
            'paid_out' => 'El dinero recibido es requerido y debe ser menor que el total a pagar',
        ];
    }
}
