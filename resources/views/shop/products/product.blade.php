@extends('layouts.main')
@section('content')
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('message') }}
                </div>
            @endif
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

                    @if(!$product->getAddresses()->isEmpty())
                        <div class="mt-10 ">
                            <h2 id="details-heading"
                                class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-4">
                                В наличии</h2>

                            @foreach($product->getAddresses() as $address)
                                <div class="text-base text-gray-700 space-y-4 leading-relaxed">
                                    {{ $address->getName() }} - {{ $address->pivot->product_quantity }} шт
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="mt-10">
                            <h2>Товара нет в наличии</h2>
                        </div>
                    @endif

                    @if($isSubscribed)
                        <form action="{{ route('product.cancel-subscribe', $product) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="mt-4 inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                                Отписаться от уведомлений
                            </button>
                        </form>
                    @elseif(!$isSubscribed)
                        <form action="{{ route('product.subscribe', $product) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Уведомить о поступлении
                            </button>
                        </form>
                    @endif

                    <div class="mt-10 flex sm:flex-col1">
                        <form method="POST" action="{{ route('cart.add') }}">
                            @csrf
                            @foreach($product->getAddresses() as $address)
                                <input type="hidden" name="addresses[]" value="{{ $address }}">
                            @endforeach
                            <input type="hidden" name="product_id" value="{{ $product->getKey() }}">
                            <button type="submit"
                                    class="max-w-xs flex-1 bg-blue-600 border border-transparent rounded-xl py-4 px-8 flex items-center justify-center text-base font-bold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition shadow-lg uppercase tracking-wider">
                                Добавить в корзину
                            </button>
                        </form>

                        <form action="{{ route('favourites.store', $product->getKey()) }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->getKey() }}">
                            <button type="submit"
                                    class="ml-4 py-3 px-3 rounded-xl flex items-center justify-center text-gray-400 hover:bg-gray-100 hover:text-red-500 transition">
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                <span class="sr-only">В избранное</span>
                            </button>
                        </form>
                    </div>


                </div>
            </div>
            <section aria-labelledby="details-heading" class="mt-12 border-t border-gray-200 pt-10">
                <div class="flex items-center space-x-3 mb-8">
                    <h2 id="details-heading" class="text-sm font-bold text-gray-900 uppercase tracking-widest">
                        Технические характеристики
                    </h2>
                </div>

                @if(!empty($data))
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-2">
                        @foreach($data as $property => $value)
                            <div
                                class="group flex items-center justify-between py-3 border-b border-gray-100 hover:border-blue-200 transition-colors">
                                <dt class="text-sm text-gray-500 font-medium group-hover:text-gray-900 transition-colors">
                                    {{ $property }}
                                </dt>
                                <dd class="text-sm text-gray-900 font-semibold bg-gray-50 px-3 py-1 rounded-md group-hover:bg-blue-50 group-hover:text-blue-700 transition-all">
                                    {{ $value }}
                                </dd>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div
                        class="flex flex-col items-center justify-center py-12 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                        <p class="text-gray-400 text-sm font-medium">Спецификации пока не добавлены</p>
                    </div>
                @endif
            </section>

            <section class="mt-12 pt-12 border-t border-gray-200">

                <div
                    class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 pb-4 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900">
                        Отзывы покупателей
                        <span class="text-lg font-normal text-gray-400">({{ $reviews->count() }})</span>
                    </h2>

                    <form action="{{ url()->current() }}" method="GET" id="reviews-sort-form"
                          class="flex items-center gap-2">
                        @foreach(request()->except('sort_reviews') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach

                        <label for="sort_reviews" class="text-sm font-medium text-gray-500 whitespace-nowrap">Сортировать:</label>
                        <select name="sort_reviews" id="sort_reviews"
                                onchange="document.getElementById('reviews-sort-form').submit();"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 p-2.5 pr-8 cursor-pointer font-medium">
                            <option value="newest" {{ $currentSort == 'newest' ? 'selected' : '' }}>Сначала новые
                            </option>
                            <option value="oldest" {{ $currentSort == 'oldest' ? 'selected' : '' }}>Сначала старые
                            </option>
                            <option value="rating_high" {{ $currentSort == 'rating_high' ? 'selected' : '' }}>С высокой
                                оценкой
                            </option>
                            <option value="rating_low" {{ $currentSort == 'rating_low' ? 'selected' : '' }}>С низкой
                                оценкой
                            </option>
                        </select>
                    </form>
                </div>

                @if($reviews->isEmpty())
                    <div
                        class="text-center py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-200 text-gray-500 mb-8">
                        <span class="text-3xl block mb-2">⭐</span>
                        У этого товара пока нет отзывов. Станьте первым, кто оставит свое мнение!
                    </div>
                @else
                    <div class="grid grid-cols-1 gap-4 mb-8">
                        @foreach($reviews as $review)
                            <div
                                class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm transition hover:shadow-md">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h4 class="font-bold text-gray-900 text-base">
                                            {{ $review->user->name ?? 'Анонимный покупатель' }}
                                        </h4>

                                        <div class="flex items-center text-yellow-400 mt-1 space-x-0.5">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-4 h-4 text-gray-200" fill="currentColor"
                                                         viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>

                                    <span class="text-xs text-gray-400 font-medium">
                                        {{ $review->created_at->format('d.m.Y') }}
                                    </span>
                                </div>

                                <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-line">
                                    {{ $review->review }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if(Auth::check())
                    @if(!$hasReview)
                        <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Оставить отзыв</h3>
                            <form action="{{ route('review.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <input name="product_id" type="hidden" value="{{ $product->getKey() }}">

                                <div class="flex items-center gap-4">
                                    <label class="text-sm font-medium text-gray-700">Ваша оценка:</label>
                                    <select name="rating" required
                                            class="bg-white border border-gray-200 rounded-xl p-2 text-sm focus:ring-blue-500">
                                        <option value="5">5 звезд</option>
                                        <option value="4">4 звезды</option>
                                        <option value="3">3 звезды</option>
                                        <option value="2">2 звезды</option>
                                        <option value="1">1 звезда</option>
                                    </select>
                                </div>

                                <textarea required name="review"
                                          placeholder="Поделитесь вашими впечатлениями от использования товара..."
                                          rows="4"
                                          class="w-full rounded-xl border-gray-200 p-4 border text-sm focus:ring-blue-500 focus:border-blue-500"></textarea>

                                <button type="submit"
                                        class="bg-blue-600 text-white rounded-xl py-3 px-8 font-bold hover:bg-blue-700 transition uppercase text-xs tracking-widest">
                                    Опубликовать отзыв
                                </button>
                            </form>
                        </div>
                    @else
                        <div
                            class="p-4 bg-blue-50 text-blue-700 text-sm font-medium rounded-2xl border border-blue-100 text-center">
                            Вы уже оставили отзыв к этому товару. Спасибо за ваше мнение!
                        </div>
                    @endif
                @else
                    <div
                        class="p-4 bg-yellow-50 text-yellow-800 text-sm font-medium rounded-2xl border border-yellow-100 text-center">
                        Чтобы оставить отзыв, пожалуйста, <a href="{{ route('show.login') }}"
                                                             class="text-blue-600 underline hover:text-blue-800">войдите
                            в свой аккаунт</a>.
                    </div>
                @endif
            </section>

            <section aria-labelledby="questions-heading" class="mt-12 border-t border-gray-200 pt-8">
                <h2 id="questions-heading" class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-6">
                    Вопрос-ответ
                </h2>

                @if(!$product->getQuestions()->isEmpty())
                    <div class="space-y-6 mb-10">
                        @foreach($product->getQuestions() as $question)
                            <div class="bg-white p-6 border border-gray-100 rounded-2xl shadow-sm question-item"
                                 data-question-id="{{ $question->getKey() }}">

                                <div class="question-title font-bold text-2xl mb-5">{{ $question->getTitle() }}</div>

                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex items-center space-x-3">
                                        <img class="h-12 w-12 rounded-full object-cover"
                                             src="{{ $question->getUser()->getFirstMediaUrl('avatars', 'preview') }}"
                                             alt="Аватар">
                                        <span
                                            class="block text-gray-900 font-bold">{{ $question->getUser()->getFirstName() }}</span>
                                        @if(Auth::user()->getKey() === $question->getUser()->getKey())
                                            <button
                                                class="edit-question-btn text-gray-400 hover:text-blue-600 transition"
                                                title="Редактировать">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                     viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                <div class="question-text">{{ $question->getDescription() }}</div>

                                <div class="edit-question-form hidden mt-4 pt-4 border-t border-gray-200">
                                    <form action="{{ route('question.update', $question->getKey()) }}" method="POST"
                                          class="space-y-4">
                                        @csrf
                                        @method('patch')
                                        <input name="product_id" type="hidden" value="{{ $product->getKey() }}">
                                        <input required name="title" type="text" placeholder="Заголовок вопроса"
                                               class="w-full rounded-xl border-gray-200 p-4 border"
                                               value="{{ $question->getTitle() }}">
                                        <textarea name="description"
                                                  class="w-full rounded-xl border-gray-300 p-4 border"
                                                  rows="3">{{ $question->getDescription() }}</textarea>
                                        <div class="flex space-x-3">
                                            <button type="submit"
                                                    class="bg-blue-600 text-white rounded-xl py-2 px-6 font-bold hover:bg-blue-700 transition text-sm">
                                                Сохранить
                                            </button>
                                            <button type="button"
                                                    class="cancel-edit-btn text-gray-500 hover:text-gray-700 font-medium text-sm">
                                                Отмена
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <a href="{{ route('question.show', $question->getKey()) }}"
                                   class="inline-block mt-3 text-blue-600 hover:text-blue-800 text-sm">
                                    Посмотреть ответы
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if(Auth::check())
                    <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Задать вопрос</h3>
                        <form action="{{ route('question.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input name="product_id" type="hidden" value="{{ $product->getKey() }}">
                            <input required name="title" type="text" placeholder="Заголовок вопроса"
                                   class="w-full rounded-xl border-gray-200 p-4 border">
                            <textarea required name="description" placeholder="Вопрос"
                                      class="w-full rounded-xl border-gray-200 p-4 border"></textarea>
                            <button type="submit"
                                    class="bg-blue-600 text-white rounded-xl py-3 px-8 font-bold hover:bg-blue-700 transition uppercase text-xs tracking-widest">
                                Опубликовать
                            </button>
                        </form>
                    </div>
                @endif
            </section>

        </div>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
