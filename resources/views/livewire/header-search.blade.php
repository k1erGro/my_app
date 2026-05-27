<div style="position: relative; width: 100%; max-width: 500px;">
    <form wire:submit.prevent="searchPage">
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="Поиск электроники (например, iPhone)..."
            style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc;"
        />
        <button type="submit" style="position: absolute; right: 5px; top: 5px; padding: 5px 10px;">Найти</button>
    </form>

    @if(!empty($results))
        <div style="position: absolute; top: 100%; left: 0; width: 100%; background: #fff; border: 1px solid #ccc; z-index: 999; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-radius: 4px; max-height: 400px; overflow-y: auto;">
            @foreach($results as $product)
                <a href="{{ route('product.show', $product['slug']) }}" style="display: flex; align-items: center; padding: 10px; text-decoration: none; color: #333; border-bottom: 1px solid #f0f0f0;">
                    <div style="flex-grow: 1;">
                        <div style="font-weight: bold;">{{ $product['name'] }}</div>
                        <div style="font-size: 0.85em; color: #e74c3c;">{{ number_format($product['price'], 2, '.', ' ') }} руб.</div>
                    </div>
                </a>
            @endforeach
        </div>
    @elseif(strlen($search) >= 2 && empty($results))
        <div style="position: absolute; top: 100%; left: 0; width: 100%; background: #fff; padding: 10px; border: 1px solid #ccc; color: #888;">
            Ничего не найдено
        </div>
    @endif
</div>
