@extends('layouts.main')
@section('content')
    <div class="bg-white dark:bg-gray-950">
        <div class="max-w-[1600px] mx-auto px-6 py-12">
            @if (session('error'))
                <div
                    class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-5 py-3 rounded-xl mb-6">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('message'))
                <div
                    class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-5 py-3 rounded-xl mb-6">
                    {{ session('message') }}
                </div>
            @endif
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg shadow-sm">
                        <div class="flex items-center mb-2">
                            <span class="font-bold">Внимание!</span>
                        </div>
                        <ul class="list-disc pl-5 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <div class="flex flex-wrap justify-between items-start gap-4 mb-6">
                <!-- Хлебные крошки -->
                <nav class="flex flex-wrap items-center text-sm font-medium text-gray-500 dark:text-gray-400">
                    <a href="/" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">Главная</a>
                    <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/>
                    </svg>
                    <a href="{{ route('catalog.index') }}"
                       class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">Каталог</a>
                    <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/>
                    </svg>
                    <span class="text-gray-900 dark:text-white font-bold">{{ $product->getName() }}</span>
                </nav>

                @can('view', Auth::user())
                    <div class="flex gap-3">
                        <a href="{{ route('admin.product.edit', $product) }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 font-bold rounded-xl hover:bg-indigo-100 dark:hover:bg-indigo-900/30 hover:text-indigo-700 transition text-sm">
                            Редактировать
                        </a>
                        <form method="POST" action="{{ route('admin.product.destroy', $product) }}"
                              onsubmit="return confirm('Вы уверены, что хотите удалить этот товар?')">
                            @csrf
                            @method('delete')
                            <button
                                class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-800 text-red-600 dark:text-red-400 font-bold rounded-xl hover:bg-red-50 dark:hover:bg-red-900/30 transition text-sm">
                                Удалить
                            </button>
                        </form>
                    </div>
                @endcan
            </div>

            <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 lg:items-start">
                <!-- Изображение -->
                <div class="flex flex-col">
                    <div
                        class="w-full aspect-square bg-gray-100 dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
                        @if($product->hasMedia('products'))
                            <img src="{{ $product->getFirstMediaUrl('products') }}" alt="{{ $product->getName() }}"
                                 class="w-full h-full object-contain p-8">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400 dark:text-gray-600">
                                <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Информация о товаре -->
                <div class="mt-10 lg:mt-0">
                    <h1 class="text-4xl font-black uppercase tracking-tighter text-gray-900 dark:text-white">{{ $product->getName() }}</h1>
                    <div class="mt-4">
                        <p class="text-3xl font-black text-indigo-600 dark:text-indigo-400">{{ number_format($product->getPrice(), 0, '.', ' ') }}
                            ₽</p>
                    </div>
                    <div class="mt-6">
                        <div class="text-base text-gray-700 dark:text-gray-300 space-y-4 leading-relaxed">
                            {{ $product->getDescription() ?? 'Не указано' }}
                        </div>
                    </div>

                    @if(!$product->getAddresses()->isEmpty())
                        <div class="mt-8">
                            <h2 class="text-sm font-bold uppercase tracking-wider text-gray-900 dark:text-white mb-3">В
                                наличии</h2>
                            @foreach($product->getAddresses() as $address)
                                <div class="text-sm text-gray-700 dark:text-gray-300 mb-1">
                                    {{ $address->getName() }} — {{ $address->pivot->product_quantity }} шт.
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div
                            class="mt-8 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-xl text-yellow-800 dark:text-yellow-300 text-sm">
                            Товара нет в наличии
                        </div>
                    @endif

                    @if(Auth::check())

                        <!-- Подписка на уведомления -->
                        @if($isSubscribed)
                            <form action="{{ route('product.cancel-subscribe', $product) }}" method="POST" class="mt-6">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-5 py-2 bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200 font-bold rounded-xl hover:bg-gray-300 transition">
                                    Отписаться от уведомлений
                                </button>
                            </form>
                        @elseif(!$isSubscribed)
                            <form action="{{ route('product.subscribe', $product) }}" method="POST" class="mt-6">
                                @csrf
                                <button type="submit"
                                        class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-md">
                                    Уведомить о поступлении
                                </button>
                            </form>
                        @endif

                        <!-- Кнопки "В корзину" и "Избранное" -->
                        <div class="mt-8 flex flex-wrap gap-4">
                            <form method="POST" action="{{ route('cart.add') }}" class="flex-1">
                                @csrf
                                @foreach($product->getAddresses() as $address)
                                    <input type="hidden" name="addresses[]" value="{{ $address }}">
                                @endforeach
                                <input type="hidden" name="product_id" value="{{ $product->getKey() }}">
                                <button type="submit"
                                        class="w-full py-4 bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-black uppercase tracking-widest rounded-full hover:bg-indigo-600 dark:hover:bg-indigo-500 hover:text-white transition shadow-md">
                                    Добавить в корзину
                                </button>
                            </form>
                            <form action="{{ route('favourites.store', $product->getKey()) }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->getKey() }}">
                                <button type="submit"
                                        class="p-4 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-400 hover:text-red-500 hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    <span class="sr-only">В избранное</span>
                                </button>
                            </form>
                        </div>
                    @else
                        <div
                            class="mt-5 p-4 bg-yellow-50 dark:bg-yellow-900/20 text-yellow-800 dark:text-yellow-300 text-sm font-medium rounded-2xl border border-yellow-100 dark:border-yellow-800 text-center">
                            Чтобы купить товар, пожалуйста, <a href="{{ route('show.login') }}"
                         class="text-indigo-600 underline hover:text-indigo-800">войдите
                                в аккаунт</a>.
                        </div>
                    @endif

                </div>
            </div>

            <!-- Технические характеристики -->
            <section aria-labelledby="details-heading"
                     class="mt-16 border-t border-gray-200 dark:border-gray-800 pt-10">
                <h2 id="details-heading"
                    class="text-sm font-bold uppercase tracking-wider text-gray-900 dark:text-white mb-6">Технические
                    характеристики</h2>
                @if(!empty($data))
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-3">
                        @foreach($data as $property => $value)
                            <div
                                class="flex items-center justify-between py-3 border-b border-gray-100 dark:border-gray-800">
                                <dt class="text-sm text-gray-500 dark:text-gray-400 font-medium">{{ $property }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white font-bold bg-gray-50 dark:bg-gray-800 px-3 py-1 rounded-lg">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div
                        class="flex flex-col items-center justify-center py-12 bg-gray-50 dark:bg-gray-900 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700">
                        <p class="text-gray-400 dark:text-gray-500 text-sm font-medium">Спецификации пока не
                            добавлены</p>
                    </div>
                @endif
            </section>

            <!-- Отзывы -->
            <section class="mt-16 pt-6 border-t border-gray-200 dark:border-gray-800">
                <div
                    class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 pb-4 border-b border-gray-100 dark:border-gray-800">
                    <h2 class="text-2xl font-black uppercase tracking-tighter text-gray-900 dark:text-white">
                        Отзывы покупателей
                    </h2>
                    <form action="{{ url()->current() }}" method="GET" id="reviews-sort-form"
                          class="flex items-center gap-2">
                        @foreach(request()->except('sort_reviews') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <label for="sort_reviews" class="text-sm font-medium text-gray-500 dark:text-gray-400">Сортировать:</label>
                        <select name="sort_reviews" id="sort_reviews"
                                onchange="document.getElementById('reviews-sort-form').submit();"
                                class="bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 p-2.5 pr-8 cursor-pointer font-medium">
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
                        class="text-center py-12 bg-gray-50 dark:bg-gray-900 rounded-2xl border border-dashed border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 mb-8">
                        <span class="text-3xl block mb-2">⭐</span>
                        У этого товара пока нет отзывов. Станьте первым!
                    </div>
                @else
                    <div class="grid grid-cols-1 gap-5 mb-8">
                        @foreach($reviews as $review)
                            <div x-data="{ editing: false, reviewText: '{{ addslashes($review->review) }}' }"
                                 class="bg-white dark:bg-gray-900 p-6 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm transition hover:shadow-md">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex items-center gap-3">
                                        <div>
                                            <h4 class="font-bold text-gray-900 dark:text-white">{{ $review->getUser()->getFullName() ?? 'Анонимный покупатель' }}</h4>
                                            <div class="flex items-center text-yellow-400 mt-1 space-x-0.5">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review->rating)
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                    @else
                                                        <svg class="w-4 h-4 text-gray-200 dark:text-gray-700"
                                                             fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="text-xs text-gray-400 dark:text-gray-500 font-medium">{{ $review->created_at->format('d.m.Y') }}</span>
                                        @if(Auth::check() && Auth::id() === $review->user_id)
                                            <button @click="editing = !editing"
                                                    class="text-gray-400 hover:text-indigo-600 transition"
                                                    title="Редактировать отзыв">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                     viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                <!-- Режим просмотра -->
                                <div x-show="!editing"
                                     class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed whitespace-pre-line">
                                    {{ $review->review }}
                                </div>

                                <!-- Режим редактирования -->
                                <div x-show="editing" class="mt-4">
                                    <form action="{{ route('review.update', $review->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input name="product_id" type="hidden" value="{{ $product->getKey() }}">
                                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Ваша
                                            оценка:</label>
                                        <select name="rating" x-model="reviewRating" required
                                                class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-xl p-2 text-sm focus:ring-indigo-500">
                                            <option value="5">5 звезд</option>
                                            <option value="4">4 звезды</option>
                                            <option value="3">3 звезды</option>
                                            <option value="2">2 звезды</option>
                                            <option value="1">1 звезда</option>
                                        </select>
                                        <textarea name="review" x-model="reviewText" rows="4"
                                                  class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 p-4 text-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                                        <div class="flex gap-3 mt-3">
                                            <button type="submit"
                                                    class="bg-indigo-600 text-white rounded-xl py-2 px-5 font-bold hover:bg-indigo-700 transition text-sm">
                                                Сохранить
                                            </button>
                                            <button type="button"
                                                    @click="editing = false; reviewText = '{{ addslashes($review->review) }}'"
                                                    class="text-gray-500 hover:text-gray-700 font-medium text-sm">Отмена
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if(Auth::check())
                    @if(!$hasReview)
                        <div
                            class="bg-gray-50 dark:bg-gray-900 rounded-2xl p-6 border border-gray-200 dark:border-gray-800">
                            <h3 class="text-lg font-black uppercase tracking-tighter text-gray-900 dark:text-white mb-4">
                                Оставить отзыв</h3>
                            <form action="{{ route('review.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <input name="product_id" type="hidden" value="{{ $product->getKey() }}">
                                <div class="flex flex-wrap items-center gap-4">
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Ваша
                                        оценка:</label>
                                    <select name="rating" required
                                            class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-xl p-2 text-sm focus:ring-indigo-500">
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
                                          class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 p-4 text-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                                <button type="submit"
                                        class="bg-indigo-600 text-white rounded-xl py-3 px-8 font-black uppercase tracking-wider hover:bg-indigo-700 transition">
                                    Опубликовать отзыв
                                </button>
                            </form>
                        </div>
                    @else
                        <div
                            class="p-4 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-300 text-sm font-medium rounded-2xl border border-indigo-100 dark:border-indigo-800 text-center">
                            Вы уже оставили отзыв к этому товару. Спасибо!
                        </div>
                    @endif
                @else
                    <div
                        class="p-4 bg-yellow-50 dark:bg-yellow-900/20 text-yellow-800 dark:text-yellow-300 text-sm font-medium rounded-2xl border border-yellow-100 dark:border-yellow-800 text-center">
                        Чтобы оставить отзыв, пожалуйста, <a href="{{ route('show.login') }}"
                                                             class="text-indigo-600 underline hover:text-indigo-800">войдите
                            в аккаунт</a>.
                    </div>
                @endif
            </section>

            <!-- Вопрос-ответ -->
                <section aria-labelledby="questions-heading"
                         class="mt-16 border-t border-gray-200 dark:border-gray-800 pt-8">
                    <h2 id="questions-heading"
                        class="text-sm font-bold uppercase tracking-wider text-gray-900 dark:text-white mb-6">
                        Вопрос-ответ</h2>

                    @if(!$product->getQuestions()->isEmpty())
                        <div class="space-y-6 mb-10">
                            @foreach($product->getQuestions() as $question)
                                {{-- Добавляем x-data для каждого вопроса отдельно --}}
                                <div x-data="{ editing: false, questionTitle: '{{ addslashes($question->getTitle()) }}', questionDesc: '{{ addslashes($question->getDescription()) }}' }"
                                     class="bg-white dark:bg-gray-900 p-6 border border-gray-200 dark:border-gray-800 rounded-2xl shadow-sm question-item"
                                     data-question-id="{{ $question->getKey() }}">

                                    <div class="flex justify-between items-start mb-4">
                                        <div class="flex items-center gap-3">
                                            <img
                                                class="h-10 w-10 rounded-full object-cover border border-gray-200 dark:border-gray-700"
                                                src="{{ $question->getUser()->getFirstMediaUrl('avatars', 'preview') }}"
                                                alt="Аватар">
                                            <span
                                                class="text-gray-900 dark:text-white font-bold">{{ $question->getUser()->getFirstName() }}</span>

                                            @if(Auth::user() && Auth::user()->getKey() === $question->getUser()->getKey())
                                                {{-- По клику переключаем режим редактирования --}}
                                                <button @click="editing = !editing"
                                                        class="edit-question-btn text-gray-400 hover:text-indigo-600 transition"
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

                                    {{-- Скрываем основной текст вопроса, когда идет редактирование --}}
                                    <div x-show="!editing">
                                        <div class="question-title text-xl font-black uppercase tracking-tight text-gray-900 dark:text-white mb-4">
                                            {{ $question->getTitle() }}
                                        </div>
                                        <div class="question-text text-gray-700 dark:text-gray-300 leading-relaxed">
                                            {{ $question->getDescription() }}
                                        </div>
                                    </div>

                                    {{-- Показываем форму редактирования при условии editing === true (без класса hidden) --}}
                                    <div x-show="editing" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-800" style="display: none;">
                                        <form action="{{ route('question.update', $question->getKey()) }}" method="POST" class="space-y-4">
                                            @csrf
                                            @method('patch') {{-- Обратите внимание: метод PATCH без блокирующего prevent --}}

                                            <input name="product_id" type="hidden" value="{{ $product->getKey() }}">

                                            <input required name="title" type="text" placeholder="Заголовок вопроса"
                                                   x-model="questionTitle"
                                                   class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 p-4 text-sm focus:ring-indigo-500 focus:border-indigo-500">

                                            <textarea name="description" required placeholder="Вопрос"
                                                      x-model="questionDesc"
                                                      class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 p-4 text-sm focus:ring-indigo-500 focus:border-indigo-500"
                                                      rows="3"></textarea>

                                            <div class="flex gap-3">
                                                <button type="submit"
                                                        class="bg-indigo-600 text-white rounded-xl py-2 px-6 font-bold hover:bg-indigo-700 transition text-sm">
                                                    Сохранить
                                                </button>
                                                {{-- Кнопка отмены возвращает исходные значения полей --}}
                                                <button type="button"
                                                        @click="editing = false; questionTitle = '{{ addslashes($question->getTitle()) }}'; questionDesc = '{{ addslashes($question->getDescription()) }}'"
                                                        class="cancel-edit-btn text-gray-500 hover:text-gray-700 font-medium text-sm">
                                                    Отмена
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <a href="{{ route('question.show', $question->getKey()) }}"
                                       class="inline-block mt-3 text-indigo-600 hover:text-indigo-800 text-sm font-medium">Посмотреть
                                        ответы →</a>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Форма добавления нового вопроса (оставляем без изменений) --}}
                    @if(Auth::check())
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-2xl p-6 border border-gray-200 dark:border-gray-800">
                            <h3 class="text-lg font-black uppercase tracking-tighter text-gray-900 dark:text-white mb-4">
                                Задать вопрос</h3>
                            <form action="{{ route('question.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <input name="product_id" type="hidden" value="{{ $product->getKey() }}">
                                <input required name="title" type="text" placeholder="Заголовок вопроса"
                                       class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 p-4 text-sm focus:ring-indigo-500">
                                <textarea required name="description" placeholder="Вопрос"
                                          class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 p-4 text-sm focus:ring-indigo-500"></textarea>
                                <button type="submit"
                                        class="bg-indigo-600 text-white rounded-xl py-3 px-8 font-black uppercase tracking-wider hover:bg-indigo-700 transition">
                                    Опубликовать
                                </button>
                            </form>
                        </div>
                    @endif
                </section>
        </div>
    </div>
@endsection
