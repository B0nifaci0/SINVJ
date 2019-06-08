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

        ];
    }
}
