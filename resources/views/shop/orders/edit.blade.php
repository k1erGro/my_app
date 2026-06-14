@extends('layouts.main')
@section('content')
    <div class="max-w-4xl mx-auto px-6 py-12" x-data="{
    deliveryType: 'pickup',
    showNewAddress: false,
    selectedWarehouse: '',
    selectedSavedAddress: '',
    newAddress: ''
}">
        <!-- Хлебные крошки и заголовок -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-4xl font-black uppercase tracking-tighter text-gray-900 dark:text-white">Оформление заказа</h1>
            <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Назад
            </a>
        </div>

        <!-- Ошибки и успехи -->
        @if ($errors->any())
            <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-6 py-4 rounded-2xl mb-6">
                {{ $errors->first() }}
            </div>
        @endif
        @if(session('success'))
            <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-6 py-4 rounded-2xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-md overflow-hidden">
            <div class="p-6 md:p-8">
                <form action="{{ route('orders.update', $order->getKey()) }}" method="POST" id="order-form" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="space-y-6">
                        <!-- Тип доставки (Alpine.js) -->
                        <div>
                            <label class="block text-sm font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-3">Способ получения</label>
                            <div class="flex flex-wrap gap-6">
                                <label class="inline-flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="type_delivery" value="pickup" x-model="deliveryType" class="text-indigo-600 focus:ring-indigo-500 h-4 w-4">
                                    <span class="text-gray-700 dark:text-gray-300 font-medium">Самовывоз</span>
                                </label>
                                <label class="inline-flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="type_delivery" value="delivery" x-model="deliveryType" class="text-indigo-600 focus:ring-indigo-500 h-4 w-4">
                                    <span class="text-gray-700 dark:text-gray-300 font-medium">Доставка</span>
                                </label>
                            </div>
                        </div>

                        <!-- Блок самовывоза (склады) -->
                        <div x-show="deliveryType === 'pickup'" x-cloak>
                            <label class="block text-sm font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-3">Выберите склад</label>
                            <select name="warehouse_id" x-model="selectedWarehouse" class="w-full rounded-xl border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3 focus:ring-2 focus:ring-indigo-500">
                                <option value="">Выберите склад</option>
                                @foreach($warehouses as $warehouse)
                                    <option value="{{ $warehouse->getKey() }}">{{ $warehouse->getName() }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Блок доставки (адреса) -->
                        <div x-show="deliveryType === 'delivery'" x-cloak>
                            <label class="block text-sm font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-3">Адрес доставки</label>

                            <!-- Ранее использованные адреса -->
                            <div x-show="!showNewAddress">
                                <select name="saved_address_id" x-model="selectedSavedAddress" class="w-full rounded-xl border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3 focus:ring-2 focus:ring-indigo-500">
                                    <option value="">Выберите ранее использованный адрес</option>
                                    @foreach($usedAddresses as $address)
                                        <option value="{{ $address->getKey() }}">{{ $address->getName() }}</option>
                                    @endforeach
                                </select>
                                <button type="button" @click="showNewAddress = true" class="mt-2 text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 font-medium">+ Новый адрес</button>
                            </div>

                            <!-- Новый адрес -->
                            <div x-show="showNewAddress">
                                <input type="text" name="delivery_address" x-model="newAddress" placeholder="Введите новый адрес доставки" class="w-full rounded-xl border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3 focus:ring-2 focus:ring-indigo-500">
                                <button type="button" @click="showNewAddress = false" class="mt-2 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700">Отмена</button>
                            </div>
                        </div>

                        <!-- Дата доставки (показываем только для доставки) -->
                        <div x-show="deliveryType === 'delivery'" x-cloak>
                            <label class="block text-sm font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-3">Дата доставки</label>
                            <input type="date" name="delivery_date" class="w-full rounded-xl border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3 focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>

                    <!-- Состав заказа (без изменений) -->
                    <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-800">
                        <h4 class="text-xl font-black uppercase tracking-tight text-gray-900 dark:text-white mb-4">Состав заказа</h4>
                        <div class="space-y-4">
                            @foreach($order->getProducts() as $product)
                                <div class="flex flex-wrap items-center justify-between gap-4 p-4 bg-gray-50 dark:bg-gray-800/50 rounded-xl">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center overflow-hidden">
                                            @if($product->hasMedia('products'))
                                                <img src="{{ $product->getFirstMediaUrl('products') }}" alt="{{ $product->getName() }}" class="w-full h-full object-cover">
                                            @else
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900 dark:text-white">{{ $product->getName() }}</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Кол-во: 1 шт.</p>
                                        </div>
                                    </div>
                                    <div class="text-lg font-black text-indigo-600 dark:text-indigo-400">
                                        {{ number_format($product->pivot->price, 0, '.', ' ') }} ₽
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </form>

                <!-- Купон -->
                <form action="{{ route('coupon.apply', $order->getKey()) }}" method="POST" class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-800 flex flex-col sm:flex-row gap-3">
                    @csrf
                    <input type="text" name="coupon" placeholder="Введите купон" class="flex-1 rounded-xl border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3 focus:ring-2 focus:ring-indigo-500">
                    <button type="submit" class="px-6 py-3 bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200 font-bold rounded-xl hover:bg-indigo-600 hover:text-white transition">Применить</button>
                </form>

                <!-- Итого и кнопка оформления -->
                <div class="mt-6 pt-6 border-t border-gray-100 dark:border-gray-800">
                    <div class="flex justify-between items-center text-2xl font-black">
                        <span class="text-gray-900 dark:text-white">Итого:</span>
                        <span class="text-indigo-600 dark:text-indigo-400">{{ number_format($order->getTotalPrice(), 0, '.', ' ') }} ₽</span>
                    </div>
                    <button type="submit" form="order-form" class="mt-6 w-full py-4 bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-black uppercase tracking-widest rounded-full hover:bg-indigo-600 dark:hover:bg-indigo-500 hover:text-white transition shadow-lg">
                        Оформить заказ
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>
@endsection
