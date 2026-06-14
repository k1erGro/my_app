@extends('layouts.main')
@section('content')
    <div class="max-w-4xl mx-auto px-6 py-12">
        <!-- Хлебные крошки и статус -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
            <a href="{{ route('orders.index') }}"
               class="inline-flex items-center gap-2 text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                К списку заказов
            </a>
            <div
                class="px-4 py-1.5 rounded-full text-xs font-bold uppercase bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300">
                {{ $order->getStatus() == 'draft'  ? 'Черновик' : ($order->getStatus() == 'in progress' ? 'В процессе' : 'Завершен') }}
            </div>
        </div>

        <!-- Шапка заказа -->
        <div class="bg-gray-50 dark:bg-gray-800/50 p-6 border-b border-gray-100 dark:border-gray-800 rounded-2xl">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <h2 class="text-2xl font-black uppercase tracking-tighter text-gray-900 dark:text-white">Заказ
                    №{{ $order->getKey() }}</h2>
                <div class="flex flex-wrap gap-2">
                    <!-- Редактировать -->
                    <a href="{{ route('orders.edit', $order->getKey()) }}"
                       class="group inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-900/20 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                        <span>Редактировать</span>
                    </a>

                    <!-- Отменить заказ -->
                    <form action="{{ route('orders.delete', $order->getKey()) }}" method="POST"
                          onsubmit="return confirm('Вы уверены, что хотите отменить заказ?')" class="inline">
                        @csrf
                        @method('delete')
                        <button type="submit"
                                class="group inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            <span>Отменить</span>
                        </button>
                    </form>

                    <!-- Задать вопрос -->
                    <a href="{{ route('order-report.create', $order->id) }}"
                       class="inline-flex items-center gap-1.5 px-5 py-2 text-sm font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 shadow-md transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Задать вопрос</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Тело заказа -->
        <div class="p-6 md:p-8">
            <!-- Адрес и дата -->
            <div class="grid sm:grid-cols-2 gap-8 mb-8">
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-2">Адрес
                        доставки</h4>
                    <p class="text-gray-900 dark:text-white font-medium">{{ $order->getAddress()?->getName() ?? 'Не указан' }}</p>
                </div>
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-2">
                        Ожидаемая дата</h4>
                    <p class="text-gray-900 dark:text-white font-medium">{{ $order->getDeliveryDate() ?? 'Будет уточнено' }}</p>
                </div>
            </div>

            <!-- Применённый купон -->
            @if(!is_null($order->getCoupon()))
                <div class="border-t border-gray-100 dark:border-gray-800 pt-6 mb-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Был применен код: <span
                            class="font-bold text-indigo-600 dark:text-indigo-400">{{ $order->getCoupon()->getCode() }}</span>
                    </p>
                </div>
            @endif

            <!-- Состав заказа -->
            <div class="border-t border-gray-100 dark:border-gray-800 pt-6">
                <h4 class="text-xl font-black uppercase tracking-tighter text-gray-900 dark:text-white mb-4">Состав
                    заказа</h4>
                <div class="space-y-4">
                    @foreach($order->getProducts() as $item)
                        <div
                            class="flex flex-wrap items-center justify-between gap-4 p-4 bg-gray-50 dark:bg-gray-800/50 rounded-xl">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center text-gray-400 overflow-hidden">
                                    @if($item->hasMedia('products'))
                                        <img src="{{ $item->getFirstMediaUrl('products') }}"
                                             alt="{{ $item->getName() }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $item->getName() }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Кол-во: 1 шт.</p>
                                </div>
                            </div>
                            <div class="text-sm font-black text-indigo-600 dark:text-indigo-400">
                                {{ number_format($item->pivot->price, 0, '.', ' ') }} ₽
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Итого -->
            <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-800">
                <div class="flex justify-between items-center text-xl font-black">
                    <span class="text-gray-900 dark:text-white">Итого к оплате</span>
                    <span class="text-indigo-600 dark:text-indigo-400">{{ number_format($order->getTotalPrice(), 0, '.', ' ') }} ₽</span>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
