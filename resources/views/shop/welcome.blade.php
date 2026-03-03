@extends('layouts.main')
@section('content')
<div class="relative bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                <div class="sm:text-center lg:text-left">
                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block xl:inline">Обновите свой</span>
                        <span class="block text-blue-600 xl:inline">цифровой мир</span>
                    </h1>
                    <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        Лучшие комплектующие, периферия и готовые решения для геймеров и профессионалов. Прямые поставки и официальная гарантия.
                    </p>
                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                        <div class="rounded-md shadow">
                            <a href="{{ route('catalog.index') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10 transition">
                                В каталог
                            </a>
                        </div>
                        <div class="mt-3 sm:mt-0 sm:ml-3">
                            <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 md:py-4 md:text-lg md:px-10 transition">
                                Сборка ПК
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        <img class="z-50 w-56 object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="{{ asset('img/hero-img.png') }}" alt="Gaming Setup">
    </div>
</div>

<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 lg:gap-x-8">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0 bg-blue-500 p-3 rounded-lg text-white">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Гарантия качества</h3>
                    <p class="text-sm text-gray-500">Только оригинальная продукция</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0 bg-blue-500 p-3 rounded-lg text-white">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Быстрая доставка</h3>
                    <p class="text-sm text-gray-500">Отправка в день заказа</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0 bg-blue-500 p-3 rounded-lg text-white">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Выгодные цены</h3>
                    <p class="text-sm text-gray-500">Бонусная программа для своих</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Популярные категории</h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <a href="#" class="group relative rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition duration-300">
                <div class="aspect-w-1 aspect-h-1 bg-gray-200 group-hover:opacity-75 transition">
                    <img src="https://images.unsplash.com/photo-1591488320449-011701bb6704?auto=format&fit=crop&q=80&w=400" alt="GPU" class="w-full h-full object-center object-cover">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-4">
                    <p class="text-white font-bold text-lg">Видеокарты</p>
                </div>
            </a>

            <a href="#" class="group relative rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition duration-300">
                <div class="aspect-w-1 aspect-h-1 bg-gray-200 group-hover:opacity-75 transition">
                    <img src="https://images.unsplash.com/photo-1544652478-6653e09f18a2?auto=format&fit=crop&q=80&w=400" alt="CPU" class="w-full h-full object-center object-cover">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-4">
                    <p class="text-white font-bold text-lg">Процессоры</p>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="bg-blue-600">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
        <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
            <span class="block">Хотите узнавать о скидках первым?</span>
            <span class="block text-blue-200">Подпишитесь на нашу рассылку.</span>
        </h2>
        <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
            <div class="inline-flex rounded-md shadow">
                <input type="email" placeholder="Email" class="px-5 py-3 border border-transparent text-base font-medium rounded-l-md text-gray-900 bg-white focus:outline-none">
                <button class="flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-r-md text-white bg-blue-800 hover:bg-blue-900">
                    ОК
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
