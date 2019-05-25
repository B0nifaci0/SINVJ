<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductValidate extends FormRequest
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
          'description' => 'required|string|max:350',
           'purity' => 'required|string|max:6',
            'weigth' => 'required|numeric|max:200',
            'price' => 'required|numeric',
            'image' => 'required',
            'nationality' => 'required|string|max:200',
            'category_id' => 'required',
            //'branch_id' => 'required',
        ];
    }

     public function messages(){
        return[
            'name.required' =>'El nombre del producto  es requerido',
            'name.string' => 'Solo se admiten caracteres alfabeticos',
            'description.required' =>'La descripción  del producto  es requerida',
            'description.alpha' => 'Solo se admiten caracteres alfabeticos',
            'purity.required' =>'El kilataje del producto  es requerido',
            'purity.string' => 'Solo se admiten caracteres alfabeticos',
             'purity.max' => 'Solo se admiten menos de 6 caracteres ejemplo 14kt',
            'weigth.required' =>'El peso del producto  es requerido',
            'weigth.numeric' => 'Solo se admiten caracteres numericos',
            'price.required' =>'El precio del producto  es requerido',
            'price.numeric' => 'Solo se adminen caracteres alfabeticos',
            'image.required' =>'La imagen  del producto  es requerida',
            'category_id.required' =>'La categoria del producto  es requerida',
            //'branch_id.required' =>' La sucursal del producto  es requerida',




        ];
    }
}
