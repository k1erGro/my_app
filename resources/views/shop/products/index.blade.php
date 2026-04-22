@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 mt-5 py-8">
        <div class="flex items-center justify-between mb-8 pb-4 border-b border-gray-200">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Товары</h1>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 mt-5 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($products as $product)

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group flex flex-col transition hover:shadow-lg hover:border-gray-200">

                    <div class="aspect-w-16 aspect-h-10 bg-gray-50 flex items-center justify-center overflow-hidden border-b border-gray-100">
                        @if($product->hasMedia('products'))
                            <img src="{{ $product->getFirstMediaUrl('products') }}" alt="{{ $product->getName() }}" class="w-full h-full object-contain object-center group-hover:scale-105 transition-transform duration-300 ease-in-out p-4">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 p-6">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
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
                        @can('view', Auth::user())
                            <div>
                                <a href="{{ route('admin.product.edit', $product) }}" class="text-blue-600 hover:text-blue-900 ">Изменить</a>
                                <form method="POST" action="{{ route('admin.product.destroy', $product->getKey()) }}">
                                    @csrf
                                    @method('delete')
                                    <button class="text-red-600 hover:text-red-900">Удалить</button>
                                </form>
                            </div>
                        @endcan
                    </div>

                </div>
            @endforeach
        </div>

        <div class="mt-12 pt-6 border-t border-gray-200">
            {{ $products->links() }}
        </div>
    </div>
@endsection
