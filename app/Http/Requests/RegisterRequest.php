<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        return [
            'l_name' => 'string|required|max:50',
            'f_name' => 'string|required|max:50',
            'm_name' => 'string|nullable|max:50',
            'email' => 'string|required|email|max:255|unique:users',
            'password' => 'string|required',
            'password_confirmation' => 'string|required|confirmed:password',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'birthday' => 'nullable|date',
            'phone' => 'string|nullable',
            'address' => 'string|nullable',
        ];
    }
}
