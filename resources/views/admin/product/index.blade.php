@extends('layouts.admin')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">Список товаров</h2>
        @can('create-coupons')
            <a href="{{ route('admin.product.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Добавить товар
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
    <div class="mb-4 flex flex-wrap items-center gap-3">
        <form method="GET" action="{{ route('admin.product.index') }}" class="flex items-center gap-2 flex-1 max-w-md">
            <input type="text" name="search" placeholder="Поиск..."
                   value="{{ request('search') }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition">
                Найти
            </button>
            @if(request('search'))
                <a href="{{ route('admin.product.index', ['sort' => request('sort'), 'direction' => request('direction')]) }}"
                   class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-md hover:bg-gray-300 transition">
                    Сбросить
                </a>
            @endif
        </form>
    </div>
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
            <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                <th class="px-5 py-3">
                    <a href="{{ route('admin.product.index', array_merge(request()->only(['search']), ['sort' => 'name', 'direction' => request('sort') == 'name' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                       class="flex items-center gap-1 hover:text-blue-700">
                        Название товара
                        @if(request('sort') == 'name')
                            <span>{{ request('direction') == 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </a>
                </th>
                <th class="px-5 py-3">
                    <a href="{{ route('admin.product.index', array_merge(request()->only(['search']), ['sort' => 'price', 'direction' => request('sort') == 'price' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                       class="flex items-center gap-1 hover:text-blue-700">
                        Цена
                        @if(request('sort') == 'price')
                            <span>{{ request('direction') == 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </a>
                </th>
                <th class="px-5 py-3 text-right">
                    <a href="{{ route('admin.product.index', array_merge(request()->only(['search']), ['sort' => 'id', 'direction' => request('sort') == 'id' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                       class="flex items-center justify-end gap-1 hover:text-blue-700">
                        Действия
                        @if(request('sort') == 'id')
                            <span>{{ request('direction') == 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </a>
                </th>
            </tr>
            </thead>
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
                        @can('edit-coupons')
                            <a href="{{ route('admin.product.edit', $product) }}"
                               class="text-blue-600 hover:text-blue-900 ">Изменить</a>
                        @endcan
                        @can('delete-coupons')
                            <form method="POST" action="{{ route('admin.product.destroy', $product->getKey()) }}">
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
        {{ $products->links() }}
    </div>
@endsection
