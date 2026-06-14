<div class="relative w-full max-w-xl">
    <form wire:submit.prevent="searchPage" class="relative">
        <input type="text"
               wire:model.live.debounce.300ms="search"
               placeholder="Поиск электроники (например, iPhone)..."
               class="w-full px-5 py-3 pr-12 rounded-full border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition">
        <button type="submit"
                class="absolute right-3 top-2/3 -translate-y-1/2 flex items-center justify-center text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </button>
    </form>

    @if(!empty($results))
        <div class="absolute top-full left-0 w-full mt-2 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-xl z-50 max-h-96 overflow-y-auto">
            @foreach($results as $product)
                <a href="{{ route('product.show', $product['slug']) }}"
                   class="flex items-center gap-3 p-4 hover:bg-gray-50 dark:hover:bg-gray-800 transition border-b border-gray-100 dark:border-gray-800 last:border-none">
                    <div class="flex-1">
                        <div class="font-bold text-gray-900 dark:text-white">{{ $product['name'] }}</div>
                        <div class="text-sm text-indigo-600 dark:text-indigo-400 font-black mt-0.5">{{ number_format($product['price'], 0, '.', ' ') }} ₽</div>
                    </div>
                </a>
            @endforeach
        </div>
    @elseif(strlen($search) >= 2 && empty($results))
        <div class="absolute top-full left-0 w-full mt-2 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-xl p-4 text-center text-gray-500 dark:text-gray-400">
            Ничего не найдено
        </div>
    @endif
</div>
