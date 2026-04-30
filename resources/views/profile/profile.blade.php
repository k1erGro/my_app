@extends('layouts.main')
@section('content')

    <main class="max-w-5xl mx-auto px-4 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm p-6 text-center">
                    <div class="relative inline-block">
                        <img class="h-24 w-24 rounded-full object-cover"
                             src="{{ Auth::user()->getFirstMediaUrl('avatars', 'preview') }}" alt="Аватар">
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">{{ Auth::user()->getFullName() }}</h2>
                    <p class="text-gray-500 text-sm mb-4">{{ Auth::user()->getEmail() }}</p>
                    <div
                        class="inline-block px-3 py-1 bg-blue-50 text-blue-700 text-xs font-bold uppercase rounded-full">
                        {{ Auth::user()->hasRole('Admin') ? 'Администратор' : 'Пользователь'}}
                    </div>

                    <hr class="my-6 border-gray-100">

                    <div class="space-y-3 mb-5">
                        <a href="{{ route("profile.edit", Auth::user()) }}"
                           class="w-full py-2 px-4 bg-gray-50 text-gray-700 rounded-xl hover:bg-gray-100 transition font-medium">
                            Редактировать профиль
                        </a>
                    </div>
                    <div class="space-y-3 mb-5">
                        <a href="{{ route("profile.edit.password", Auth::user()) }}"
                           class="w-full py-2 px-4 bg-gray-50 text-gray-700 rounded-xl hover:bg-gray-100 transition font-medium">
                            Редактировать пароль
                        </a>
                    </div>
                    <div class="space-y-3">
                        <form method="POST" action="{{ route("profile.destroy", Auth::user()) }}">
                            @csrf
                            @method('delete')
                            <input
                                class="py-2 px-4 bg-red-500 text-white rounded-xl hover:bg-red-600 transition font-medium"
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
                                <p class="text-gray-800 font-medium">{{ Auth::user()->getLastName() }}</p>
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Имя</label>
                                <p class="text-gray-800 font-medium">{{ Auth::user()->getFirstName() }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Отчество</label>
                                <p class="text-gray-800 font-medium">{{ Auth::user()->getMiddleName() ?? 'Не указано' }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Дата
                                    рождения</label>
                                <p class="text-gray-800 font-medium">{{ Auth::user()->getBirthday() ?? 'Не указано' }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <hr class="border-gray-50">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Телефон</label>
                                <p class="text-gray-800 font-medium">{{ Auth::user()->getPhone() ?? 'Не указано' }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">E-mail</label>
                                <p class="text-gray-800 font-medium">{{ Auth::user()->getEmail() }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Адрес
                                    проживания</label>
                                <p class="text-gray-800 font-medium">{{ Auth::user()->getAddress() ?? 'Не указано' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex items-center justify-between">
                        <span
                            class="text-xs text-gray-400">Аккаунт создан: {{ Auth::user()->created_at->format('d.m.Y') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </main>

@endsection
