@extends('layouts.main')

@section('content')
    <section class="relative min-h-[calc(100vh-96px)] flex items-center py-12 overflow-hidden">
        <div class="max-w-6xl mx-auto text-center w-full px-6">
            <h1 class="text-[clamp(3rem,8vw,6rem)] font-black uppercase leading-[0.9] tracking-tighter">
                <span class="text-gray-900 dark:text-white">Техника, которая </span>
                <span class="text-indigo-600">не тормозит</span>
            </h1>
            <p class="text-xl text-gray-500 dark:text-gray-400 max-w-2xl mx-auto mt-6 leading-relaxed">
                От мощных ПК и геймерских девайсов до умной бытовой техники.<br>
                Только оригинал, гарантия 3 года, кэшбек 10% и регулярные купоны на скидку.
            </p>

            <div class="flex flex-wrap justify-center gap-3 mt-8">
                <span class="px-4 py-2 bg-gray-100 dark:bg-gray-800 rounded-full text-sm font-medium">Комплектующие</span>
                <span class="px-4 py-2 bg-gray-100 dark:bg-gray-800 rounded-full text-sm font-medium">Гейминг</span>
                <span class="px-4 py-2 bg-gray-100 dark:bg-gray-800 rounded-full text-sm font-medium">Смартфоны</span>
                <span class="px-4 py-2 bg-gray-100 dark:bg-gray-800 rounded-full text-sm font-medium">Бытовая техника</span>
            </div>

            <div class="flex flex-wrap gap-4 pt-8 justify-center">
                <a href="{{ route('catalog.index') }}"
                   class="group relative px-10 py-5 bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-black uppercase tracking-widest rounded-full overflow-hidden transition-all hover:scale-105">
                    <span class="relative z-10">Смотреть каталог</span>
                    <div class="absolute inset-0 bg-indigo-600 dark:bg-indigo-500 translate-y-full group-hover:translate-y-0 transition-transform"></div>
                </a>

            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-16 pt-8 border-t border-gray-200 dark:border-gray-800">
                <div>
                    <div class="text-2xl font-black text-indigo-600">5000+</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Товаров</div>
                </div>
                <div>
                    <div class="text-2xl font-black text-indigo-600">3 года</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Гарантии</div>
                </div>
                <div>
                    <div class="text-2xl font-black text-indigo-600">10%</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Кэшбек</div>
                </div>
                <div>
                    <div class="text-2xl font-black text-indigo-600">24/7</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Поддержка</div>
                </div>
            </div>
        </div>
    </section>
    <div class="bg-white dark:bg-gray-900 rounded-3xl mx-6 mb-6 overflow-hidden">
        <section class="py-20 px-6">
            <div class="max-w-[1600px] mx-auto">
                <h2 class="text-4xl font-black uppercase mb-12 tracking-tighter text-gray-900 dark:text-white">Популярные категории</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    @foreach($categories as $category)
                        <a href="{{ route('catalog.show', $category->getSlug()) }}" class="group flex justify-center relative h-64 rounded-3xl overflow-hidden shadow-lg">
                            <img src="{{ $category->getFirstMediaUrl('category_images', 'preview') }}" alt="Картинка"
                                 class="h-full  object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent p-6 flex flex-col justify-end">
                                <span class="text-white font-black text-xl">{{ $category->getName() }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    </div>

    <!-- Features секция с таким же фоном и скруглением (опционально) -->
    <div class="bg-white dark:bg-gray-900 rounded-3xl mx-6">
        <section class="py-20 px-6">
            <div class="max-w-[1600px] mx-auto">
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @php
                        $features = [
                            ['title' => 'Оригинал', 'desc' => 'Без подделок'],
                            ['title' => 'Скорость', 'desc' => 'Молниеносная доставка'],
                            ['title' => 'Гарантия', 'desc' => '3 года сервиса'],
                            ['title' => 'Бонусы', 'desc' => 'Кэшбек 10%']
                        ];
                    @endphp
                    @foreach($features as $f)
                        <div class="group p-8 bg-gray-50 dark:bg-gray-800 rounded-[2rem] transition-all duration-300 hover:shadow-xl hover:scale-[1.02]">
                            <h3 class="text-2xl font-black uppercase tracking-tight mb-2 text-gray-900 dark:text-white">{{ $f['title'] }}</h3>
                            <p class="text-gray-500 dark:text-gray-400">{{ $f['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
