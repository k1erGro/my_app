<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
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
        $existingRoles = Role::pluck('name')->toArray();

        $existingRoles[] = 'User';

        return [
            'role' => 'required|string|in:' . implode(',', $existingRoles),
        ];
    }

    /**
     * Кастомные сообщения об ошибках
     */
    public function messages(): array
    {
        return [
            'role.required' => 'Вы должны выбрать роль для пользователя.',
            'role.in' => 'Выбранная роль не существует в системе.',
        ];
    }
}
