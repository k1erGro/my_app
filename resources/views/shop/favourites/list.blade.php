@extends('layouts.main')
@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Избранное</h1>
        </div>

        @if(!Auth::check())
            <div class="text-center py-20 bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="mb-4">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-900">Требуется авторизация</h2>
                <p class="mt-2 text-gray-500 text-sm">Войдите в профиль, чтобы отслеживать избранное.</p>
                <a href="{{ route('show.login') }}"
                   class="mt-6 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition">
                    Авторизоваться
                </a>
            </div>
        @else
            <div class="grid mt-5 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($favourites as $favorite)
                    <div
                        class="group bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <a href="{{ route('product.show', $favorite->getProduct()->getSlug()) }}">
                            <div class="flex justify-end p-2">
                                <form action="{{ route('favourites.delete', $favorite->getKey()) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="text-red-700" type="submit">Крестик</button>
                                </form>
                            </div>
                            <div class="aspect-square bg-white flex items-center justify-center">
                                @if($favorite->getProduct()->hasMedia('products'))
                                    <img src="{{ $favorite->getProduct()->getFirstMediaUrl('products') }}"
                                         alt="{{ $favorite->getProduct()->getName() }}"
                                         class="h-40 object-contain group-hover:scale-110 transition-transform">
                                @else
                                    <p>Картинка не найдена</p>
                                @endif
                            </div>
                            <div class="p-4 border-t border-gray-100">
                                <div class="flex justify-between">
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $favorite->getProduct()->getName() }}</h3>
                                    <div class="bg-yellow-200 p-1 rounded-2xl">
                                        {{ round($favorite->getProduct()->getReviews()->avg('rating'), 1) }}
                                    </div>
                                </div>
                                <div class="flex items-end justify-between border-t border-gray-100 pt-4 mt-auto">
                                    <p class="text-2xl font-extrabold text-blue-600">
                                        {{ $favorite->getProduct()->getPrice() }} ₽
                                    </p>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $favorite->getProduct()->getKey() }}">
                                        <button class="px-5 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md
                                            hover:bg-blue-700 active:scale-95 transition duration-200 shadow-sm">
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
