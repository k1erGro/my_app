@extends('layouts.main')
@section('content')
    <main class="max-w-[1600px] mx-auto px-6 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Левая колонка: аватар, роли, кнопки -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-md p-6 text-center border border-gray-200 dark:border-gray-800">
                    <div class="relative inline-block">
                        <img class="h-24 w-24 rounded-full object-cover border-2 border-indigo-500 p-0.5"
                             src="{{ Auth::user()->getFirstMediaUrl('avatars', 'preview') }}" alt="Аватар">
                    </div>
                    <h2 class="text-xl font-black uppercase tracking-tighter text-gray-900 dark:text-white mt-4">{{ Auth::user()->getFullName() }}</h2>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">{{ Auth::user()->getEmail() }}</p>
                    <div class="inline-block px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 text-xs font-bold uppercase rounded-full">
                        {{ Auth::user()->hasRole('Admin') ? 'Администратор' : 'Пользователь' }}
                    </div>

                    <hr class="my-6 border-gray-100 dark:border-gray-800">

                    <div class="space-y-3">
                        <a href="{{ route("profile.edit", Auth::user()) }}"
                           class="block w-full py-2.5 px-4 bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 font-bold rounded-xl hover:bg-indigo-100 dark:hover:bg-indigo-900/30 hover:text-indigo-700 transition text-sm">
                            Редактировать профиль
                        </a>
                        <a href="{{ route("profile.edit.password", Auth::user()) }}"
                           class="block w-full py-2.5 px-4 bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 font-bold rounded-xl hover:bg-indigo-100 dark:hover:bg-indigo-900/30 hover:text-indigo-700 transition text-sm">
                            Редактировать пароль
                        </a>
                        <form method="POST" action="{{ route("profile.destroy", Auth::user()) }}" onsubmit="return confirm('Вы уверены, что хотите удалить профиль?')">
                            @csrf
                            @method('delete')
                            <button type="submit" class="w-full py-2.5 px-4 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition text-sm">
                                Удалить профиль
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Правая колонка: личные данные и подписка -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-md overflow-hidden border border-gray-200 dark:border-gray-800">
                    <div class="border-b border-gray-100 dark:border-gray-800 p-6">
                        <h3 class="text-xl font-black uppercase tracking-tighter text-gray-900 dark:text-white">Личные данные</h3>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-1">Фамилия</label>
                                <p class="text-gray-800 dark:text-gray-200 font-medium">{{ Auth::user()->getLastName() }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-1">Имя</label>
                                <p class="text-gray-800 dark:text-gray-200 font-medium">{{ Auth::user()->getFirstName() }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-1">Отчество</label>
                                <p class="text-gray-800 dark:text-gray-200 font-medium">{{ Auth::user()->getMiddleName() ?? 'Не указано' }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-1">Дата рождения</label>
                                <p class="text-gray-800 dark:text-gray-200 font-medium">{{ Auth::user()->getBirthday() ?? 'Не указано' }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <hr class="border-gray-100 dark:border-gray-800">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-1">Телефон</label>
                                <p class="text-gray-800 dark:text-gray-200 font-medium">{{ Auth::user()->getPhone() ?? 'Не указано' }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-1">E-mail</label>
                                <p class="text-gray-800 dark:text-gray-200 font-medium">{{ Auth::user()->getEmail() }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-1">Адрес проживания</label>
                                <p class="text-gray-800 dark:text-gray-200 font-medium">{{ Auth::user()->getAddress() ?? 'Не указано' }}</p>
                            </div>
                        </div>

                        <hr class="my-6 border-gray-200 dark:border-gray-800">

                        <!-- Форма подписки на новости -->
                        <form action="{{ route('profile.subscribe-notifications', $user) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PATCH')
                            <div class="flex flex-wrap items-start gap-3">
                                <input type="checkbox" name="is_subscribed" id="subscribe" value="1"
                                       @checked($user->isSubscribed())
                                       class="mt-1 w-5 h-5 text-indigo-600 border-gray-300 dark:border-gray-700 rounded focus:ring-indigo-500">
                                <label for="subscribe" class="text-gray-700 dark:text-gray-300">
                                    <span class="font-medium">Я согласен получать рассылку о новых поступлениях товаров</span>
                                </label>
                            </div>
                            <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-md transition">
                                Сохранить настройки
                            </button>
                        </form>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-800/50 px-6 py-4 border-t border-gray-100 dark:border-gray-800">
                        <span class="text-xs text-gray-400 dark:text-gray-500">Аккаунт создан: {{ Auth::user()->created_at->format('d.m.Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
