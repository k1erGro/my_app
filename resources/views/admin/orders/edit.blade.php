@extends('layouts.admin')
@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Редактировать заказ</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Назад к списку
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg p-8">
            <form action="{{ route('admin.orders.update', $order->getKey()) }}" method="POST" class="space-y-4">
                @csrf
                @method('patch')

                <div>
                    <label class="block text-sm font-medium text-gray-700">Статус</label>
                    <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                        @switch($order->getStatus())
                            @case('completed')
                                <option value="completed" selected>Завершен</option>
                                <option value="in_progress">В процессе</option>
                                @break
                            @case('in_progress')
                                <option value="in_progress" selected>В процессе</option>
                                <option value="completed">Завершен</option>
                                @break
                            @default
                                <option value="">-- Нет статуса --</option>
                                <option value="in_progress">В процессе</option>
                                <option value="completed">Завершен</option>
                        @endswitch
                    </select>
                </div>


                <div class="pt-4">
                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 transition duration-200 font-bold shadow-lg">
                        Редактировать заказ
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
