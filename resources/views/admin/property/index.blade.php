@extends('layouts.admin')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">Список характеристик</h2>
        @can('create-properties')
            <a href="{{ route('admin.property.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Добавить характеристику
            </a>
        @endcan
    </div>
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg shadow-sm">
            <div class="flex items-center mb-2">
                <span class="font-bold">Внимание!</span>
            </div>
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-4 flex flex-wrap items-center gap-3">
        <form method="GET" action="{{ route('admin.property.index') }}" class="flex items-center gap-2 flex-1 max-w-md">
            <input type="text" name="search" placeholder="Поиск..."
                   value="{{ request('search') }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition">
                Найти
            </button>
            @if(request('search'))
                <a href="{{ route('admin.property.index') }}"
                   class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-md hover:bg-gray-300 transition">
                    Сбросить
                </a>
            @endif
        </form>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                <th class="px-5 py-3">Название характеристики</th>
                <th class="px-5 py-3 text-right">Действия</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @foreach($properties as $property)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $property->getName() }}</p>
                    </td>

                    <td class="px-5 py-5 text-right text-sm">
                        @can('edit-properties')
                            <a href="{{ route('admin.property.edit', $property->getSlug()) }}"
                               class="text-blue-600 hover:text-blue-900 ">Изменить</a>
                        @endcan
                        @can('delete-properties')
                            <form method="POST" action="{{ route('admin.property.destroy', $property->getKey()) }}">
                                @csrf
                                @method('delete')
                                <button class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Вы уверены что хотите удалить данные?')">Удалить
                                </button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $properties->links() }}
    </div>
@endsection
