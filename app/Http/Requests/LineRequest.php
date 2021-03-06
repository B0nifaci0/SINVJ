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
            'name' => 'required|string|max:15',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric|gt:purchase_price',
            'discount_percentage' => 'required|between:0,50|numeric'
        ];
    }


      public function messages(){
        return[
            'name.required' => 'El nombre es requerido',
            'purchase_price.required' => 'El precio compra es requerido',
            'sale_price' => 'El precio venta es requerido',
            'discount_percentage' => 'El porcentaje de descuento es requerido',
        ];
    }
}

