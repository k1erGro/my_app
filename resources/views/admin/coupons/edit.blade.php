@extends('layouts.admin')
@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Редактировать купон</h2>
            <a href="{{ route('admin.coupons.list') }}" class="text-gray-500 hover:text-gray-700 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Назад к списку
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg p-8">
            <form action="{{ route('admin.coupons.update', $coupon->getKey()) }}" method="POST" class="space-y-4">
                @csrf
                @method('patch')
                <div>
                    <label class="block text-sm font-medium text-gray-700">Код купона</label>
                    <input type="text" name="code" value="{{ $coupon->getCode() }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border @error('code') border-red-500 @enderror">
                    @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Тип купона</label>

                    <div class="flex gap-4">
                        <label class="flex items-center">
                            <input type="radio" name="type" value="fixed" @checked($coupon->getType() == 'fixed')
                            class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Фиксированный</span>
                        </label>

                        <label class="flex items-center">
                            <input type="radio" name="type" value="percent" @checked($coupon->getType() == 'percent')
                            class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Процентный</span>
                        </label>
                    </div>

                    @error('type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Скидка</label>
                    <input type="text" name="value" value="{{ $coupon->getValue() }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border @error('value') border-red-500 @enderror">
                    @error('value') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Минимальная сумма заказа</label>
                    <input type="text" name="min_order_amount" value="{{ $coupon->getMinOrderAmount() }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border @error('min_order_amount') border-red-500 @enderror">
                    @error('min_order_amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Ограничения использований</label>
                    <input type="radio" name="is_disposable" value="1" @checked($coupon->getIsDisposable() == 1)
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">Одноразовый
                    <input type="radio" name="is_disposable" value="0" @checked($coupon->getIsDisposable() == 0)
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">Многоразовый
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Лимит использований</label>
                    <input type="text" name="usage_limit" value="{{ $coupon->getUsageLimit() }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border @error('usage_limit') border-red-500 @enderror">
                    @error('usage_limit') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <label class="block text-sm font-medium text-gray-700">Выберите для какой подкатегории будет
                    скидка</label>
                <select name="sub_category_id">
                    @if(!$coupon->getSubCategories()->isEmpty())
                        @foreach($coupon->getSubCategories() as $subCategory)

                            <option
                                value="{{ $subCategory->getKey() }}">{{ $subCategory->getName() }}</option>
                        @endforeach
                    @else
                        <option
                            value="">Нет скидки на категорию
                        </option>
                    @endif
                    @foreach($subCategories as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>

                <label class="block text-sm font-medium text-gray-700">Выберите для какого товара будет скидка</label>
                <select name="product_id">
                    @if(!$coupon->getProducts()->isEmpty())
                        @foreach($coupon->getProducts() as $product)
                            <option
                                value="{{ $product->getKey() }}">{{ $product->getName() }}</option>
                        @endforeach
                    @else
                        <option
                            value="">Нет скидки на товар
                        </option>
                    @endif
                    @foreach($products as $id => $name)
                        <option
                            value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>

                <div class="pt-4">
                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 transition duration-200 font-bold shadow-lg">
                        Создать купон
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
