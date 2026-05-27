@extends('layouts.admin')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Управление пользователем</h2>
            <a href="{{ route('admin.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Назад к списку
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg p-8 space-y-6">
            <div class="bg-gray-50 p-4 rounded-md border border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                <div>
                    <span class="block font-medium text-gray-400">ФИО пользователя:</span>
                    <span class="text-gray-900 font-semibold">{{ $user->getLastName() }} {{ $user->getFirstName() }} {{ $user->getMiddleName() }}</span>
                </div>
                <div>
                    <span class="block font-medium text-gray-400">Email (Логин):</span>
                    <span class="text-gray-900 font-semibold">{{ $user->getEmail() }}</span>
                </div>
                <div>
                    <span class="block font-medium text-gray-400">Телефон:</span>
                    <span class="text-gray-900 font-semibold">{{ $user->getPhone() ?? 'Не указан' }}</span>
                </div>
                <div>
                    <span class="block font-medium text-gray-400">Дата рождения:</span>
                    <span class="text-gray-900 font-semibold">{{ $user->getBirthday() ?? 'Не указана' }}</span>
                </div>
                <div class="md:col-span-2">
                    <span class="block font-medium text-gray-400">Адрес доставки:</span>
                    <span class="text-gray-900 font-semibold">{{ $user->getAddress() ?? 'Не указан' }}</span>
                </div>
            </div>

            <hr class="border-gray-200">

            <form action="{{ route('admin.update', $user->getKey()) }}" method="POST" class="space-y-4">
                @csrf
                @method('patch')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Роль пользователя в системе</label>
                    <select name="role" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                        <option value="" disabled>Выберите роль</option>


                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                @if($role->name === 'Director') Директор
                                @elseif($role->name === 'Manager') Менеджер
                                @elseif($role->name === 'TechnicalSpecialist') Технический специалист
                                @elseif($role->name === 'Admin') Администратор
                                @else {{ $role->name }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-blue-600 text-white py-2.5 px-4 rounded-md hover:bg-blue-700 transition font-bold shadow">
                        Обновить роль
                    </button>
                </div>
            </form>

            <hr class="border-gray-200">

            <div class="text-center">
                <a href="{{ route('admin.edit_password', $user->getKey()) }}" class="inline-flex items-center text-sm font-semibold text-orange-600 hover:text-orange-700 bg-orange-50 hover:bg-orange-100 px-4 py-2 rounded-md transition">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                    Изменить пароль пользователя
                </a>
            </div>
        </div>
    </div>
@endsection
