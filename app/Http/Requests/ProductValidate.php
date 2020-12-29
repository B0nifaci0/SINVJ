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
            'clave' => 'required|string|max:50',
            //'name' => 'required|alpha|unique:products,name',
            'description' => 'required|string|max:25',
            //'weigth'=> 'required_if:product,is:true',
            //'weigth' => 'required|numeric|max:200',
            'image' => 'image',
            'price' => 'required|numeric',
            'pricepzt' => 'numeric',
            'price_purchase' => 'numeric|nullable', 
            'max_discountpz' => 'numeric|nullable',
            //'category_id' => 'required',
            //'category_id' => 'required_if:product,is:true',
            //'line_id' => 'required',
            'shop_id' => 'required',
            'branch_id' => 'required',
        ];
    }

    public function attributes()
{
    return [
        'price' => 'Precio del Producto',
        'pricepzt' => 'Precio del Producto pz',
        'price_purchase' => 'Precio Compra',
        'max_discountpz' => 'Precio con descuento',
        'description' => 'descripción', //This will replace any instance of 'username' in validation messages with 'email'
        'image' => 'imagen', //This will replace any instance of 'username' in validation messages with 'email'
        //'price_purchase' => 'precio compra', //This will replace any instance of 'username' in validation messages with 'email'
        //'price' => 'precio del producto', //This will replace any instance of 'username' in validation messages with 'email'
        //'weigth' => 'precio del producto', //This will replace any instance of 'username' in validation messages with 'email'
        //'anyinput' => 'Nice Name',
    ];

}

    //  public function messages(){
    //     return[
    //         'name.required' =>'El nombre del producto  es requerido',
    //         'name.string' => 'Solo se admiten caracteres alfabeticos',
    //         'description.required' =>'La descripción  del producto  es requerida y solo con 15 caracteres',
    //         'description.alpha' => 'Solo se admiten caracteres alfabeticos',
    //         'weigth.required' =>'El peso del producto  es requerido',
    //         'weigth.numeric' => 'Solo se admiten caracteres numericos',
    //         'observations.alpha' => 'Solo se admiten caracteres alfabeticos',
    //         'price.required' =>'El precio del producto  es requerido',
    //         'price.numeric' => 'Solo se adminen caracteres alfabeticos',
    //         'image.required' =>'La imagen  del producto  es requerida',
    //         'category_id.required' =>'La categoria del producto  es requerida',
    //         'line_id.required' =>'La categoria del producto  es requerida',
    //         'shop_id.required' =>'La categoria del producto  es requerida',
    //         'branch_id.required' =>' La sucursal del producto  es requerida',
    //     ];
    // }
}
