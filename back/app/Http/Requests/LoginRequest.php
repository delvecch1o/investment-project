<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|max:191',
            'password' => 'required',
        ];
    }
    public function messages()
    {
       return[
           'email.required' => 'O email é obrigatório',
           'password.required' => 'A senha é obrigatório',
       ] ;
    }
}
