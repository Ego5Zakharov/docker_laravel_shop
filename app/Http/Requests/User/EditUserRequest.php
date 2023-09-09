<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'permissions' => 'nullable|array',
            'permissions.*' => 'required|integer|min:1',

            'roles' => 'nullable|array',
            'roles.*' => 'required|integer|min:1',
        ];
    }
}
