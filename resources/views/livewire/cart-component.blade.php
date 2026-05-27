<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Ваша корзина</h1>

    @if($items->isEmpty())
        <div class="text-center py-12">
            <p class="text-xl text-gray-500">В корзине пока пусто...</p>
            <a href="{{ route('catalog.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">Перейти к покупкам</a>
        </div>
    @else
        <div class="flex flex-col lg:flex-row gap-8">
            <div class="lg:w-2/3">
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-4 w-12 text-center">
                                <input type="checkbox" wire:model.live="selectAll" class="rounded text-blue-600 focus:ring-blue-500 h-4 w-4 cursor-pointer">
                            </th>
                            <th class="px-6 py-4 font-semibold text-gray-700">Товар</th>
                            <th class="px-6 py-4 font-semibold text-gray-700">Кол-во</th>
                            <th class="px-6 py-4 font-semibold text-gray-700">Цена</th>
                            <th class="px-6 py-4"></th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @foreach($items as $item)
                            <tr wire:key="item-{{ $item->getKey() }}">
                                <td class="px-6 py-4 text-center">
                                    <input type="checkbox" wire:model.live="selectedItems" value="{{ $item->getKey() }}" class="rounded text-blue-600 focus:ring-blue-500 h-4 w-4 cursor-pointer">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <img src="{{ $item->getProduct()->getFirstMediaUrl('product_images') }}" class="w-16 h-16 object-cover rounded mr-4" alt="">
                                        <div>
                                            <p class="font-bold text-gray-800">{{ $item->getProduct()->getName() }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center border rounded-lg w-max">
                                        <button wire:click="decrement({{ $item->getKey() }})" class="px-3 py-1 hover:bg-gray-100" {{ $item->getQuantity() <= 1 ? 'disabled' : '' }}>-</button>
                                        <span class="px-4 py-1 border-x">{{ $item->getQuantity() }}</span>
                                        <button wire:click="increment({{ $item->getKey() }})" class="px-3 py-1 hover:bg-gray-100">+</button>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium">
                                    {{ $item->getProduct()->getPrice() * $item->getQuantity() }} ₽
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button wire:click="delete({{ $item->getKey() }})" class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="lg:w-1/3">
                <div class="bg-gray-50 p-6 rounded-lg shadow-inner">
                    <h2 class="text-xl font-bold mb-4">Итого</h2>
                    <div class="flex justify-between mb-2">
                        <span>Выбрано товаров ({{ $totalQuantity }})</span>
                        <span>{{ $totalPrice }} ₽</span>
                    </div>
                    <div class="flex justify-between mb-4">
                        <span>Доставка</span>
                        <span class="text-green-600 font-medium">Бесплатно</span>
                    </div>
                    <hr class="mb-4">
                    <div class="flex justify-between text-lg font-bold mb-6">
                        <span>К оплате</span>
                        <span>{{ $totalPrice }} ₽</span>
                    </div>

                    <form action="{{ route('orders.store') }}" method="post">
                        @csrf

                        @foreach($items as $item)
                            @if(in_array((string)$item->getKey(), $selectedItems))
                                <input name="product_id[]" type="hidden" value="{{ $item->getProduct()->getKey() }}">
                                <input name="quantity[]" type="hidden" value="{{ $item->getQuantity() }}">
                                <input name="price[]" type="hidden" value="{{ $item->getProduct()->getPrice() }}">
                            @endif
                        @endforeach

                        <button type="submit"
                                @if(empty($selectedItems)) disabled @endif
                                class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                            Оформить заказ
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
