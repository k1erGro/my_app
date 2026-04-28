@extends('layouts.main')
@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Ваши заказы</h1>

        @if(!Auth::check())
            <div class="text-center py-12">
                <a href="{{ route('show.login') }}" class="mt-4 inline-block text-blue-600 hover:underline">Для просмотра заказов авторизуйтесь</a>
            </div>
        @else
            <div class="flex flex-col gap-8">

                    @foreach($orders as $order)
                    <a href="{{ route('orders.show', $order->getKey()) }}">
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
                    </a>
                @endforeach

            </div>
        @endif
    </div>
@endsection
