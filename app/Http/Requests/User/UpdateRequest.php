<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user')?->id ?? $this->user;
        return [
            'l_name' => 'string|required|max:50',
            'f_name' => 'string|required|max:50',
            'm_name' => 'string|nullable|max:50',
            'email' => 'string|required|email|max:255|unique:users,email,' . $userId,
            'password' => 'string|nullable',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'birthday' => 'nullable|date|before:today',
            'phone' => 'string|nullable',
            'address' => 'string|nullable',
            'role' => 'string',
        ];
    }
}
