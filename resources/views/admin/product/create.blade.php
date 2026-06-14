@extends('layouts.admin')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Добавить новый товар</h2>
            <a href="{{ route('admin.product.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Назад к списку
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg p-8"
             x-data="productCreateForm({
                categories: {{ json_encode($categories->map(fn($c) => ['id' => $c->getKey(), 'name' => $c->getName(), 'sub_categories' => $c->subCategories->map(fn($sc) => ['id' => $sc->getKey(), 'name' => $sc->getName()])])) }},
                currentCategoryId: {{ old('category_id', 0) }},
                currentSubCategoryId: {{ old('sub_category_id', 0) }},
                allAddresses: {{ json_encode($addresses->map(fn($a) => ['id' => $a->getKey(), 'name' => $a->getName()])) }},
                allProperties: {{ json_encode($properties->map(fn($p) => ['id' => $p->getKey(), 'name' => $p->getName()])) }}
             })">

            <form action="{{ route('admin.product.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                @csrf

                {{-- Название товара --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Название товара</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border @error('name') border-red-500 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Цена --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Цена</label>
                    <input type="text" name="price" value="{{ old('price') }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border @error('price') border-red-500 @enderror">
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Описание --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Описание товара</label>
                    <textarea required name="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- В НАЛИЧИИ (СКЛАДЫ И КОЛИЧЕСТВО) --}}
                <div class="border-t pt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2 font-semibold">В наличии на складах</label>

                    <div class="space-y-3">
                        <template x-for="(item, index) in selectedAddresses" :key="index">
                            <div class="flex items-center gap-3 bg-gray-50 p-2 rounded border border-gray-200">
                                <div class="flex-1">
                                    <select name="address_ids[]" x-model="item.address_id" required
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border text-sm">
                                        <option value="">Выберите склад</option>
                                        <template x-for="addr in allAddresses" :key="addr.id">
                                            <option :value="addr.id" x-text="addr.name"></option>
                                        </template>
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <input type="number" name="product_quantities[]" x-model="item.product_quantity" required placeholder="Количество" min="0"
                                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border text-sm">
                                </div>
                                <button type="button" @click="removeAddress(index)" class="text-red-500 hover:text-red-700 transition p-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </template>
                    </div>

                    <button type="button" @click="addAddress()"
                            class="mt-3 inline-flex items-center px-3 py-1.5 border border-blue-600 text-blue-600 text-sm font-medium rounded-md hover:bg-blue-50 transition">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Добавить склад
                    </button>
                </div>

                {{-- Изображение товара --}}
                <div class="border-t pt-4">
                    <label class="block text-sm font-medium text-gray-700">Картинка</label>
                    <input type="file" name="product_image" accept="image/jpeg,image/png,image/jpg" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                </div>

                {{-- Выбор категорий и реактивных подкатегорий --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border-t pt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Категория</label>
                        <select name="category_id" x-model="categoryId" @change="onCategoryChange()"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border" required>
                            <option value="0">Выберите категорию</option>
                            <template x-for="cat in categories" :key="cat.id">
                                <option :value="cat.id" x-text="cat.name"></option>
                            </template>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Подкатегория</label>
                        <select name="sub_category_id" x-model="subCategoryId" :disabled="subCategories.length === 0"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border" required>
                            <option value="0">Выберите подкатегорию</option>
                            <template x-for="sub in subCategories" :key="sub.id">
                                <option :value="sub.id" x-text="sub.name"></option>
                            </template>
                        </select>
                    </div>
                </div>

                {{-- ХАРАКТЕРИСТИКИ ТОВАРА (PROPERTIES & VALUES) --}}
                <div class="border-t pt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2 font-semibold">Характеристики товара</label>

                    <div class="space-y-3">
                        <template x-for="(spec, index) in selectedSpecs" :key="index">
                            <div class="flex items-center gap-3 bg-gray-50 p-2 rounded border border-gray-200">
                                <div class="flex-1">
                                    <select name="properties[]" x-model="spec.property_id" required
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border text-sm">
                                        <option value="">Выберите свойство</option>
                                        <template x-for="prop in allProperties" :key="prop.id">
                                            <option :value="prop.id" x-text="prop.name"></option>
                                        </template>
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <input type="text" name="property_values[]" x-model="spec.value" required placeholder="Значение"
                                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border text-sm">
                                </div>
                                <button type="button" @click="removeSpec(index)" class="text-red-500 hover:text-red-700 transition p-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </template>
                    </div>

                    <button type="button" @click="addSpec()"
                            class="mt-3 inline-flex items-center px-3 py-1.5 border border-blue-600 text-blue-600 text-sm font-medium rounded-md hover:bg-blue-50 transition">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Добавить характеристику
                    </button>
                </div>

                {{-- Кнопка сохранения --}}
                <div class="pt-4">
                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 transition duration-200 font-bold shadow-lg">
                        Создать товар
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- Скрипт инициализации данных Alpine.js --}}
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('productCreateForm', (config) => ({
            categories: config.categories,
            categoryId: config.currentCategoryId,
            subCategoryId: config.currentSubCategoryId,
            subCategories: [],

            allAddresses: config.allAddresses,
            selectedAddresses: [{ address_id: '', product_quantity: 0 }],

            allProperties: config.allProperties,
            selectedSpecs: [{ property_id: '', value: '' }],

            init() {
                this.updateSubCategories();
            },

            onCategoryChange() {
                this.updateSubCategories();
                this.subCategoryId = 0;
            },

            updateSubCategories() {
                if (this.categoryId == 0) {
                    this.subCategories = [];
                    return;
                }
                const found = this.categories.find(c => c.id == this.categoryId);
                this.subCategories = found ? found.sub_categories : [];

                // Обработка старого ввода Laravel после ошибок валидации (old)
                if (this.subCategoryId != 0 && !this.subCategories.some(s => s.id == this.subCategoryId)) {
                    this.subCategoryId = 0;
                }
            },

            // Управление складами
            addAddress() {
                this.selectedAddresses.push({ address_id: '', product_quantity: 0 });
            },
            removeAddress(index) {
                this.selectedAddresses.splice(index, 1);
                if (this.selectedAddresses.length === 0) {
                    this.addAddress();
                }
            },

            // Управление характеристиками
            addSpec() {
                this.selectedSpecs.push({ property_id: '', value: '' });
            },
            removeSpec(index) {
                this.selectedSpecs.splice(index, 1);
                if (this.selectedSpecs.length === 0) {
                    this.addSpec();
                }
            }
        }));
    });
</script>
