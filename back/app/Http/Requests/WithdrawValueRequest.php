<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WithdrawValueRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

   
    public function rules()
    {
        return [
            'type'  => 'required|numeric|in:2',
        ];
    }
    public function messages()
    {
        return[
            'type.in' => 'Digite 2 para retirar o valor investido.'
        ];
    }
}
