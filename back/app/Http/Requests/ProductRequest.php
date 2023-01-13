<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'description' =>'required|max:191',
            'name' => 'required|max:191',
            'index' => 'required|max:191',
            'interest_rate' => 'required|numeric',
        ];
    }
}
