<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:25',
            'email' => ['required','email'],
            'password' => 'required|string|min:6',
            'branch_id' => 'required|numeric',
            'type_user' => 'required|numeric',
            'salary' => 'required|numeric',
        ];
    }
    public function messages(){
        return[
            'name.required' => 'El nombre es requerido ',
            'email.required' => 'El correo es requerido ', 
            'password.required' => 'La contraseña es requerida ',
            'branch_id.required' => 'La sucursal es requerida ',
            'type_user.required' => 'El tipo de usuario es requerido ',
            'salary' => 'El salario es requerido'
        ];
    }
}
