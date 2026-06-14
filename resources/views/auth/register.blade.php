@extends('layouts.auth')
@section('title', 'Регистрация')

@section('content')
    <div class="bg-white dark:bg-gray-900 p-8 border border-gray-200 dark:border-gray-800 w-full max-w-lg shadow-sm transition-colors duration-300 my-6">
        <h2 class="text-3xl font-black mb-8 text-center text-gray-900 dark:text-white uppercase tracking-tighter">
            Создать аккаунт<span class="text-indigo-600">.</span>
        </h2>

        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400 px-4 py-3 text-sm mb-6 font-medium">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2">Фамилия</label>
                <input type="text" name="l_name" value="{{ old('l_name') }}" required
                       class="block w-full border border-gray-300 dark:border-gray-700 bg-transparent p-3 text-sm focus:outline-none focus:border-indigo-600 dark:focus:border-indigo-500 text-gray-900 dark:text-white transition">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2">Имя</label>
                <input type="text" name="f_name" value="{{ old('f_name') }}" required
                       class="block w-full border border-gray-300 dark:border-gray-700 bg-transparent p-3 text-sm focus:outline-none focus:border-indigo-600 dark:focus:border-indigo-500 text-gray-900 dark:text-white transition">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2">Отчество (если есть)</label>
                <input type="text" name="m_name" value="{{ old('m_name') }}"
                       class="block w-full border border-gray-300 dark:border-gray-700 bg-transparent p-3 text-sm focus:outline-none focus:border-indigo-600 dark:focus:border-indigo-500 text-gray-900 dark:text-white transition">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="block w-full border border-gray-300 dark:border-gray-700 bg-transparent p-3 text-sm focus:outline-none focus:border-indigo-600 dark:focus:border-indigo-500 text-gray-900 dark:text-white transition">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2">Телефон</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                           class="block w-full border border-gray-300 dark:border-gray-700 bg-transparent p-3 text-sm focus:outline-none focus:border-indigo-600 dark:focus:border-indigo-500 text-gray-900 dark:text-white transition">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2">День рождения</label>
                    <input type="date" name="birthday" value="{{ old('birthday') }}"
                           class="block w-full border border-gray-300 dark:border-gray-700 bg-transparent p-3 text-sm focus:outline-none focus:border-indigo-600 dark:focus:border-indigo-500 text-gray-900 dark:text-white transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2">Адрес проживания</label>
                <input type="text" name="address" value="{{ old('address') }}"
                       class="block w-full border border-gray-300 dark:border-gray-700 bg-transparent p-3 text-sm focus:outline-none focus:border-indigo-600 dark:focus:border-indigo-500 text-gray-900 dark:text-white transition">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2">Пароль</label>
                <input type="password" name="password" required
                       class="block w-full border border-gray-300 dark:border-gray-700 bg-transparent p-3 text-sm focus:outline-none focus:border-indigo-600 dark:focus:border-indigo-500 text-gray-900 dark:text-white transition">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2">Подтвердите пароль</label>
                <input type="password" name="password_confirmation" required
                       class="block w-full border border-gray-300 dark:border-gray-700 bg-transparent p-3 text-sm focus:outline-none focus:border-indigo-600 dark:focus:border-indigo-500 text-gray-900 dark:text-white transition">
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-3 px-4 font-bold text-sm uppercase tracking-widest hover:bg-indigo-700 transition duration-200">
                Зарегистрироваться
            </button>
        </form>

        <p class="mt-6 text-center text-xs font-bold uppercase tracking-widest text-gray-400">
            Уже есть аккаунт? <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500 dark:hover:text-indigo-400 underline transition">Войти</a>
        </p>
    </div>
@endsection
