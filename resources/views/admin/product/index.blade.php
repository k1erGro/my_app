@extends('layouts.admin')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">Список товаров</h2>
        <a href="{{ route('admin.product.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Добавить товар
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                <th class="px-5 py-3">Название товара</th>
                <th class="px-5 py-3">Цена</th>
                <th class="px-5 py-3 text-right">Действия</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @foreach($products as $product)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-5 py-5">
                        <a href="{{ route('admin.product.show', $product->getSlug()) }}">
                            <p class="font-medium">{{ $product->getName() }}</p>
                        </a>
                    </td>

                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $product->getPrice() }}</p>
                    </td>

                    <td class="px-5 py-5 text-right text-sm">
                        <a href="{{ route('admin.product.edit', $product) }}" class="text-blue-600 hover:text-blue-900 ">Изменить</a>
                        <form method="POST" action="{{ route('admin.product.destroy', $product->getKey()) }}">
                            @csrf
                            @method('delete')
                            <button class="text-red-600 hover:text-red-900">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $products->links() }}
    </div>
@endsection
