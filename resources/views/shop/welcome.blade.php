@extends('layouts.main')

@section('content')
    <div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col-reverse lg:flex-row items-center gap-10 py-12 lg:py-20">

                <div class="w-full lg:w-1/2 text-center lg:text-left">
                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block">Обновите свой</span>
                        <span class="block text-blue-600">цифровой мир</span>
                    </h1>

                    <p class="mt-4 text-base text-gray-500 sm:text-lg md:text-xl">
                        Лучшие комплектующие, периферия и готовые решения для геймеров и профессионалов.
                        Прямые поставки и официальная гарантия.
                    </p>

                    <div class="mt-6 flex flex-col sm:flex-row gap-3 sm:justify-center lg:justify-start">
                        <a href="{{ route('catalog.index') }}"
                           class="px-8 py-3 text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition md:py-4 md:text-lg md:px-10 text-center">
                            В каталог
                        </a>

                        <a href="#"
                           class="px-8 py-3 text-base font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 transition md:py-4 md:text-lg md:px-10 text-center">
                            Сборка ПК
                        </a>
                    </div>
                </div>

                <div class="w-full lg:w-1/2 flex justify-center">
                    <img
                        class="w-full max-w-md sm:max-w-lg lg:max-w-full h-auto object-contain"
                        src="{{ asset('img/hero-img.png') }}"
                        alt="Gaming Setup"
                    >
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                <div class="flex items-start space-x-4">
                    <div class="bg-blue-500 p-3 rounded-lg text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Гарантия качества</h3>
                        <p class="text-sm text-gray-500">Только оригинальная продукция</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="bg-blue-500 p-3 rounded-lg text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Быстрая доставка</h3>
                        <p class="text-sm text-gray-500">Отправка в день заказа</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="bg-blue-500 p-3 rounded-lg text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Выгодные цены</h3>
                        <p class="text-sm text-gray-500">Бонусная программа для своих</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
