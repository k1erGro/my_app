@extends('layouts.main')
@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Заказ №{{ $order->getKey() }}</h2>
            <a href="{{ route('shop.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Назад
            </a>
        </div>

        <div class="bg-white shadow-md p-5 rounded-lg overflow-hidden">
            <p>Номер заказа: {{ $order->getKey() }}</p>
            <p>Адрес получения: {{ $order->getAddress()->getName() === null ? 'Нет адреса' : $order->getAddress()->getName() }}</p>
            <p>Полная стоимость: {{ $order->getTotalPrice() }} руб.</p>
            <p>Дата получения: {{ $order->getDeliveryDate() === null ? 'Нет даты' : $order->getDeliveryDate() }}</p>
            <p>Статус: {{ $order->getStatus() }}</p>
            @foreach($order->getProducts() as $item)
                <p class="font-bold">{{ $item->getName() }} - {{ $item->pivot->price }}</p>
            @endforeach
        </div>
    </div>

@endsection
