@extends('layouts.admin')
@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Карточка товара</h2>
                <p class="text-gray-500">ID товара: #{{ $product->getKey() }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.product.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition">
                    К списку
                </a>
                <a href="{{ route('admin.product.edit', $product->getSlug()) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                    Редактировать
                </a>
            </div>
        </div>
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
            <div class="md:flex">
                <div class="md:w-1/3 bg-gray-50 flex items-center justify-center p-8 border-r border-gray-100">
                    @if($product->hasMedia('products'))
                        <img src="{{ $product->getFirstMediaUrl('products') }}" alt="{{ $product->getName() }}" class="max-h-64 object-contain rounded-lg shadow-sm">
                    @else
                        <div class="w-48 h-48 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                        </div>
                    @endif
                </div>

                <div class="md:w-2/3 p-8">

                    <h1 class="text-3xl font-extrabold text-gray-900 mb-2">{{ $product->getName() }}</h1>
                    <p class="text-3xl font-bold text-blue-600 mb-6">{{ $product->getPrice() }} ₽</p>

                    <div class="border-t border-gray-100 pt-6">
                        <h3 class="text-sm font-bold text-gray-400 uppercase mb-3 tracking-widest">Описание</h3>
                        <p class="text-gray-600 leading-relaxed italic">
                            {{ $product->getDescription() ?: 'Описание отсутствует' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-8 border-t border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Характеристики
                </h3>

                @if(!empty($data))
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4">
                        @foreach($data as $property => $value)
                            <div class="flex justify-between border-b border-gray-200 pb-2 transition hover:bg-gray-100 px-2 rounded">
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
            </div>
        </div>
    </div>
@endsection
