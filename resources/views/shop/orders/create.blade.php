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

        <div class="bg-white shadow-md rounded-lg p-8">
            <form action="{{ route('orders.update', $order->getKey()) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div>
                    <label class="block text-sm font-medium text-gray-700">Адрес</label>
                    <select name="address_id" value="{{ old('address_id') }}" required>
                        @foreach($addresses as $address)
                            <option value="{{ $address->getKey() }}">{{ $address->getName() }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Дата доставки</label>
                    <input type="date" name="delivery_date" value="{{ old('delivery_date') }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border @error('l_name') border-red-500 @enderror">
                    @error('delivery_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Полная стоимость</label>
                    <input type="text" name="total_price" value="{{ $total_price }}" required disabled
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border @error('l_name') border-red-500 @enderror">
                    @error('delivery_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="pt-4">
                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 transition duration-200 font-bold shadow-lg">
                        Создать заказ
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
