<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">
        Каталог: {{ $subCategory->name }}
    </h1>

    <div class="flex flex-wrap items-center gap-4 mb-6 mt-5">
        <div class="flex flex-wrap gap-2">
            <button wire:click="$set('sort', 'rating_desc')"
                    class="px-4 py-2 {{ $sort == 'rating_desc' ? 'bg-blue-100 text-blue-700 border-blue-300 font-semibold' : 'bg-white text-gray-700 border-gray-300' }} border rounded shadow-sm hover:bg-gray-50 transition">
                Сначала высокий рейтинг
            </button>
            <button wire:click="$set('sort', 'rating_asc')"
                    class="px-4 py-2 {{ $sort == 'rating_asc' ? 'bg-blue-100 text-blue-700 border-blue-300 font-semibold' : 'bg-white text-gray-700 border-gray-300' }} border rounded shadow-sm hover:bg-gray-50 transition">
                Сначала низкий рейтинг
            </button>
        </div>

        <button wire:click="$toggle('showFilters')" class="lg:hidden px-4 py-2 bg-gray-200 text-gray-700 rounded shadow hover:bg-gray-300 transition flex justify-start items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
            Фильтры
        </button>
    </div>

    <div class="flex flex-col lg:flex-row gap-8 items-start">

        <aside class="w-full lg:w-1/4 bg-white border border-gray-200 rounded-xl p-5 shadow-sm sticky top-4
                      {{ $showFilters ? 'block' : 'hidden' }} lg:block">
            <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center justify-between">
                <span>Фильтры</span>
                <button wire:click="$set('selectedProperties', []); $set('priceFrom', ''); $set('priceTo', '');"
                        class="text-xs text-red-500 hover:underline font-normal">
                    Сбросить всё
                </button>
            </h2>

            <div class="mb-6 pb-6 border-b border-gray-100">
                <h3 class="text-sm font-semibold text-gray-800 mb-3">Цена, ₽</h3>
                <div class="flex items-center gap-2">
                    <input type="number" wire:model.live.debounce.500ms="priceFrom" placeholder="от"
                           class="w-full text-sm border border-gray-300 rounded-md px-3 py-1.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                    <span class="text-gray-400">—</span>
                    <input type="number" wire:model.live.debounce.500ms="priceTo" placeholder="до"
                           class="w-full text-sm border border-gray-300 rounded-md px-3 py-1.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                </div>
            </div>

            <div class="space-y-6">
                @foreach($filters as $property)
                    <div class="pb-6 border-b border-gray-100 last:border-none last:pb-0">
                        <h3 class="text-sm font-bold text-gray-800 mb-3">
                            {{ $property->getName() }}
                        </h3>
                        <div class="space-y-2 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                            @foreach($property->propertyValues as $propValue)
                                <label class="flex items-center text-sm text-gray-600 hover:text-gray-900 cursor-pointer select-none">
                                    <input type="checkbox"
                                           wire:model.live="selectedProperties.{{ $property->id }}.{{ $propValue->value }}"
                                           class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mr-2.5">
                                    <span>{{ $propValue->value }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </aside>

        <main class="w-full lg:w-3/4">
            @if($products->isEmpty())
                <div class="bg-white border border-gray-200 rounded-xl p-12 text-center shadow-sm w-full">
                    <div class="text-gray-400 text-5xl mb-4">🔍</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Товары не найдены</h3>
                    <p class="text-gray-500 max-w-sm mx-auto text-sm">
                        Нет товаров, соответствующих выбранным критериям фильтрации. Попробуйте смягчить фильтры.
                    </p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 w-full">
                    @foreach($products as $product)
                        <div class="group bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                            <a href="{{ route('product.show', $product->getSlug()) }}" class="flex flex-col h-full">

                                <div class="aspect-square bg-white flex items-center justify-center p-4">
                                    @if($product->hasMedia('products'))
                                        <img src="{{ $product->getFirstMediaUrl('products') }}"
                                             alt="{{ $product->getName() }}"
                                             class="h-40 object-contain group-hover:scale-110 transition-transform">
                                    @else
                                        <p class="text-sm text-gray-400">Картинка не найдена</p>
                                    @endif
                                </div>

                                <div class="p-4 border-t border-gray-100 flex flex-col flex-grow justify-between">
                                    <div class="flex justify-between items-start gap-2 mb-3">
                                        <h3 class="text-base font-semibold text-gray-800 line-clamp-2 leading-snug">
                                            {{ $product->getName() }}
                                        </h3>
                                        <div class="flex items-center shrink-0 mt-0.5">
                                            <span class="text-yellow-400 text-sm">★</span>
                                            <span class="ml-1 text-xs font-bold text-gray-600">
                                                {{ isset($product->reviews_avg_rating) ? round($product->reviews_avg_rating, 1) : 0 }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex items-end justify-between border-t border-gray-100 pt-4 mt-auto">
                                        <p class="text-xl font-extrabold text-blue-600 whitespace-nowrap">
                                            {{ number_format($product->getPrice(), 0, '.', ' ') }} ₽
                                        </p>

                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @endif
        </main>

    </div>
</div>
