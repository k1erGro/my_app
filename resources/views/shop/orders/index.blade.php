@extends('layouts.main')
@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Ваши заказы</h1>
            <span class="bg-gray-100 text-gray-600 py-1 px-3 rounded-full text-sm font-medium">
                Всего: {{ $orders->count() }}
            </span>
        </div>

        @if(!Auth::check())
            <div class="text-center py-20 bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="mb-4">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-900">Требуется авторизация</h2>
                <p class="mt-2 text-gray-500 text-sm">Войдите в профиль, чтобы отслеживать свои покупки.</p>
                <a href="{{ route('show.login') }}"
                   class="mt-6 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition">
                    Авторизоваться
                </a>
            </div>
        @else
            <div class="grid gap-6">
                @foreach($orders as $order)
                    <a href="{{ route('orders.show', $order->getKey()) }}" class="block group">
                        <div
                            class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg hover:border-blue-300 transition-all duration-200">
                            <div class="p-6">
                                <div class="flex flex-wrap justify-between items-center gap-4 mb-4">
                                    <div>
                                        <span
                                            class="text-sm text-gray-500 uppercase tracking-wider font-semibold">Заказ</span>
                                        <h3 class="text-lg font-bold text-gray-900">#{{ $order->getKey() }}</h3>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <div class="text-right">
                                            <p class="text-sm text-gray-500 text-nowrap">Итого</p>
                                            <p class="text-lg font-bold text-blue-600">{{ number_format($order->getTotalPrice(), 0, '.', ' ') }}
                                                ₽</p>
                                        </div>
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $order->getStatus() === 'completed' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                            {{ $order->getStatus() }}
                                        </span>
                                    </div>
                                </div>

                                <hr class="my-4 border-gray-100">

                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="space-y-2 text-sm text-gray-600">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            {{ $order->getAddress()->getName() ?? 'Адрес не указан' }}
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
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
