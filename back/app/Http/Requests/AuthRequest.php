<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\Cpf;

class AuthRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:191',
            'cpf' => [ 'required', new Cpf , 'unique:users,cpf' ],
            'phone' => 'required|max:11',
            'birth' => 'date',
            'gender' => 'max:1',
            'notes' => 'max:191',
            'email' => 'required|email|max:191|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        
        ]; 
    }
    public function messages()
    {
        return[
            'gender.max' => 'Insira M ou F',
    
        ] ;
    }
}
