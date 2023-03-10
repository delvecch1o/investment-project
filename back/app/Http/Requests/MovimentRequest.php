<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovimentRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'invested_value' => 'required|numeric',
            'type'  => 'required|numeric|in:1',
        ];
    }

    public function messages()
    {
        return[
            'type.in' => 'Digite 1 para realizar o Investimento'
        ];
    }
}
