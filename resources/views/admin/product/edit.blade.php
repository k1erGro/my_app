@extends('layouts.admin')
@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Редактировать товар</h2>
            <a href="{{ route('admin.product.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Назад к списку
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg p-8">
            <form action="{{ route('admin.product.update', $product) }}" method="POST" class="space-y-4"
                  enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div>
                    <label class="block text-sm font-medium text-gray-700">Название товара</label>
                    <input type="text" name="name" value="{{ $product->getName() }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border @error('name') border-red-500 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Цена</label>
                    <input type="text" name="price" value="{{ $product->getPrice() }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border @error('price') border-red-500 @enderror">
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Описание товара</label>
                    <textarea required name="description"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border @error('description') border-red-500 @enderror">{{ $product->description }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">В наличии</label>

                    <div id="specs-wrapper-address" class="space-y-3">
                        @foreach($product->getAddresses() as $address)
                            <div class="flex items-center gap-3 animate-fadeIn spec-item">
                                <div class="flex-1">
                                    <select name="address_ids[]"
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border text-sm"
                                            required>
                                        <option value="{{ $address->getKey() }}">
                                            {{ $address->getName() }}
                                        </option>
                                        @foreach($addresses as $item)
                                            <option value="{{ $item->getKey() }}">{{ $item->getName() }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="flex-1">
                                    <input type="text" name="product_quantities[]"
                                           value="{{ $address->pivot->product_quantity }}" required
                                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border text-sm">
                                </div>
                                <button type="button" class="remove-btn-address text-red-500 hover:text-red-700 transition p-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" id="add-spec-address"
                            class="mt-3 inline-flex items-center px-3 py-1.5 border border-blue-600 text-blue-600 text-sm font-medium rounded-md hover:bg-blue-50 transition">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Добавить поле
                    </button>
                </div>

                <div>
                    @if($product->hasMedia('products'))
                        <label class="block text-sm font-medium text-gray-700">Картинка</label>
                        <img src="{{ $product->getFirstMediaUrl('products') }}" alt="{{ $product->getName() }}">
                        <input type="file" name="product_image" accept="image/jpeg,image/png,image/jpg"
                               value="{{ old('product_image') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                    @else
                        <label class="block text-sm font-medium text-gray-700">Картинка</label>
                        <input type="file" name="product_image" accept="image/jpeg,image/png,image/jpg"
                               value="{{ old('product_image') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Категория</label>
                    <select name="category_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border"
                            required>
                        <option
                            value="{{ $product->getCategories()->getKey() }}">{{ $product->getCategories()->getName() }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->getKey() }}">{{$category->getName()}}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Подкатегория</label>
                    <select name="sub_category_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border"
                            required>
                        <option value="{{ $product->getSubCategories()->getKey() }}">{{ $product->getSubCategories()->getName() }}</option>
                        @foreach($subCategories as $subCategory)
                            <option value="{{ $subCategory->getKey() }}">{{ $subCategory->getName() }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Характеристики товара</label>

                    <div id="specs-wrapper" class="space-y-3">
                        @foreach($product->getPropertyValues() as $propertyValue)
                            <div class="flex items-center gap-3 animate-fadeIn spec-item">
                                <div class="flex-1">
                                    <select name="properties[]"
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border text-sm"
                                            required>
                                        <option value="{{ $propertyValue->getProperty()->getKey() }}">
                                            {{ $propertyValue->getProperty()->getName() }}
                                        </option>
                                        @foreach($properties as $property)
                                            @if($property->getKey() !== $propertyValue->getProperty()->getKey())
                                                <option value="{{ $property->getKey() }}">{{ $property->getName() }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <input type="text" name="property_values[]"
                                           value="{{ $propertyValue->getValue() }}" required
                                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border text-sm">
                                </div>
                                <button type="button" class="remove-btn text-red-500 hover:text-red-700 transition p-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" id="add-spec"
                            class="mt-3 inline-flex items-center px-3 py-1.5 border border-blue-600 text-blue-600 text-sm font-medium rounded-md hover:bg-blue-50 transition">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Добавить поле
                    </button>
                </div>

                <div class="pt-4">
                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 transition duration-200 font-bold shadow-lg">
                        Редактировать товар
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
