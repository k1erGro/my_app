@extends('layouts.main')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Результаты поиска</h1>

        @if(!empty($query))
            <p class="text-gray-600 mb-8 text-lg">
                Вы искали: <span class="font-semibold text-gray-900">"{{ $query }}"</span>
                (Найдено товаров: {{ $products->total() }})
            </p>
        @endif

        <div class="border-t border-gray-200 my-6"></div>

        @if($products->isEmpty())
            <div class="bg-white border border-gray-200 rounded-xl p-12 text-center shadow-sm">
                <div class="text-gray-400 text-5xl mb-4">🔍</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Ничего не найдено</h3>
                <p class="text-gray-500 max-w-md mx-auto">
                    К сожалению, по вашему запросу ничего не нашлось. Проверьте правильность написания или попробуйте использовать другие ключевые слова.
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="group bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                        <a href="{{ route('product.show', $product->getSlug()) }}" class="flex flex-col h-full">

                            <div class="aspect-square bg-white flex items-center justify-center">
                                @if($product->hasMedia('products'))
                                    <img src="{{ $product->getFirstMediaUrl('products') }}"
                                         alt="{{ $product->getName() }}"
                                         class="h-40 object-contain group-hover:scale-110 transition-transform">
                                @else
                                    <p class="text-gray-400 text-sm">Картинка не найдена</p>
                                @endif
                            </div>

                            <div class="p-4 border-t border-gray-100 flex flex-col flex-grow justify-between">
                                <div class="flex justify-between items-start gap-2">
                                    <h3 class="text-lg font-semibold text-gray-800 line-clamp-2">{{ $product->getName() }}</h3>
                                    <div class="flex items-center shrink-0 mt-1">
                                        <span class="text-yellow-400">★</span>
                                        <span class="ml-1 text-sm font-medium text-gray-600">
                                            {{ isset($product->reviews_avg_rating) ? round($product->reviews_avg_rating, 1) : 0 }}
                                        </span>
                                    </div>
                                </div>

                                <div class="flex items-end justify-between border-t border-gray-100 pt-4 mt-4">
                                    <p class="text-2xl font-extrabold text-blue-600">
                                        {{ $product->getPrice() }} ₽
                                    </p>
                                    <form action="{{ route('cart.add') }}" method="POST" onclick="event.stopPropagation();">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->getKey() }}">
                                        <button class="px-5 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md
                                                hover:bg-blue-700 active:scale-95 transition duration-200 shadow-sm">
                                            Купить
                                        </button>
                                    </form>
                                </div>

                                @if(auth()->user() && (auth()->user()->can('edit-categories') || auth()->user()->can('delete-categories')))
                                    <div class="flex gap-4 mt-4 pt-2 border-t border-gray-50 text-sm" onclick="event.stopPropagation(); event.preventDefault();">
                                        @can('edit-categories')
                                            <a href="{{ route('admin.product.edit', $product->getSlug()) }}"
                                               class="text-blue-600 hover:text-blue-900">Изменить</a>
                                        @endcan
                                        @can('delete-categories')
                                            <form method="POST" action="{{ route('admin.product.destroy', $product->getKey()) }}" class="inline">
                                                @csrf
                                                @method('delete')
                                                <button class="text-red-600 hover:text-red-900">Удалить</button>
                                            </form>
                                        @endcan
                                    </div>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
