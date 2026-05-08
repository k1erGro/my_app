@extends('layouts.main')
@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Оформление заказа</h2>
            <a href="{{ route('shop.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Назад
            </a>
        </div>
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif
        <div class="bg-white shadow-md rounded-lg p-8">
            <form action="{{ route('orders.update', $order->getKey()) }}" method="POST" class="space-y-4"
                  enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div>
                    <label class="block text-sm font-medium text-gray-700">Тип доставки</label>
                    <input type="radio" checked name="type_delivery" value="pickup" required
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">Самовывоз
                    <input type="radio" name="type_delivery" value="delivery" required
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">Доставка
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-700">Адрес</label>

                    <div id="warehouse-block">
                        <label class="block text-sm font-medium text-gray-700">Выберите склад самовывоза</label>
                        <select name="warehouse_id" id="warehouse_select" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                            <option value="">Выберите склад</option>
                            @foreach($warehouses as $warehouse)
                                <option value="{{ $warehouse->getKey() }}">
                                    {{ $warehouse->getName() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div id="delivery-block" style="display: none;">
                        <div id="saved-address-block">
                            <select name="saved_address_id" id="saved_address_select" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                                <option value="">Выберите ранее использованный адрес</option>
                                @foreach($usedAddresses as $address)
                                    <option value="{{ $address->getKey() }}">{{ $address->getName() }}</option>
                                @endforeach
                            </select>
                            <button type="button" id="show-new-address-btn" class="mt-2 text-sm text-blue-600 hover:text-blue-800">+ Новый адрес</button>
                        </div>

                        <div id="new-address-block" style="display: none;">
                            <input type="text" name="delivery_address" id="delivery_address_input" placeholder="Введите новый адрес доставки" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                            <button type="button" id="cancel-new-address-btn" class="mt-2 text-sm text-gray-500 hover:text-gray-700">Отмена</button>
                        </div>
                    </div>
                </div>

                <div id="delivery-date-block">
                    <label>Дата доставки</label>
                    <input type="date" name="delivery_date" id="delivery_date_input" class="...">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Полная стоимость</label>
                    <input type="text" name="total_price" value="{{ $order->getTotalPrice() }}" required disabled
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">

                </div>

                <div class="border-t border-gray-100 pt-6">
                    <h4 class="text-lg font-bold text-gray-900 mb-4">Состав заказа</h4>
                    <div class="space-y-4">
                        @foreach($order->getProducts() as $product)
                            <div class="flex justify-between items-center p-3 rounded-lg hover:bg-gray-50 transition">
                                <div class="flex items-center">
                                    <div class="h-12 w-12 bg-gray-100 rounded-md flex items-center justify-center text-gray-400">
                                        @if($product->hasMedia('products'))
                                            <img src="{{ $product->getFirstMediaUrl('products') }}" alt="{{ $product->getName() }}" class="h-50 object-contain rounded-lg shadow-sm">
                                        @else
                                            <div class="w-48 h-48 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-bold text-gray-900">{{ $product->getName() }}</p>
                                        <p class="text-xs text-gray-500">Кол-во: 1 шт.</p>
                                    </div>
                                </div>
                                <div class="text-sm font-bold text-gray-900">
                                    {{ number_format($product->pivot->price, 0, '.', ' ') }} ₽
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 transition duration-200 font-bold shadow-lg">
                        Оформить заказ
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('/js/script.js') }}"></script>
@endsection
