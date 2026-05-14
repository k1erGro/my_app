@extends('layouts.main')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="mb-6">
            <a href="{{ route('notifications.list') }}" class="text-blue-600 hover:text-blue-800 inline-flex items-center gap-2">
                ← Назад к списку
            </a>
        </div>
        @if($notification->data['type'] == 'product_entrance')
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="p-8">
                <div class="flex items-start justify-between">
                    <div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        Уведомление
                    </span>
                        <h1 class="text-3xl font-bold text-gray-900 mt-4">
                            {{ $notification->data['product_name'] }}
                        </h1>
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $notification->created_at->format('d.m.Y H:i') }}
                    </div>
                </div>

                <div class="mt-6 border-t border-gray-100 pt-6">
                    <p class="text-gray-700 text-lg">
                        Здравствуйте, <strong>{{ $user->getFullName() }}</strong>!
                    </p>
                    <p class="text-gray-700 text-lg mt-2">
                        В магазине появился новый товар <strong>{{ $notification->data['product_name'] }}</strong>
                    </p>
                    <p class="text-gray-700 text-lg mt-2">
                        Цена: <strong>{{ $notification->data['price'] }} ₽</strong>
                    </p>
                </div>

                <div class="mt-8 flex gap-4">
                    <a href="{{ route('product.show', $notification->data['product_slug']) }}"
                       class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition">
                        Посмотреть товар
                    </a>

                    @if(is_null($notification->read_at))
                        <form action="{{ route('notification.mark-read', $notification->getKey()) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 transition">
                                Отметить как прочитанное
                            </button>
                        </form>
                    @else
                        <span class="inline-flex items-center px-6 py-3 border border-gray-200 text-base font-medium rounded-md text-gray-400 bg-gray-50">
                        Прочитано {{ $notification->read_at->diffForHumans() }}
                    </span>
                    @endif
                </div>
            </div>
        </div>
        @elseif($notification->data['type'] == 'product_arrival')
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="p-8">
                    <div class="flex items-start justify-between">
                        <div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        Уведомление
                    </span>
                            <h1 class="text-3xl font-bold text-gray-900 mt-4">
                                {{ $notification->data['product_name'] }}
                            </h1>
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $notification->created_at->format('d.m.Y H:i') }}
                        </div>
                    </div>

                    <div class="mt-6 border-t border-gray-100 pt-6">
                        <p class="text-gray-700 text-lg">
                            Здравствуйте, <strong>{{ $user->getFullName() }}</strong>!
                        </p>
                        <p class="text-gray-700 text-lg mt-2">
                            В магазине новое поступление товара <strong>{{ $notification->data['product_name'] }}</strong>
                        </p>
                    </div>

                    <div class="mt-8 flex gap-4">
                        <a href="{{ route('product.show', $notification->data['product_slug']) }}"
                           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition">
                            Посмотреть товар
                        </a>

                        @if(is_null($notification->read_at))
                            <form action="{{ route('notification.mark-read', $notification->getKey()) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 transition">
                                    Отметить как прочитанное
                                </button>
                            </form>
                        @else
                            <span class="inline-flex items-center px-6 py-3 border border-gray-200 text-base font-medium rounded-md text-gray-400 bg-gray-50">
                        Прочитано {{ $notification->read_at->diffForHumans() }}
                    </span>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
