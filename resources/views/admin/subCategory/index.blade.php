@extends('layouts.admin')
@section('content')

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">Список подкатегорий</h2>
        <a href="{{ route('admin.subCategory.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Добавить подкатегорию
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
                <th class="px-5 py-3">Название подкатегории</th>
                <th class="px-5 py-3">Картинка подкатегории</th>
                <th class="px-5 py-3">Родитель подкатегории</th>
                <th class="px-5 py-3 text-right">Действия</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @foreach($subСategories as $subCategory)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $subCategory->getName() }}</p>
                    </td>

                    @if($subCategory->hasMedia('subCategory_images'))
                        <td class="w-10 px-5 py-5">
                            <img src="{{ $subCategory->getFirstMediaUrl('subCategory_images') }}" alt="{{ $subCategory->getName() }}">
                        </td>
                    @endif

                    @if($subCategory->getCategory() !== null)
                        <td class="px-5 py-5">
                            <p class="font-medium">{{  $subCategory->getCategory()->getName() }}</p>
                        </td>
                    @else
                        <td class="px-5 py-5">
                            <p class="font-medium">Нет родительской категории</p>
                        </td>
                    @endif

                    <td class="px-5 py-5 text-right text-sm">
                        <a href="{{ route('admin.subCategory.edit', $subCategory->getSlug()) }}" class="text-blue-600 hover:text-blue-900 ">Изменить</a>
                        <form method="POST" action="{{ route('admin.subCategory.destroy', $subCategory->getKey()) }}">
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
        {{ $subСategories->links() }}
    </div>
@endsection

