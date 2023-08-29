<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class IndexProductRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'page' => 'required|integer',
        ];
    }
}
