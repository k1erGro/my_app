@extends('layouts.main')
@section('content')

    <main class="max-w-5xl mx-auto px-4 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm p-6 text-center">
                    <div class="relative inline-block">
                        @if(auth()->user()->hasMedia('avatars'))
                            <img src="{{ auth()->user()->getFirstMediaUrl('avatars') }}" alt="Аватар" class="h-24 w-24 rounded-full object-cover">
                        @else
                            <div class="h-24 w-24 text-5xl bg-indigo-600 rounded-full flex items-center justify-center text-white">
                                {{ strtoupper(substr(auth()->user()->getFirstName(), 0, 1)) }}
                            </div>
                        @endif

                    </div>
                    <h2 class="text-xl font-bold text-gray-800">{{ auth()->user()->fullName }}</h2>
                    <p class="text-gray-500 text-sm mb-4">{{ auth()->user()->getEmail() }}</p>
                    <div class="inline-block px-3 py-1 bg-blue-50 text-blue-700 text-xs font-bold uppercase rounded-full">
                        {{ auth()->user()->getRole() }}
                    </div>

                    <hr class="my-6 border-gray-100">

                    <div class="space-y-3 mb-5">
                        <a href="{{ route("profile.edit", auth()->user()) }}"
                           class="w-full py-2 px-4 bg-gray-50 text-gray-700 rounded-xl hover:bg-gray-100 transition font-medium">
                            Редактировать профиль
                        </a>
                    </div>
                    <div class="space-y-3">
                        <form method="POST" action="{{ route("admin.destroy", auth()->user()) }}">
                            @csrf
                            @method('delete')
                            <input class="py-2 px-4 bg-red-500 text-white rounded-xl hover:bg-red-600 transition font-medium"
                                   type="submit" value="Удалить профиль">
                        </form>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <div class="border-b border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-800">Личные данные</h3>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Фамилия</label>
                                <p class="text-gray-800 font-medium">{{ auth()->user()->getLastName() }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Имя</label>
                                <p class="text-gray-800 font-medium">{{ auth()->user()->getFirstName() }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Отчество</label>
                                <p class="text-gray-800 font-medium">{{ auth()->user()->getMiddleName() ?? 'Не указано' }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Дата
                                    рождения</label>
                                <p class="text-gray-800 font-medium">{{ auth()->user()->getBirthday() ?? 'Не указано' }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <hr class="border-gray-50">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Телефон</label>
                                <p class="text-gray-800 font-medium">{{ auth()->user()->getPhone() ?? 'Не указано' }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">E-mail</label>
                                <p class="text-gray-800 font-medium">{{ auth()->user()->getEmail() }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Адрес
                                    проживания</label>
                                <p class="text-gray-800 font-medium">{{ auth()->user()->getAddress() ?? 'Не указано' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs text-gray-400">Аккаунт создан: {{ auth()->user()->created_at->format('d.m.Y') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </main>

@endsection
