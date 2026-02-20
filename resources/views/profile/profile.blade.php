@extends('layouts.profile')
@section('content')

<main class="max-w-5xl mx-auto px-4 pb-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm p-6 text-center">
                <div class="relative inline-block">
                    <img src="https://ui-avatars.com/api/?name=John+Doe&size=150&background=0D8ABC&color=fff"
                         alt="Avatar"
                         class="w-32 h-32 rounded-2xl object-cover mx-auto mb-4 border-4 border-gray-50">
                    <button class="absolute bottom-2 right-2 bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700 shadow-lg transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                </div>
                <h2 class="text-xl font-bold text-gray-800">{{ auth()->user()->fullName }}</h2>
                <p class="text-gray-500 text-sm mb-4">{{ auth()->user()->getEmail() }}</p>
                <div class="inline-block px-3 py-1 bg-blue-50 text-blue-700 text-xs font-bold uppercase rounded-full">
                    {{ auth()->user()->getRole() }}
                </div>

                <hr class="my-6 border-gray-100">

                <div class="space-y-3 mb-5">
                    <a href="{{ route("profile.edit", auth()->user()) }}" class="w-full py-2 px-4 bg-gray-50 text-gray-700 rounded-xl hover:bg-gray-100 transition font-medium">
                        Редактировать профиль
                    </a>
                </div>
                <div class="space-y-3">
                    <form method="POST" action="{{ route("admin.destroy", auth()->user()) }}">
                        @csrf
                        @method('delete')
                        <input class="py-2 px-4 bg-red-500 text-white rounded-xl hover:bg-red-600 transition font-medium" type="submit" value="Удалить профиль">
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
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Дата рождения</label>
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
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Адрес проживания</label>
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
