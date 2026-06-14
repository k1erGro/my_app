<div class="max-w-[1600px] mx-auto px-6 py-12">
    <h1 class="text-4xl font-black uppercase tracking-tighter mb-8 text-gray-900 dark:text-white">Ваша корзина</h1>

    @if($items->isEmpty())
        <div class="text-center py-20 bg-gray-50 dark:bg-gray-900 rounded-3xl">
            <p class="text-xl text-gray-500 dark:text-gray-400">В корзине пока пусто...</p>
            <a href="{{ route('catalog.index') }}" class="mt-6 inline-block px-8 py-3 bg-indigo-600 text-white font-bold rounded-full hover:bg-indigo-700 transition">
                Перейти к покупкам
            </a>
        </div>
    @else
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Список товаров -->
            <div class="lg:w-2/3 space-y-4">
                @foreach($items as $item)
                    <div wire:key="item-{{ $item->getKey() }}" class="bg-white dark:bg-gray-900 rounded-2xl shadow-md hover:shadow-xl transition-shadow p-4 md:p-6">
                        <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center">
                            <!-- Чекбокс -->
                            <div class="flex-shrink-0">
                                <input type="checkbox" wire:model.live="selectedItems" value="{{ $item->getKey() }}" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 h-5 w-5 cursor-pointer">
                            </div>

                            <!-- Изображение -->
                            <div class="flex-shrink-0">
                                <img src="{{ $item->getProduct()->getFirstMediaUrl('products') }}" class="w-20 h-20 object-cover rounded-xl bg-gray-100 dark:bg-gray-800" alt="">
                            </div>

                            <!-- Информация о товаре -->
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-lg text-gray-900 dark:text-white">{{ $item->getProduct()->getName() }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Артикул: {{ $item->getProduct()->getKey() }}</p>
                            </div>

                            <!-- Количество + цена + удаление -->
                            <div class="flex items-center gap-4 flex-wrap sm:flex-nowrap">
                                <div class="flex items-center border border-gray-200 dark:border-gray-700 rounded-full overflow-hidden">
                                    <button wire:click="decrement({{ $item->getKey() }})" class="px-3 py-1.5 hover:bg-gray-100 dark:hover:bg-gray-800 transition text-gray-600 dark:text-gray-300" {{ $item->getQuantity() <= 1 ? 'disabled' : '' }}>-</button>
                                    <span class="px-4 py-1.5 border-x border-gray-200 dark:border-gray-700 font-medium text-gray-900 dark:text-white">{{ $item->getQuantity() }}</span>
                                    <button wire:click="increment({{ $item->getKey() }})" class="px-3 py-1.5 hover:bg-gray-100 dark:hover:bg-gray-800 transition text-gray-600 dark:text-gray-300">+</button>
                                </div>

                                <div class="font-black text-xl text-indigo-600 dark:text-indigo-400 min-w-[100px] text-right">
                                    {{ number_format($item->getProduct()->getPrice() * $item->getQuantity(), 0, ',', ' ') }} ₽
                                </div>

                                <button wire:click="delete({{ $item->getKey() }})" class="text-red-500 hover:text-red-700 transition p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Блок итого -->
            <div class="lg:w-1/3">
                <div class="bg-gray-50 dark:bg-gray-900 rounded-2xl p-6 sticky top-24 border border-gray-200 dark:border-gray-800">
                    <h2 class="text-2xl font-black uppercase tracking-tighter mb-4 text-gray-900 dark:text-white">Итого</h2>

                    <div class="space-y-2 text-gray-600 dark:text-gray-300">
                        <div class="flex justify-between">
                            <span>Выбрано товаров:</span>
                            <span class="font-medium">{{ $totalQuantity }} шт.</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Сумма:</span>
                            <span class="font-medium">{{ number_format($totalPrice, 0, ',', ' ') }} ₽</span>
                        </div>
                        <div class="flex justify-between text-green-600 dark:text-green-400">
                            <span>Доставка:</span>
                            <span class="font-medium">Бесплатно</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-700 my-4"></div>

                    <div class="flex justify-between text-xl font-black mb-6 text-gray-900 dark:text-white">
                        <span>К оплате:</span>
                        <span class="text-indigo-600 dark:text-indigo-400">{{ number_format($totalPrice, 0, ',', ' ') }} ₽</span>
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
                                class="w-full py-4 bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-black uppercase tracking-widest rounded-full transition-all hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100">
                            Оформить заказ
                        </button>
                    </form>

                    <p class="text-xs text-center text-gray-500 dark:text-gray-400 mt-4">
                        Нажимая «Оформить заказ», вы соглашаетесь с условиями
                    </p>
                </div>
            </div>
        </div>
    @endif
</div>
