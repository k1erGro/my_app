@extends('layouts.main')

@section('content')
    <div class="max-w-[1600px] mx-auto px-6 py-12">
        <h1 class="text-4xl font-black uppercase tracking-tighter text-gray-900 dark:text-white mb-2">Результаты поиска</h1>

        @if(!empty($query))
            <p class="text-gray-600 dark:text-gray-400 mb-8 text-lg">
                Вы искали: <span class="font-bold text-gray-900 dark:text-white">"{{ $query }}"</span>
                (Найдено товаров: {{ $products->total() }})
            </p>
        @endif

        <div class="border-t border-gray-200 dark:border-gray-800 my-6"></div>

        @if($products->isEmpty())
            <div class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-12 text-center shadow-sm">
                <div class="text-gray-400 dark:text-gray-500 text-5xl mb-4">🔍</div>
                <h3 class="text-xl font-black uppercase tracking-tighter text-gray-800 dark:text-white mb-2">Ничего не найдено</h3>
                <p class="text-gray-500 dark:text-gray-400 max-w-md mx-auto">
                    К сожалению, по вашему запросу ничего не нашлось. Проверьте правильность написания или попробуйте использовать другие ключевые слова.
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="group bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                        <a href="{{ route('product.show', $product->getSlug()) }}" class="flex flex-col h-full">
                            <div class="aspect-square bg-gray-100 dark:bg-gray-800 flex items-center justify-center p-4">
                                @if($product->hasMedia('products'))
                                    <img src="{{ $product->getFirstMediaUrl('products') }}"
                                         alt="{{ $product->getName() }}"
                                         class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <svg class="w-16 h-16 text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                @endif
                            </div>

                            <div class="p-5 border-t border-gray-100 dark:border-gray-800 flex flex-col flex-grow justify-between">
                                <div class="flex justify-between items-start gap-2 mb-3">
                                    <h3 class="text-base font-black uppercase tracking-tight text-gray-900 dark:text-white line-clamp-2">
                                        {{ $product->getName() }}
                                    </h3>
                                    @php
                                        $avgRating = $product->reviews_avg_rating ?? 0;
                                    @endphp
                                    @if($avgRating)
                                        <div class="flex items-center gap-1 bg-yellow-100 dark:bg-yellow-900/30 px-2 py-0.5 rounded-full">
                                            <span class="text-yellow-600 dark:text-yellow-300 text-xs font-bold">{{ number_format($avgRating, 1) }}</span>
                                            <svg class="w-3 h-3 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex items-end justify-between border-t border-gray-100 dark:border-gray-800 pt-4 mt-auto">
                                    <p class="text-xl font-black text-indigo-600 dark:text-indigo-400">
                                        {{ number_format($product->getPrice(), 0, '.', ' ') }} ₽
                                    </p>
                                    <form action="{{ route('cart.add') }}" method="POST" onclick="event.stopPropagation();" class="inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->getKey() }}">
                                        <button class="px-4 py-2 bg-gray-900 dark:bg-white text-white dark:text-gray-900 text-xs font-bold rounded-full hover:bg-indigo-600 hover:text-white transition shadow-md active:scale-95">
                                            Купить
                                        </button>
                                    </form>
                                </div>

                                @if(auth()->user() && (auth()->user()->can('edit-categories') || auth()->user()->can('delete-categories')))
                                    <div class="flex gap-3 mt-3 pt-2 border-t border-gray-100 dark:border-gray-800 text-xs font-medium" onclick="event.stopPropagation(); event.preventDefault();">
                                        @can('edit-categories')
                                            <a href="{{ route('admin.product.edit', $product->getSlug()) }}" class="text-indigo-600 hover:text-indigo-800">Изменить</a>
                                        @endcan
                                        @can('delete-categories')
                                            <form method="POST" action="{{ route('admin.product.destroy', $product->getKey()) }}" class="inline">
                                                @csrf
                                                @method('delete')
                                                <button class="text-red-600 hover:text-red-800">Удалить</button>
                                            </form>
                                        @endcan
                                    </div>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 pt-6 border-t border-gray-200 dark:border-gray-800">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
