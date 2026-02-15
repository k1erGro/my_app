@extends('layouts.main')
@section('content')
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Создать аккаунт</h2>


    <form action="{{ route('register.user') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Фамилия</label>
            <input type="text" name="l_name" value="{{ old('l_name') }}" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Имя</label>
            <input type="text" name="f_name" value="{{ old('f_name') }}" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Отчество (если есть)</label>
            <input type="text" name="m_name" value="{{ old('m_name') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Телефон</label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">День рождения</label>
                <input type="date" name="birthday" value="{{ old('birthday') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Адрес проживания</label>
            <input type="text" name="address" value="{{ old('address') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Пароль</label>
            <input type="password" name="password" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Подтвердите пароль</label>
            <input type="password" name="password_confirmation" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
        </div>

        <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200 font-semibold">
            Зарегистрироваться
        </button>
    </form>

    <p class="mt-4 text-center text-sm text-gray-600">
        Уже есть аккаунт? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Войти</a>
    </p>
</div>
@endsection
