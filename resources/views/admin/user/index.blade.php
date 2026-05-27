@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">Список пользователей</h2>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg shadow-sm">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
                    <td class="px-5 py-5 text-sm">
                        <p class="font-bold">{{ $user->getLastName() }} {{ $user->getFirstName() }}</p>
                        <p class="text-gray-500">{{ $user->getEmail() }}</p>
                    </td>
                    <td class="px-5 py-5 text-sm">{{ $user->getPhone() ?? 'Не указано' }}</td>

                    <td class="px-5 py-5 text-sm">
                        @forelse($user->roles as $role)
                            <span class="px-2 py-1 rounded text-xs font-semibold
                                {{ $role->name === 'Admin' ? 'bg-red-100 text-red-700' :
                                  ($role->name === 'Director' ? 'bg-purple-100 text-purple-700' :
                                  ($role->name === 'Manager' ? 'bg-blue-100 text-blue-700' :
                                  'bg-green-100 text-green-700')) }}">
                                {{ $role->name === 'TechnicalSpecialist' ? 'Тех. спец' : $role->name }}
                            </span>
                        @empty
                            <span class="px-2 py-1 rounded text-xs bg-gray-100 text-gray-600">Пользователь</span>
                        @endforelse
                    </td>

                    <td class="px-5 py-5 text-right text-sm">
                        <div class="flex justify-end gap-2">
                            @can('edit-users')
                                <a href="{{ route('admin.edit', $user->getKey()) }}"
                                   class="text-blue-600 hover:text-blue-900 font-semibold">Изменить</a>
                            @endcan
                            @can('delete-users')
                                <form method="POST" action="{{ route('admin.destroy', $user->getKey()) }}">
                                    @csrf
                                    @method('delete')
                                    <button class="text-red-600 hover:text-red-900 font-semibold"
                                            onclick="return confirm('Вы уверены, что хотите удалить пользователя?')">Удалить
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $users->links() }}
    </div>
@endsection
