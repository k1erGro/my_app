<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

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
        if ($this->routeIs('admin.*')) {
            $existingRoles = Role::pluck('name')->toArray();
            return [
                'role' => ['required', 'string', Rule::in($existingRoles)],
            ];
        }

        // Если запрос идет через обычное редактирование профиля пользователя
        $userId = auth()->id();
        return [
            'l_name' => 'required|string|max:255',
            'f_name' => 'required|string|max:255',
            'm_name' => 'nullable|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'birthday' => 'nullable|date|before:today',
            'phone' => 'nullable|string|max:20|regex:/^[\+\d\s\-\(\)]+$/',
            'address' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }

    /**
     * Кастомные сообщения об ошибках
     */
    public function messages(): array
    {
        return [
            'l_name.required' => 'Фамилия обязательна для заполнения.',
            'l_name.max' => 'Фамилия не может быть длиннее 255 символов.',
            'f_name.required' => 'Имя обязательно для заполнения.',
            'f_name.max' => 'Имя не может быть длиннее 255 символов.',
            'm_name.max' => 'Отчество не может быть длиннее 255 символов.',
            'email.required' => 'Email обязателен для заполнения.',
            'email.email' => 'Введите корректный email адрес.',
            'email.unique' => 'Этот email уже используется другим пользователем.',
            'email.max' => 'Email не может быть длиннее 255 символов.',
            'birthday.date' => 'Дата рождения должна быть корректной датой.',
            'birthday.before' => 'Дата рождения не может быть в будущем.',
            'phone.regex' => 'Введите корректный номер телефона.',
            'phone.max' => 'Телефон не может быть длиннее 20 символов.',
            'avatar.image' => 'Аватар должен быть изображением.',
            'avatar.max' => 'Размер аватара не должен превышать 2 МБ.',
            'avatar.mimes' => 'Аватар должен быть формата: jpeg, png, jpg, gif, webp.',
            'role.required' => 'Вы должны выбрать роль для пользователя.',
            'role.in' => 'Выбранная роль не существует в системе.',
        ];
    }
}
