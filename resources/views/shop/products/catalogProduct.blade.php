@extends('layouts.main')
@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Каталог</h1>
        @can('create-categories')
            <a href="{{ route('admin.category.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Добавить категорию
            </a>
        @endcan
        <div class="flex gap-4 mb-6 mt-5">
            <a href="{{ route('catalog.product', ['subCategory' => $subCategory, 'sort' => 'rating_desc']) }}"
               class="px-4 py-2 {{ request('sort') == 'rating_desc' ? 'bg-blue-100' : 'bg-white' }} border rounded shadow-sm hover:bg-gray-50">
                Сначала высокий рейтинг
            </a>
            <a href="{{ route('catalog.product', ['subCategory' => $subCategory, 'sort' => 'rating_asc']) }}"
               class="px-4 py-2 {{ request('sort') == 'rating_asc' ? 'bg-blue-100' : 'bg-white' }} border rounded shadow-sm hover:bg-gray-50">
                Сначала низкий рейтинг
            </a>
        </div>
        <div>
            <livewire:catalog-component :subCategory="$subCategory"/>
        </div>
        <div class="grid mt-5 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach($products as $product)
                <div
                    class="group bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    <a href="{{ route('product.show', $product->getSlug()) }}">

                        <div class="aspect-square bg-white flex items-center justify-center">
                            @if($product->hasMedia('products'))
                                <img src="{{ $product->getFirstMediaUrl('products') }}"
                                     alt="{{ $product->getName() }}"
                                     class="h-40 object-contain group-hover:scale-110 transition-transform">
                            @else
                                <p>Картинка не найдена</p>
                            @endif
                        </div>
                        <div class="p-4 border-t border-gray-100">
                            <div class="flex justify-between">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $product->getName() }}</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-yellow-400">★</span>
                                    <span class="ml-1 text-sm font-medium text-gray-600">
                                        {{ round($product->reviews_avg_rating, 1) ?? 0 }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-end justify-between border-t border-gray-100 pt-4 mt-auto">
                                <p class="text-2xl font-extrabold text-blue-600">
                                    {{ $product->getPrice() }} ₽
                                </p>
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->getKey() }}">
                                    <button class="px-5 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md
                                            hover:bg-blue-700 active:scale-95 transition duration-200 shadow-sm">
                                        Купить
                                    </button>
                                </form>
                            </div>

                            <div>
                                @can('edit-categories')
                                    <a href="{{ route('admin.product.edit', $product->getSlug()) }}"
                                       class="text-blue-600 hover:text-blue-900 ">Изменить</a>
                                @endcan
                                @can('delete-categories')
                                    <form method="POST"
                                          action="{{ route('admin.product.destroy', $product->getKey()) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="text-red-600 hover:text-red-900">Удалить</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection
