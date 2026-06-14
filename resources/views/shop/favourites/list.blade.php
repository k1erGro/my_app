@extends('layouts.main')
@section('content')
    <div class="max-w-[1600px] mx-auto px-6 py-12">
        <h1 class="text-4xl font-black uppercase tracking-tighter text-gray-900 dark:text-white mb-8">Избранное</h1>

        @if(!Auth::check())
            <div class="text-center py-20 bg-gray-50 dark:bg-gray-900 rounded-3xl">
                <div class="mb-4">
                    <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-black text-gray-900 dark:text-white">Требуется авторизация</h2>
                <p class="mt-2 text-gray-500 dark:text-gray-400">Войдите в профиль, чтобы отслеживать избранное.</p>
                <a href="{{ route('show.login') }}"
                   class="mt-6 inline-flex items-center px-8 py-3 bg-indigo-600 text-white font-bold rounded-full hover:bg-indigo-700 transition shadow-md">
                    Авторизоваться
                </a>
            </div>
        @elseif($favourites->isEmpty())
            <div class="text-center py-20 bg-gray-50 dark:bg-gray-900 rounded-3xl">
                <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                <p class="text-xl text-gray-500 dark:text-gray-400 mt-4">В избранном пока пусто...</p>
                <a href="{{ route('catalog.index') }}" class="mt-4 inline-block text-indigo-600 hover:underline">Перейти в каталог</a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($favourites as $favorite)
                    <div class="group bg-white dark:bg-gray-900 rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 relative">
                        <!-- Кнопка удаления из избранного (крестик в углу) -->
                        <form action="{{ route('favourites.delete', $favorite->getKey()) }}" method="POST" class="absolute top-3 right-3 z-10">
                            @csrf
                            @method('delete')
                            <button type="submit" class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm p-2 rounded-full text-red-500 hover:text-red-700 hover:bg-white transition shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </form>

                        <a href="{{ route('product.show', $favorite->getProduct()->getSlug()) }}" class="block">
                            <div class="aspect-square bg-gray-100 dark:bg-gray-800 flex items-center justify-center overflow-hidden p-4">
                                @if($favorite->getProduct()->hasMedia('products'))
                                    <img src="{{ $favorite->getProduct()->getFirstMediaUrl('products') }}"
                                         alt="{{ $favorite->getProduct()->getName() }}"
                                         class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <svg class="w-16 h-16 text-gray-300 dark:text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                @endif
                            </div>
                            <div class="p-5">
                                <div class="flex justify-between items-start gap-2 mb-2">
                                    <h3 class="text-lg font-black uppercase tracking-tight text-gray-900 dark:text-white line-clamp-2">
                                        {{ $favorite->getProduct()->getName() }}
                                    </h3>
                                    @php
                                        $avgRating = $favorite->getProduct()->getReviews()->avg('rating');
                                    @endphp
                                    @if($avgRating)
                                        <div class="flex items-center gap-1 bg-yellow-100 dark:bg-yellow-900/30 px-2 py-1 rounded-full">
                                            <span class="text-yellow-700 dark:text-yellow-300 text-sm font-bold">{{ number_format($avgRating, 1) }}</span>
                                            <svg class="w-3 h-3 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex items-end justify-between mt-4 pt-4 border-t border-gray-100 dark:border-gray-800">
                                    <p class="text-2xl font-black text-indigo-600 dark:text-indigo-400">
                                        {{ number_format($favorite->getProduct()->getPrice(), 0, ',', ' ') }} ₽
                                    </p>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $favorite->getProduct()->getKey() }}">
                                        <button class="px-5 py-2 bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-bold rounded-full hover:bg-indigo-600 hover:text-white transition shadow-md active:scale-95">
                                            Купить
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
