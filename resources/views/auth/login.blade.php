@extends('layouts.auth')

@section('content')
    <div class="flex items-center justify-center min-h-[50vh] py-6 w-full max-w-lg">
        <div class="bg-white dark:bg-gray-900 p-8 border border-gray-200 dark:border-gray-800 w-full max-w-md shadow-sm transition-colors duration-300">
            <h2 class="text-3xl font-black mb-8 text-center text-gray-900 dark:text-white uppercase tracking-tighter">
                Вход в систему<span class="text-indigo-600">.</span>
            </h2>

            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400 px-4 py-3 text-sm mb-6 font-medium">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2">Email</label>
                    <input type="email" name="email" required autocomplete="email" value="{{ old('email') }}"
                           class="block w-full border border-gray-300 dark:border-gray-700 bg-transparent p-3 text-sm focus:outline-none focus:border-indigo-600 dark:focus:border-indigo-500 text-gray-900 dark:text-white transition-colors duration-200">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2">Пароль</label>
                    <input type="password" name="password" required autocomplete="current-password"
                           class="block w-full border border-gray-300 dark:border-gray-700 bg-transparent p-3 text-sm focus:outline-none focus:border-indigo-600 dark:focus:border-indigo-500 text-gray-900 dark:text-white transition-colors duration-200">
                </div>

                <button type="submit"
                        class="w-full bg-indigo-600 text-white py-3 px-4 font-bold text-sm uppercase tracking-widest hover:bg-indigo-700 transition duration-200">
                    Войти
                </button>
            </form>

            <p class="mt-6 text-center text-xs font-bold uppercase tracking-widest text-gray-400">
                Нет аккаунта? <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-500 dark:hover:text-indigo-400 underline transition">Регистрация</a>
            </p>
        </div>
    </div>
@endsection
