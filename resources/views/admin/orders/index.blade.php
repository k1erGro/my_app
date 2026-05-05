@extends('layouts.admin')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">Список заказов</h2>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                <th class="px-5 py-3">№ заказа</th>
                <th class="px-5 py-3">Стоимость заказа</th>
                <th class="px-5 py-3">Дата доставки</th>
                <th class="px-5 py-3">Адрес</th>
                <th class="px-5 py-3">Статус</th>
                <th class="px-5 py-3 text-right">Действия</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @foreach($orders as $order)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $order->getKey() }}</p>
                    </td>

                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $order->getTotalPrice() }}</p>
                    </td>

                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $order->getDeliveryDate() }}</p>
                    </td>

                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $order->getAddress()->getName() === null ? 'Нет адреса' : $order->getAddress()->getName() }}</p>
                    </td>

                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $order->getStatus() === 'completed' ? 'Завершен' : ($order->getStatus() === 'draft' ? 'Черновик' : 'В процессе') }}</p>
                    </td>

                    <td class="px-5 py-5 text-right text-sm">
                        <a href="{{ route('admin.orders.edit', $order->getKey()) }}" class="text-blue-600 hover:text-blue-900 ">Изменить</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $orders->links() }}
    </div>
@endsection
