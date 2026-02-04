@extends('layouts.admin')
@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Редактировать пользователя</h2>
            <a href="{{ route('admin.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Назад к списку
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg p-8">
            <form action="{{ route('admin.update', $user->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div>
                    <label class="block text-sm font-medium text-gray-700">ФИО</label>
                    <input type="text" name="name" value="{{ $user->name }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border @error('name') border-red-500 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border @error('email') border-red-500 @enderror">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    @if($user->hasMedia('avatars'))
                        <label class="block text-sm font-medium text-gray-700">Аватар</label>
                        <img src="{{ $user->getFirstMediaUrl('avatars') }}" alt="Аватар" class="h-24 w-24 rounded-full object-cover">                        <input type="file" name="avatar" value="{{ old('avatar') }}" accept="image/jpeg,image/png,image/jpg"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                    @else
                    <label class="block text-sm font-medium text-gray-700">Аватар</label>
                    <input type="file" name="avatar" value="{{ old('avatar') }}" accept="image/jpeg,image/png,image/jpg"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                    @endif
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Телефон</label>
                        <input type="text" name="phone" value="{{ $user->phone }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Роль</label>
                        <select name="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Пользователь</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Администратор</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Дата рождения</label>
                        <input type="date" name="birthday" value="{{ $user->birthday }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border @error('birthday') border-red-500 @enderror">
                        @error('birthday') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Адрес</label>
                        <input type="text" name="address" value="{{ $user->address }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border @error('address') border-red-500 @enderror">
                        @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Пароль</label>
                        <input type="password" name="password" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Повторите пароль</label>
                        <input type="password" name="password_confirmation" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 transition duration-200 font-bold shadow-lg">
                        Редактировать пользователя
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
