@extends(Auth::user()->hasRole(\App\Enums\RoleEnum::ADMIN) ? 'layouts.admin' : 'layouts.main')

@section('content')
    @php
        $isAdmin = Auth::user()->hasRole(\App\Enums\RoleEnum::ADMIN);
        $action = $isAdmin ? route('admin.update', $user->getKey()) : route('profile.update', $user->getKey());
        $backRoute = $isAdmin ? route('admin.index') : route('profile');
        $backText = $isAdmin ? 'Назад к списку пользователей' : 'Назад в профиль';
    @endphp

    <div class="max-w-2xl mx-auto px-6 py-12">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-4xl font-black uppercase tracking-tighter text-gray-900 dark:text-white">
                {{ $isAdmin ? "Изменение роли" : 'Редактирование профиля' }}
            </h1>
            <a href="{{ $backRoute }}" class="text-gray-500 hover:text-indigo-600 transition">{{ $backText }}</a>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-5 py-3 rounded-xl mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-5 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-md border border-gray-200 dark:border-gray-800 overflow-hidden">
            <form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf
                @method('PATCH')

                @if($isAdmin)
                    <div class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-800/50 rounded-xl border border-gray-100 dark:border-gray-800">
                        <img class="h-14 w-14 rounded-full object-cover border border-gray-200 dark:border-gray-700"
                             src="{{ $user->getFirstMediaUrl('avatars', 'preview') ?: asset('img/default-avatar.png') }}" alt="Аватар">
                        <div>
                            <div class="font-bold text-gray-900 dark:text-white text-lg">{{ $user->getFullName() }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->getEmail() }}</div>
                        </div>
                    </div>

                    <div class="pt-2">
                        <label class="block text-sm font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">Роль пользователя</label>
                        <select name="role" class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3 focus:ring-2 focus:ring-indigo-500">
                            <option value="" disabled>Выберите роль</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                    @switch($role->name)
                                        @case('Director') Директор @break
                                        @case('Manager') Менеджер @break
                                        @case('TechnicalSpecialist') Технический специалист @break
                                        @case('Admin') Администратор @break
                                        @default {{ $role->name }}
                                    @endswitch
                                </option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <div class="flex items-center gap-6 pb-4 border-b border-gray-100 dark:border-gray-800">
                        <div>
                            <img class="h-20 w-20 rounded-full object-cover border-2 border-indigo-500 p-0.5"
                                 src="{{ $user->getFirstMediaUrl('avatars', 'preview') ?: asset('img/default-avatar.png') }}" alt="Аватар">
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">Аватар</label>
                            <input type="file" name="avatar" accept="image/*"
                                   class="w-full text-sm text-gray-500 dark:text-gray-400 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900/30 dark:file:text-indigo-300">
                            <p class="text-xs text-gray-400 mt-1">Рекомендуемый размер: 300x300 px. Максимум 2 МБ.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">Фамилия</label>
                            <input type="text" name="l_name" value="{{ old('l_name', $user->getLastName()) }}"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">Имя</label>
                            <input type="text" name="f_name" value="{{ old('f_name', $user->getFirstName()) }}"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">Отчество</label>
                            <input type="text" name="m_name" value="{{ old('m_name', $user->getMiddleName()) }}"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->getEmail()) }}"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">Дата рождения</label>
                            <input type="date" name="birthday" value="{{ old('birthday', $user->getBirthday()) }}"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">Телефон</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->getPhone()) }}"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">Адрес проживания</label>
                            <input type="text" name="address" value="{{ old('address', $user->getAddress()) }}"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                        </div>
                    </div>
                @endif

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-800">
                    <a href="{{ $backRoute }}" class="px-6 py-2.5 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800 transition">Отмена</a>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white font-black rounded-xl hover:bg-indigo-700 shadow-md transition">Сохранить изменения</button>
                </div>
            </form>
        </div>
    </div>
@endsection
