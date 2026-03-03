@extends('layouts.admin')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">Список пользователей</h2>
        <a href="{{ route('admin.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Добавить пользователя
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                <th class="px-5 py-3">Имя / Email</th>
                <th class="px-5 py-3">Телефон</th>
                <th class="px-5 py-3">Роль</th>
                <th class="px-5 py-3 text-right">Действия</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @foreach($users as $user)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-5 py-5">
                        <a href="{{ route('admin.show', $user->id) }}">
                            <p class="font-medium">{{ $user->getLastName() }} {{ $user->getFirstName() }}</p>
                        </a>
                        <p class="text-xs text-gray-500">{{ $user->getEmail() }}</p>
                    </td>
                    <td class="px-5 py-5 text-sm">{{ $user->getPhone() ?? 'Не указано' }}</td>
                    <td class="px-5 py-5 text-sm">
                    <span class="px-2 py-1 rounded text-xs {{ $user->getRole() == 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-700' }}">
                        {{ $user->getRole() }}
                    </span>
                    </td>
                    <td class="px-5 py-5 text-right text-sm">
                        <a href="{{ route('admin.edit', $user->getKey()) }}" class="text-blue-600 hover:text-blue-900 ">Изменить</a>
                        <form method="POST" action="{{ route('admin.destroy', $user->getKey()) }}">
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
    <div>
        {{ $users->links() }}
    </div>
@endsection
