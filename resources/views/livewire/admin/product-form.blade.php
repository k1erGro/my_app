<div class="bg-white shadow-md rounded-lg p-8">
    <form wire:submit="save" class="space-y-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Название товара</label>
                <input type="text" wire:model.live="name"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 border">
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Цена</label>
                <input type="number" wire:model="price"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 border">
                @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Категория</label>
                <select wire:model.live="category_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 border text-sm">
                    <option value="">Выберите категорию</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Подкатегория</label>
                <select wire:model="sub_category_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 border text-sm"
                    {{ empty($subCategories) ? 'disabled' : '' }}>
                    <option value="">Выберите подкатегорию</option>
                    @foreach($subCategories as $subCategory)
                        <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                    @endforeach
                </select>
                @error('sub_category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Описание</label>
            <textarea wire:model="description" rows="3"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 border"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Изображение товара</label>
            <input type="file" wire:model="image" class="mt-1 block w-full">
            @if ($image)
                <img src="{{ $image->temporaryUrl() }}" class="mt-2 w-20 h-20 object-cover rounded">
            @elseif($isEdit && $product->getFirstMediaUrl('product_images'))
                <img src="{{ $product->getFirstMediaUrl('product_images') }}"
                     class="mt-2 w-20 h-20 object-cover rounded">
            @endif
        </div>

        <hr class="border-gray-200">

        <div>
            <h3 class="text-lg font-bold text-gray-800 mb-3">Наличие на складах</h3>
            <div class="space-y-3">
                @foreach($stocks as $index => $stock)
                    <div class="flex items-center gap-3" wire:key="stock-{{ $index }}">
                        <div class="flex-1">
                            <select wire:model="stocks.{{ $index }}.address_id"
                                    class="block w-full rounded-md border-gray-300 p-2 border text-sm">
                                <option value="">Выберите склад</option>
                                @foreach($warehouses as $warehouse)
                                    <option
                                        value="{{ $warehouse->id }}">{{ $warehouse->name ?? $warehouse->address }}</option>
                                @endforeach
                            </select>
                            @error("stocks.{$index}.address_id") <span
                                class="text-red-500 text-xs">Выберите склад</span> @enderror
                        </div>

                        <div class="flex-1">
                            <input type="number" wire:model="stocks.{{ $index }}.product_quantity"
                                   placeholder="Количество"
                                   class="block w-full rounded-md border-gray-300 p-2 border text-sm">
                            @error("stocks.{$index}.product_quantity") <span
                                class="text-red-500 text-xs">Укажите кол-во</span> @enderror
                        </div>

                        <button type="button" wire:click="removeStock({{ $index }})"
                                class="text-red-500 hover:text-red-700 p-2">
                            Удалить
                        </button>
                    </div>
                @endforeach
            </div>
            <button type="button" wire:click="addStock"
                    class="mt-3 inline-flex items-center px-3 py-1.5 border border-blue-600 text-blue-600 text-sm font-medium rounded-md hover:bg-blue-50">
                + Добавить склад
            </button>
        </div>

        <hr class="border-gray-200">

        <div>
            <h3 class="text-lg font-bold text-gray-800 mb-3">Характеристики товара</h3>
            <div class="space-y-3">
                @foreach($specs as $index => $spec)
                    <div class="flex items-center gap-3" wire:key="spec-{{ $index }}">
                        <div class="flex-1">
                            <select wire:model="specs.{{ $index }}.property_id"
                                    class="block w-full rounded-md border-gray-300 p-2 border text-sm">
                                <option value="">Выберите свойство</option>
                                @foreach($properties as $property)
                                    <option value="{{ $property->id }}">{{ $property->name }}</option>
                                @endforeach
                            </select>
                            @error("specs.{$index}.property_id") <span
                                class="text-red-500 text-xs">Выберите свойство</span> @enderror
                        </div>
                        <div class="flex-1">
                            <input type="text" wire:model="specs.{{ $index }}.value" placeholder="Значение"
                                   class="block w-full rounded-md border-gray-300 p-2 border text-sm">
                            @error("specs.{$index}.value") <span
                                class="text-red-500 text-xs">Заполните значение</span> @enderror
                        </div>
                        <button type="button" wire:click="removeSpec({{ $index }})"
                                class="text-red-500 hover:text-red-700 p-2">
                            Удалить
                        </button>
                    </div>
                @endforeach
            </div>
            <button type="button" wire:click="addSpec"
                    class="mt-3 inline-flex items-center px-3 py-1.5 border border-blue-600 text-blue-600 text-sm font-medium rounded-md hover:bg-blue-50">
                + Добавить характеристику
            </button>
        </div>

        <div class="pt-4">
            <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 font-bold shadow-lg transition">
                {{ $isEdit ? 'Сохранить изменения' : 'Создать товар' }}
            </button>
        </div>
    </form>
</div>
