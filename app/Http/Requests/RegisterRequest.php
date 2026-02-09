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
            'last_name' => 'required|max:255',
            'first_name' => 'required|max:255',
            'surname' => 'nullable|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|confirmed:password',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'birthday' => 'nullable|date',
            'phone' => 'nullable',
            'address' => 'nullable',
        ];
    }
}
