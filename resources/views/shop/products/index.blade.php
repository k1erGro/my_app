@extends('layouts.main')

@section('content')
    <div class="max-w-[1600px] mx-auto px-6 py-12">
        <div class="flex items-center justify-between mb-8 pb-4 border-b border-gray-200 dark:border-gray-800">
            <h1 class="text-4xl font-black uppercase tracking-tighter text-gray-900 dark:text-white">Товары</h1>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-md border border-gray-200 dark:border-gray-800 overflow-hidden group flex flex-col transition-all duration-300 hover:shadow-xl hover:border-indigo-200 dark:hover:border-indigo-800">
                    <!-- Изображение -->
                    <div class="aspect-square bg-gray-100 dark:bg-gray-800 flex items-center justify-center overflow-hidden">
                        @if($product->hasMedia('products'))
                            <img src="{{ $product->getFirstMediaUrl('products') }}" alt="{{ $product->getName() }}"
                                 class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 dark:text-gray-600">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Информация о товаре -->
                    <div class="p-5 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-black uppercase tracking-tight text-gray-900 dark:text-white mb-1 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition">
                                <a href="{{ route('product.show', $product) }}">
                                    {{ $product->getName() }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2 mb-4 h-10">
                                {{ $product->getDescription() ?? 'Описание отсутствует' }}
                            </p>
                        </div>

                        <div class="flex items-end justify-between border-t border-gray-100 dark:border-gray-800 pt-4 mt-auto">
                            <p class="text-xl font-black text-indigo-600 dark:text-indigo-400">
                                {{ number_format($product->getPrice(), 0, '.', ' ') }} ₽
                            </p>
                            <form action="{{ route('cart.add') }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->getKey() }}">
                                <button class="px-4 py-2 bg-gray-900 dark:bg-white text-white dark:text-gray-900 text-xs font-bold rounded-full hover:bg-indigo-600 hover:text-white transition shadow-md active:scale-95">
                                    Купить
                                </button>
                            </form>
                        </div>

                        @can('view', Auth::user())
                            <div class="flex gap-3 mt-3 pt-2 border-t border-gray-100 dark:border-gray-800 text-xs font-medium">
                                <a href="{{ route('admin.product.edit', $product) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800">Изменить</a>
                                <form method="POST" action="{{ route('admin.product.destroy', $product->getKey()) }}" class="inline" onsubmit="return confirm('Удалить товар?')">
                                    @csrf
                                    @method('delete')
                                    <button class="text-red-600 dark:text-red-400 hover:text-red-800">Удалить</button>
                                </form>
                            </div>
                        @endcan
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12 pt-6 border-t border-gray-200 dark:border-gray-800">
            {{ $products->links() }}
        </div>
    </div>
@endsection
