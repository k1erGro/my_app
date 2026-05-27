@extends('layouts.main')

@section('content')
    <div class="max-w-2xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Задать вопрос по заказу №{{ $order->id }}</h1>

        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <form action="{{ route('order-report.store') }}" method="POST" class="space-y-4">
                @csrf

                <input type="hidden" name="order_id" value="{{ $order->id }}">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Тема вопроса</label>
                    <input type="text" name="title" required placeholder="например: Задержка доставки, Изменение состава..."
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ваш вопрос</label>
                    <textarea name="description" rows="5" required placeholder="Опишите вашу проблему подробно..."
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <a href="{{ route('orders.show', $order->id) }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg text-sm hover:bg-gray-50">
                        Отмена
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">
                        Отправить вопрос
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
