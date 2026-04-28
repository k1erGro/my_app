@extends('layouts.main')
@section('content')


    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Каталог</h1>
        @can('create-categories')
            <a href="{{ route('admin.category.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Добавить подкатегорию
            </a>
        @endcan
        <div class="grid mt-5 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($category->getSubCategories() as $subCategory)
                <div
                    class="group bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    <a href="{{ route('catalog.product', $subCategory->getSlug()) }}">

                        <div class="aspect-square bg-white flex items-center justify-center">
                            @if($subCategory->hasMedia('subCategory_images'))
                                <img src="{{ $subCategory->getFirstMediaUrl('subCategory_images') }}"
                                     alt="{{ $subCategory->getName() }}"
                                     class="h-40 object-contain group-hover:scale-110 transition-transform">
                            @else
                                <p>Картинка не найдена</p>
                            @endif
                        </div>
                        <div class="p-4 border-t border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $subCategory->getName() }}</h3>
                            <a href="{{ route('catalog.product', $subCategory->getSlug()) }}"
                               class="inline-flex items-center text-blue-600 font-medium hover:text-blue-800">
                                Перейти
                                <svg class="w-4 h-4 ml-2" ...></svg>
                            </a>

                            <div>
                                @can('edit-categories')
                                    <a href="{{ route('admin.subCategory.edit', $subCategory->getSlug()) }}"
                                       class="text-blue-600 hover:text-blue-900 ">Изменить</a>
                                @endcan
                                @can('delete-categories')
                                    <form method="POST" action="{{ route('admin.subCategory.destroy', $subCategory->getKey()) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="text-red-600 hover:text-red-900">Удалить</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection
