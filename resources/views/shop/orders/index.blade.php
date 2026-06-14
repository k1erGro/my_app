@extends('layouts.main')
@section('content')
    <div class="max-w-[1600px] mx-auto px-6 py-12">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
            <h1 class="text-4xl font-black uppercase tracking-tighter text-gray-900 dark:text-white">Ваши заказы</h1>
            <span class="bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 py-2 px-4 rounded-full text-sm font-bold">
            Всего: {{ $orders->count() }}
        </span>
        </div>

        @if(!Auth::check())
            <div class="text-center py-20 bg-gray-50 dark:bg-gray-900 rounded-3xl">
                <div class="mb-4">
                    <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-black text-gray-900 dark:text-white">Требуется авторизация</h2>
                <p class="mt-2 text-gray-500 dark:text-gray-400">Войдите в профиль, чтобы отслеживать свои покупки.</p>
                <a href="{{ route('show.login') }}"
                   class="mt-6 inline-flex items-center px-8 py-3 bg-indigo-600 text-white font-bold rounded-full hover:bg-indigo-700 transition shadow-md">
                    Авторизоваться
                </a>
            </div>
        @else
            <div class="grid gap-6">
                <a href="{{ route('order-report.index') }}" class="inline-flex items-center gap-2 text-indigo-600 dark:text-indigo-400 font-bold hover:underline w-max">
                    Мои вопросы по заказам
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                @foreach($orders as $order)
                    <a href="{{ route('orders.show', $order->getKey()) }}" class="block group">
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden hover:shadow-xl hover:border-indigo-300 dark:hover:border-indigo-700 transition-all duration-300">
                            <div class="p-6">
                                <div class="flex flex-wrap justify-between items-center gap-4 mb-4">
                                    <div>
                                        <span class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wider font-bold">Заказ</span>
                                        <h3 class="text-xl font-black text-gray-900 dark:text-white">#{{ $order->getKey() }}</h3>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <div class="text-right">
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Итого</p>
                                            <p class="text-xl font-black text-indigo-600 dark:text-indigo-400">{{ number_format($order->getTotalPrice(), 0, '.', ' ') }} ₽</p>
                                        </div>
                                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $order->getStatus() === 'completed' ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' : 'bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400' }}">
                                        {{ $order->getStatus() }}
                                    </span>
                                    </div>
                                </div>

                                <hr class="my-4 border-gray-100 dark:border-gray-800">

                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            {{ $order->getAddress()?->getName() ?? 'Адрес не указан' }}
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            Доставка: {{ $order->getDeliveryDate() ?? 'Дата не назначена' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
