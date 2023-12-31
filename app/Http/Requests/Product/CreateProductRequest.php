<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:5',
            'description' => 'required|string|min:5',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'is_published' => 'nullable|in:0,1',

            'category_id' => 'nullable|int',

            'tags' => 'nullable|array|min:1',
            'tags.*' => 'required|integer|min:1',

            'preview_image_path' => 'nullable',

            'images' => 'nullable|array|min:1',
            'images.*' => 'required|file|max:12048',
//            'images.*.extension' => 'in:jpg,png,gif',
        ];
    }


}
