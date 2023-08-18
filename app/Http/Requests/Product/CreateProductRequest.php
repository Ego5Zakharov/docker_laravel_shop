<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|min:5',
            'description' => 'required|string|min:5',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'is_published' => 'nullable|boolean',
            'category_id' => 'nullable|int',
            'tags' => 'nullable|array|min:1',
            'tags.*' => 'required|integer|min:1',
            'images' => 'nullable|array|min:1',
            'images.*' => 'required|file|min:1|mimes:jpg,png,gif'
        ];
    }
}
