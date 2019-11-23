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
            'description' => 'required',
            'phone_number' => 'required',
            'email' => 'required'
        ];
    }
    
    public function messages(){
        return[
            'image.image' =>'La imagen  del producto  debe de ser .png',
        ];
    }

    public function aliases() {
        return [
            'description' => 'descripción',
            'phone_number' => 'número telefónico',
            'email' => 'correo electrónico'
        ];
    }
}
