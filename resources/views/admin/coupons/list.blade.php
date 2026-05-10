@extends('layouts.admin')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">Список купонов</h2>
        @can('create-coupons')
            <a href="{{ route('admin.coupons.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Добавить купон
            </a>
        @endcan
    </div>
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg shadow-sm">
            <div class="flex items-center mb-2">
                <span class="font-bold">Внимание!</span>
            </div>
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                <th class="px-5 py-3">Купон</th>
                <th class="px-5 py-3">Тип</th>
                <th class="px-5 py-3">Значение</th>
                <th class="px-5 py-3">Минимальная сумма заказа</th>
                <th class="px-5 py-3">Одноразовый</th>
                <th class="px-5 py-3">Лимит использований</th>
                <th class="px-5 py-3">Количество использований</th>
                <th class="px-5 py-3 text-right">Действия</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @foreach($coupons as $coupon)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $coupon->getCode() }}</p>
                    </td>

                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $coupon->getType() == 'fixed' ? 'Фиксированный' : 'Процентный' }}</p>
                    </td>

                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $coupon->getValue() }}</p>
                    </td>

                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $coupon->getMinOrderAmount() }}</p>
                    </td>

                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $coupon->getIsDisposable() ? 'Одноразовый' : 'Многоразовый' }}</p>
                    </td>

                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $coupon->getUsageLimit() }}</p>
                    </td>

                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $coupon->getUsedcount() }}</p>
                    </td>

                    <td class="px-5 py-5 text-right text-sm">
                        @can('edit-coupons')
                            <a href="{{ route('admin.coupons.edit', $coupon->getKey()) }}"
                               class="text-blue-600 hover:text-blue-900 ">Изменить</a>
                        @endcan
                        @can('delete-coupons')
                            <form method="POST" action="{{ route('admin.coupons.delete', $coupon->getKey()) }}">
                                @csrf
                                @method('delete')
                                <button class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Вы уверены что хотите удалить данные?')">Удалить
                                </button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $coupons->links() }}
    </div>
@endsection
