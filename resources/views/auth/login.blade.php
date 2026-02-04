@extends('layouts.main')
@section('content')
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Вход в систему</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login.user') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 border">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Пароль</label>
            <input type="password" name="password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 border">
        </div>

        <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 font-semibold">
            Войти
        </button>
    </form>

    <p class="mt-4 text-center text-sm text-gray-600">
        Нет аккаунта? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Регистрация</a>
    </p>
</div>
@endsection
