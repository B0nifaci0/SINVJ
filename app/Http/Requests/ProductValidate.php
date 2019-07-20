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
            'clave' => 'required|string|max:10|unique:products,clave',
            'name' => 'required|alpha|max:15|unique:products,name',
            'description' => 'required|string|max:15',
            'weigth' => 'required|numeric|max:200',
            'observations' => 'required|string|max:15',
            'image' => 'image',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'line_id' => 'required',
            'shop_id' => 'required',
            'branch_id' => 'required',
            'status_id' => 'required',
        ];
    }

     public function messages(){
        return[
            'name.required' =>'El nombre del producto  es requerido',
            'name.string' => 'Solo se admiten caracteres alfabeticos',
            'description.required' =>'La descripción  del producto  es requerida y solo con 15 caracteres',
            'description.alpha' => 'Solo se admiten caracteres alfabeticos',
            'weigth.required' =>'El peso del producto  es requerido',
            'weigth.numeric' => 'Solo se admiten caracteres numericos',
            'observations.required' =>'La descripción  del producto  es requerida y solo con 15 caracteres ',
            'observations.alpha' => 'Solo se admiten caracteres alfabeticos',
            'price.required' =>'El precio del producto  es requerido',
            'price.numeric' => 'Solo se adminen caracteres alfabeticos',
            'image.required' =>'La imagen  del producto  es requerida',
            'category_id.required' =>'La categoria del producto  es requerida',
            'line_id.required' =>'La categoria del producto  es requerida',            
            'shop_id.required' =>'La categoria del producto  es requerida',
            'branch_id.required' =>' La sucursal del producto  es requerida',
            'status_id.required' =>'La categoria del producto  es requerida',
        ];
    }
}
