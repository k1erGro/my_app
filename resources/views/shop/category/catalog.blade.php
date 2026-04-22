@extends('layouts.main')
@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">{{ $title }}</h1>
        @can('create-categories')
            <a href="{{ route('admin.category.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Добавить категорию
            </a>
        @endcan
        @if($categories)
            <div class="grid mt-5 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($categories as $category)
                    <div class="group bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <a href="{{ route('catalog.show', $category->getSlug()) }}">

                        <div class="aspect-square bg-white flex items-center justify-center">
                            @if($category->hasMedia('category_images'))
                                <img src="{{ $category->getFirstMediaUrl('category_images') }}"
                                     alt="{{ $category->getName() }}"
                                     class="h-40 object-contain group-hover:scale-110 transition-transform">
                            @else
                                <p>Картинка не найдена</p>
                            @endif
                        </div>
                        <div class="p-4 border-t border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $category->getName() }}</h3>
                            <a href="{{ route('catalog.show', $category->getSlug()) }}"
                               class="inline-flex items-center text-blue-600 font-medium hover:text-blue-800">
                                Перейти
                                <svg class="w-4 h-4 ml-2" ...></svg>
                            </a>

                                <div>
                                    @can('edit-categories')
                                        <a href="{{ route('admin.category.edit', $category->getSlug()) }}" class="text-blue-600 hover:text-blue-900 ">Изменить</a>
                                    @endcan
                                    @can('delete-categories')
                                        <form method="POST" action="{{ route('admin.category.destroy', $category->getKey()) }}">
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

        @elseif($products)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mt-8">
                @foreach($products as $product)
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group flex flex-col transition hover:shadow-lg hover:border-gray-200">

                        <div
                            class="aspect-w-16 aspect-h-10 bg-gray-50 flex items-center justify-center overflow-hidden border-b border-gray-100">
                            @if($product->hasMedia('products'))
                                <img src="{{ $product->getFirstMediaUrl('products') }}"
                                     alt="{{ $product->getName() }}"
                                     class="w-full h-full object-contain object-center group-hover:scale-105 transition-transform duration-300 ease-in-out p-4">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 p-6">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <div class="p-6 flex-grow flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-blue-600 transition truncate">
                                    <a href="{{ route('catalog.product', $product) }}">
                                        {{ $product->getName() }}
                                    </a>
                                </h3>
                                <p class="text-sm text-gray-600 line-clamp-2 mb-4 h-10">
                                    {{ $product->getDescription() ?? 'Описание отсутствует' }}
                                </p>
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
                                    @can('edit-products')
                                        <a href="{{ route('admin.product.edit', $product) }}" class="text-blue-600 hover:text-blue-900 ">Изменить</a>
                                    @endcan
                                    @can('delete-products')
                                        <form method="POST" action="{{ route('admin.product.destroy', $product->getKey()) }}">
                                            @csrf
                                            @method('delete')
                                            <button class="text-red-600 hover:text-red-900">Удалить</button>
                                        </form>
                                    @endcan
                                </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <div class="mt-12 pt-6 border-t border-gray-200">
                {{ $products->links() }}
            </div>
        @endif
    </div>
    </div>

@endsection
