@extends('layouts.admin')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">Список адресов</h2>
        <a href="{{ route('admin.address.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Добавить адрес
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                <th class="px-5 py-3">Адрес</th>
                <th class="px-5 py-3 text-right">Действия</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @foreach($addresses as $address)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $address->getName() }}</p>
                    </td>

                    <td class="px-5 py-5 text-right text-sm">
                        <a href="{{ route('admin.address.edit', $address->getSlug()) }}" class="text-blue-600 hover:text-blue-900 ">Изменить</a>
                        <form method="POST" action="{{ route('admin.address.destroy', $address->getKey()) }}">
                            @csrf
                            @method('delete')
                            <button class="text-red-600 hover:text-red-900">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
