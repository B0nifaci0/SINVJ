<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name' => 'required|string|max:30|regex:/^[A-Z,a-z,á,é,í,ó,ú, ]*$/',
            'first_lastname' => 'required|string|max:30|regex:/^[A-Z,a-z,á,é,í,ó,ú, ]*$/',
            'second_lastname' => 'required|string|max:30|regex:/^[A-Z,a-z,á,é,í,ó,ú, ]*$/',
            'phone_number' =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'credit' => 'required|numeric',
        ];
    }
}
