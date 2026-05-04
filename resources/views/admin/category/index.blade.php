@extends('layouts.admin')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">Список категорий</h2>
        <a href="{{ route('admin.category.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Добавить категорию
        </a>
    </div>
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                <th class="px-5 py-3">Название категории</th>
                <th class="px-5 py-3">Картинка категории</th>
                <th class="px-5 py-3 text-right">Действия</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @foreach($categories as $category)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $category->getName() }}</p>
                    </td>

                    @if($category->hasMedia('category_images'))
                        <td class="w-10 px-5 py-5">
                            <img src="{{ $category->getFirstMediaUrl('category_images') }}" alt="{{ $category->getName() }}">
                        </td>
                    @endif


                    <td class="px-5 py-5 text-right text-sm">
                        <a href="{{ route('admin.category.edit', $category->getSlug()) }}" class="text-blue-600 hover:text-blue-900 ">Изменить</a>
                        <form method="POST" action="{{ route('admin.category.destroy', $category->getKey()) }}">
                            @csrf
                            @method('delete')
                            <button class="text-red-600 hover:text-red-900" onclick="return confirm('Вы уверены что хотите удалить данные?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $categories->links() }}
    </div>
@endsection
