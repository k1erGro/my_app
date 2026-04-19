@extends('layouts.main')
@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Редактировать пароль</h2>
            <a href="{{ route('profile') }}" class="text-gray-500 hover:text-gray-700 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Назад
            </a>
        </div>

        <div class=" mt-5 bg-white shadow-md rounded-lg p-8">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ $errors->first() }}
                </div>
            @endif
            <form action="{{ route('profile.update_password', Auth::user()->getKey()) }}" method="POST"
                  class="space-y-4">
                @csrf
                @method('patch')

                <label class="block text-sm font-medium text-gray-700">Старый пароль</label>
                <input type="password" name="old_password" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">

                <label class="block text-sm font-medium text-gray-700">Пароль</label>
                <input type="password" name="password"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">

                <label class="block text-sm font-medium text-gray-700">Повторите пароль</label>
                <input type="password" name="password_confirmation"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">

                <div class="pt-4">
                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 transition duration-200 font-bold shadow-lg">
                        Редактировать пароль
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
