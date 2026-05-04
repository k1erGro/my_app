@extends('layouts.main')
@section('content')
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <nav class="flex mb-8 text-sm font-medium text-gray-500">
                    <a href="/" class="hover:text-blue-600">Главная</a>
                    <svg class="w-5 h-5 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"></path>
                    </svg>
                    <a href="{{ route('catalog.index') }}" class="hover:text-blue-600">Каталог</a>
                    <svg class="w-5 h-5 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"></path>
                    </svg>
                    <span class="text-gray-900">{{ $product->getName() }}</span>
                </nav>
                @can('view', Auth::user())
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.product.edit', $product) }}"
                           class="h-10 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition shadow-sm text-sm font-medium">
                            Редактировать
                        </a>
                        <form method="POST" action="{{ route('admin.product.destroy', $product) }}"
                              onsubmit="return confirm('Вы уверены, что хотите удалить этот товар?')">
                            @csrf
                            @method('delete')
                            <button
                                class="inline-flex items-center h-10 px-4 py-2 bg-white border border-red-200 text-red-600 rounded-md hover:bg-red-50 transition shadow-sm text-sm font-medium">
                                Удалить
                            </button>
                        </form>
                    </div>
                @endcan
            </div>
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 lg:items-start">
                <div class="flex flex-col">
                    <div
                        class="w-full aspect-w-1 aspect-h-1 bg-gray-100 rounded-2xl overflow-hidden border border-gray-100 shadow-inner">
                        @if($product->hasMedia('products'))
                            <img src="{{ $product->getFirstMediaUrl('products') }}" alt="{{ $product->getName() }}"
                                 class="w-full h-full object-center object-contain p-8">
                        @else
                            <div class="flex items-center justify-center h-96 text-gray-400">
                                <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                    <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">{{ $product->getName() }}</h1>

                    <div class="mt-3">
                        <h2 class="sr-only">Информация о цене</h2>
                        <p class="text-4xl font-bold text-blue-600">{{ $product->getPrice() }} ₽</p>
                    </div>

                    <div class="mt-6">
                        <h3 class="sr-only">Описание</h3>
                        <div class="text-base text-gray-700 space-y-4 leading-relaxed">
                            {{ $product->getDescription() ?? 'Не указано' }}
                        </div>
                    </div>

                    <div class="mt-10 ">
                        <h2 id="details-heading" class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-4">
                            В наличии</h2>

                        @foreach($product->getAddresses() as $address)
                            <div class="text-base text-gray-700 space-y-4 leading-relaxed">
                                {{ $address->getName() }} - {{ $address->pivot->product_quantity }} шт
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-10 flex sm:flex-col1">
                        <form method="POST" action="{{ route('cart.add') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->getKey() }}">
                            <button type="submit"
                                    class="max-w-xs flex-1 bg-blue-600 border border-transparent rounded-xl py-4 px-8 flex items-center justify-center text-base font-bold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition shadow-lg uppercase tracking-wider">
                                Добавить в корзину
                            </button>
                        </form>


                        <button type="button"
                                class="ml-4 py-3 px-3 rounded-xl flex items-center justify-center text-gray-400 hover:bg-gray-100 hover:text-red-500 transition">
                            <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span class="sr-only">В избранное</span>
                        </button>
                    </div>


                </div>
            </div>
            <section aria-labelledby="details-heading" class="mt-12 border-t border-gray-200 pt-8">
                <h2 id="details-heading" class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-4">
                    Характеристики</h2>

                @if(!empty($data))
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4">
                        @foreach($data as $property => $value)
                            <div
                                class="flex justify-between border-b border-gray-200 pb-2 transition hover:bg-gray-100 px-2 rounded">
                                <span class="text-gray-500 text-sm font-medium">{{ $property }}</span>
                                <span class="text-gray-500 text-sm font-medium">{{ $value }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-6 bg-white rounded-xl border border-dashed border-gray-300">
                        <p class="text-gray-400 text-sm italic">Характеристики не указаны</p>
                    </div>
                @endif

            </section>

            <section aria-labelledby="details-heading" class="mt-12 border-t border-gray-200 pt-8">
                <h2 id="details-heading" class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-4">
                    Отзывы</h2>

                @if(!$product->getReviews()->isEmpty())
                    <div class="grid grid-cols-1 gap-x-12 gap-y-4 ">
                        @foreach($product->getReviews() as $review)
                            <div class="bg-gray-300 p-3 border rounded-2xl">
                                <div class="flex justify-between">
                                    <span
                                        class="text-blue-500 text-sm font-medium">{{ $review->getUser()->getFirstName() }}</span>
                                    <span>{{ $review->getRating() }} </span>
                                </div>
                                <p>{{ $review->getReview() }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-6 bg-white rounded-xl border border-dashed border-gray-300">
                        <p class="text-gray-400 text-sm italic">Здесь пока пусто...</p>
                    </div>
                @endif
                @if(!$hasReview)
                    <form action="{{ route('review.store') }}" method="POST">
                        @csrf
                        <input name="product_id" type="hidden" value="{{ $product->getKey() }}">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Поставьте оценку товару</label>
                            <select name="rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <label class="block text-sm font-medium text-gray-700">Оставьте отзыв о товаре</label>
                            <textarea required name="review"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border"></textarea>
                        </div>
                        <button type="submit"
                                class="mt-1 flex-1 bg-blue-600 border border-transparent rounded-xl py-2 px-4 flex items-center justify-center text-base font-bold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition shadow-lg uppercase tracking-wider">
                            Оставить отзыв
                        </button>
                    </form>
                @endif
                    <form action="{{ route('review.update', $product->getKey()) }}" method="POST">
                        @csrf
                        @method('patch')
                        <input name="product_id" type="hidden" value="{{ $product->getKey() }}">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Поставьте оценку товару</label>
                            <select name="rating" >
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <label class="block text-sm font-medium text-gray-700">Оставьте отзыв о товаре</label>
                            <textarea required name="review"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border"></textarea>
                        </div>
                        <button type="submit"
                                class="mt-1 flex-1 bg-blue-600 border border-transparent rounded-xl py-2 px-4 flex items-center justify-center text-base font-bold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition shadow-lg uppercase tracking-wider">
                            Редактировать отзыв
                        </button>
                    </form>
            </section>
        </div>
    </div>

@endsection
