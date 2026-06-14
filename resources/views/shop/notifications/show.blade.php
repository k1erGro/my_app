@extends('layouts.main')

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-12">
        <div class="mb-6">
            <a href="{{ route('notifications.list') }}" class="text-gray-500 hover:text-indigo-600 inline-flex items-center gap-2 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Назад к списку
            </a>
        </div>

        @if($notification->data['type'] == 'product_entrance')
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                <div class="p-6 md:p-8">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300">
                            Уведомление
                        </span>
                            <h1 class="text-3xl md:text-4xl font-black uppercase tracking-tighter text-gray-900 dark:text-white mt-4">
                                {{ $notification->data['product_name'] }}
                            </h1>
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $notification->created_at->format('d.m.Y H:i') }}
                        </div>
                    </div>

                    <div class="mt-6 border-t border-gray-100 dark:border-gray-800 pt-6">
                        <p class="text-gray-700 dark:text-gray-300 text-lg">
                            Здравствуйте, <strong class="text-gray-900 dark:text-white">{{ $user->getFullName() }}</strong>!
                        </p>
                        <p class="text-gray-700 dark:text-gray-300 text-lg mt-2">
                            В магазине появился новый товар <strong class="text-gray-900 dark:text-white">{{ $notification->data['product_name'] }}</strong>
                        </p>
                        <p class="text-gray-700 dark:text-gray-300 text-lg mt-2">
                            Цена: <strong class="text-indigo-600 dark:text-indigo-400">{{ number_format($notification->data['price'], 0, '.', ' ') }} ₽</strong>
                        </p>
                    </div>

                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="{{ route('product.show', $notification->data['product_slug']) }}"
                           class="inline-flex items-center px-6 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-black uppercase tracking-widest rounded-xl hover:bg-indigo-600 dark:hover:bg-indigo-500 hover:text-white transition shadow-md">
                            Посмотреть товар
                        </a>

                        @if(is_null($notification->read_at))
                            <form action="{{ route('notification.mark-read', $notification->getKey()) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-xl bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    Отметить как прочитанное
                                </button>
                            </form>
                        @else
                            <span class="inline-flex items-center px-6 py-3 border border-gray-200 dark:border-gray-800 text-gray-400 dark:text-gray-500 font-medium rounded-xl bg-gray-50 dark:bg-gray-800">
                            Прочитано {{ $notification->read_at->diffForHumans() }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        @elseif($notification->data['type'] == 'product_arrival')
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                <div class="p-6 md:p-8">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300">
                            Уведомление
                        </span>
                            <h1 class="text-3xl md:text-4xl font-black uppercase tracking-tighter text-gray-900 dark:text-white mt-4">
                                {{ $notification->data['product_name'] }}
                            </h1>
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $notification->created_at->format('d.m.Y H:i') }}
                        </div>
                    </div>

                    <div class="mt-6 border-t border-gray-100 dark:border-gray-800 pt-6">
                        <p class="text-gray-700 dark:text-gray-300 text-lg">
                            Здравствуйте, <strong class="text-gray-900 dark:text-white">{{ $user->getFullName() }}</strong>!
                        </p>
                        <p class="text-gray-700 dark:text-gray-300 text-lg mt-2">
                            В магазине новое поступление товара <strong class="text-gray-900 dark:text-white">{{ $notification->data['product_name'] }}</strong>
                        </p>
                    </div>

                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="{{ route('product.show', $notification->data['product_slug']) }}"
                           class="inline-flex items-center px-6 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-black uppercase tracking-widest rounded-xl hover:bg-indigo-600 dark:hover:bg-indigo-500 hover:text-white transition shadow-md">
                            Посмотреть товар
                        </a>

                        @if(is_null($notification->read_at))
                            <form action="{{ route('notification.mark-read', $notification->getKey()) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-xl bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    Отметить как прочитанное
                                </button>
                            </form>
                        @else
                            <span class="inline-flex items-center px-6 py-3 border border-gray-200 dark:border-gray-800 text-gray-400 dark:text-gray-500 font-medium rounded-xl bg-gray-50 dark:bg-gray-800">
                            Прочитано {{ $notification->read_at->diffForHumans() }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
