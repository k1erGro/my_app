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
                    <label class="block text-sm font-medium text-gray-700">Дата доставки</label>
                    <input type="text" name="delivery_date" value="{{ $order->getDeliveryDate() }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border @error('last_name') border-red-500 @enderror">
                    @error('delivery_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Адрес</label>
                    <select name="address_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">

                    <option value="{{ $order->getAddress()->getKey() }}">{{ $order->getAddress()->getName() }}</option>

                    @foreach($addresses as $address)
                            <option value="{{ $address->getKey() }}">{{ $address->getName() }}</option>
                        @endforeach

                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Статус</label>
                    <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">

                        <option value="{{ $order->getStatus() }}">{{ $order->getStatus() === 'completed' ? 'Завершен' : ($order->getStatus() === 'draft' ? 'Черновик' : 'В процессе') }}</option>


                        <option value="draft">Черновик</option>
                        <option value="in_progress">В процессе</option>
                        <option value="completed">Завершен</option>

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
