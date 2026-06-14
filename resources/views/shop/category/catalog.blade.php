@extends('layouts.main')
@section('content')
    <div class="max-w-[1600px] mx-auto px-6 py-12">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
            <h1 class="text-4xl font-black uppercase tracking-tighter text-gray-900 dark:text-white">Каталог</h1>
            @can('create-categories')
                <a href="{{ route('admin.category.create') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white font-bold rounded-full hover:bg-indigo-700 transition shadow-md hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Добавить категорию
                </a>
            @endcan
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($categories as $category)
                <div
                    class="group bg-white dark:bg-gray-900 rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300">
                    <a href="{{ route('catalog.show', $category->getSlug()) }}" class="block">
                        <div
                            class="aspect-square bg-gray-100 dark:bg-gray-800 flex items-center justify-center overflow-hidden p-4">
                            @if($category->hasMedia('category_images'))
                                <img src="{{ $category->getFirstMediaUrl('category_images') }}"
                                     alt="{{ $category->getName() }}"
                                     class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500">
                            @else
                                <svg class="w-16 h-16 text-gray-300 dark:text-gray-600" fill="currentColor"
                                     viewBox="0 0 24 24">
                                    <path
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            @endif
                        </div>
                        <div class="p-5">
                            <h3 class="text-xl font-black uppercase tracking-tight text-gray-900 dark:text-white mb-2">
                                {{ $category->getName() }}
                            </h3>
                            <div class="flex items-center justify-between flex-wrap gap-2">
                            <span
                                class="inline-flex items-center text-indigo-600 dark:text-indigo-400 font-bold text-sm">
                                Перейти
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                                <div class="flex items-center gap-3">
                                    @can('edit-categories')
                                        <a href="{{ route('admin.category.edit', $category->getSlug()) }}"
                                           class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 text-sm font-medium">Изменить</a>
                                    @endcan
                                    @can('delete-categories')
                                        <form method="POST"
                                              action="{{ route('admin.category.destroy', $category->getKey()) }}"
                                              onsubmit="return confirm('Удалить категорию?')">
                                            @csrf
                                            @method('delete')
                                            <button
                                                class="text-red-600 dark:text-red-400 hover:text-red-800 text-sm font-medium">
                                                Удалить
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
