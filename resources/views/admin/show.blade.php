@extends('layouts.admin')
@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Профиль пользователя</h2>
                <p class="text-gray-500">ID пользователя: #{{ $user->id }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition">
                    К списку
                </a>
                <a href="{{ route('admin.edit', $user->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                    Редактировать
                </a>
            </div>
        </div>

        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-10 flex items-center">
                @if($user->hasMedia('avatars'))
                    <img src="{{ $user->getFirstMediaUrl('avatars') }}" alt="Аватар" class="h-24 w-24 rounded-full object-cover">
                @else
                    <div class="h-24 w-24 bg-indigo-600 rounded-full flex items-center justify-center text-white">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
                <div class="ml-6 text-white">
                    <h3 class="text-2xl font-bold">{{ $user->name }}</h3>
                    <span class="inline-block mt-1 px-3 py-1 bg-white bg-opacity-20 rounded-full text-sm font-medium uppercase tracking-wider">
                    {{ $user->role }}
                </span>
                </div>
            </div>

            <div class="p-6">
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-8">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 uppercase tracking-wide">Электронная почта</dt>
                        <dd class="mt-1 text-lg text-gray-900 font-semibold">{{ $user->email }}</dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 uppercase tracking-wide">Номер телефона</dt>
                        <dd class="mt-1 text-lg text-gray-900 font-semibold">{{ $user->phone ?? 'Не указан' }}</dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 uppercase tracking-wide">Дата регистрации</dt>
                        <dd class="mt-1 text-base text-gray-900">{{ $user->created_at->format('d.m.Y H:i') }}</dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 uppercase tracking-wide">Последнее обновление</dt>
                        <dd class="mt-1 text-base text-gray-900">{{ $user->updated_at->format('d.m.Y H:i') }}</dd>
                    </div>
                </dl>
            </div>

            <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex justify-end">
                <form method="POST" action="{{ route('admin.destroy', $user->id) }}">
                    @csrf
                    @method('delete')
                    <button class="text-red-600 hover:text-red-900">Удалить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
