@extends('layouts.auth')
@section('title', 'Восстановление пароля')

@section('content')
    <div class="bg-white dark:bg-gray-900 p-8 border border-gray-200 dark:border-gray-800 w-full max-w-lg shadow-sm transition-colors duration-300 my-6">
        <h2 class="text-3xl font-black mb-8 text-center text-gray-900 dark:text-white uppercase tracking-tighter">
            Сброс пароля<span class="text-indigo-600">.</span>
        </h2>

        @if (session('status'))
            <div class="bg-green-500/10 border border-green-500/20 text-green-600 dark:text-green-400 px-4 py-3 text-sm mb-6 font-medium">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400 px-4 py-3 text-sm mb-6 font-medium">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2">Ваш Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="block w-full border border-gray-300 dark:border-gray-700 bg-transparent p-3 text-sm focus:outline-none focus:border-indigo-600 dark:focus:border-indigo-500 text-gray-900 dark:text-white transition">
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-3 px-4 font-bold text-sm uppercase tracking-widest hover:bg-indigo-700 transition duration-200">
                Получить ссылку для сброса
            </button>
        </form>
    </div>
@endsection
