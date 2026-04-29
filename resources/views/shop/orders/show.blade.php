@extends('layouts.main')
@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('orders.index') }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                К списку заказов
            </a>
            <div class="px-3 py-1 rounded-full text-xs font-bold uppercase bg-blue-100 text-blue-700">
                {{ $order->getStatus() }}
            </div>
        </div>

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
            <div class="bg-gray-50 p-6 border-b border-gray-100">
                <h2 class="text-2xl font-extrabold text-gray-900">Заказ №{{ $order->getKey() }}</h2>
            </div>

            <div class="p-6">
                <div class="grid sm:grid-cols-2 gap-8 mb-8">
                    <div>
                        <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Адрес доставки</h4>
                        <p class="text-gray-900 font-medium">{{ $order->getAddress()->getName() ?? 'Не указан' }}</p>
                    </div>
                    <div>
                        <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Ожидаемая дата</h4>
                        <p class="text-gray-900 font-medium">{{ $order->getDeliveryDate() ?? 'Будет уточнено' }}</p>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-6">
                    <h4 class="text-lg font-bold text-gray-900 mb-4">Состав заказа</h4>
                    <div class="space-y-4">
                        @foreach($order->getProducts() as $item)
                            <div class="flex justify-between items-center p-3 rounded-lg hover:bg-gray-50 transition">
                                <div class="flex items-center">
                                    <div class="h-12 w-12 bg-gray-100 rounded-md flex items-center justify-center text-gray-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-bold text-gray-900">{{ $item->getName() }}</p>
                                        <p class="text-xs text-gray-500">Кол-во: 1 шт.</p>
                                    </div>
                                </div>
                                <div class="text-sm font-bold text-gray-900">
                                    {{ number_format($item->pivot->price, 0, '.', ' ') }} ₽
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-8 border-t border-gray-100 pt-6">
                    <div class="flex justify-between items-center text-xl font-black text-gray-900">
                        <span>Итого к оплате</span>
                        <span class="text-blue-600">{{ number_format($order->getTotalPrice(), 0, '.', ' ') }} ₽</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
