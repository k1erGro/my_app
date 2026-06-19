@php use Illuminate\Support\Facades\Auth; @endphp
@extends(Auth::user()->hasRole(\App\Enums\RoleEnum::ADMIN) ? 'layouts.admin' : 'layouts.main')

@section('content')
    @php
        $isAdmin = Auth::user()->hasRole(\App\Enums\RoleEnum::ADMIN);
        $action = $isAdmin ? route('admin.update', $user->getKey()) : route('profile.update', $user->getKey());
        $backRoute = $isAdmin ? route('admin.index') : route('profile');
        $backText = $isAdmin ? 'Назад к списку пользователей' : 'Назад в профиль';
    @endphp

    <div class="max-w-2xl mx-auto px-4 py-8">
        <!-- Заголовок и навигация -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ $isAdmin ? "Изменение роли" : 'Редактирование профиля' }}
            </h1>
            <a href="{{ $backRoute }}" class="text-sm text-gray-500 hover:text-indigo-600 dark:hover:text-indigo-400 flex items-center gap-1 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                {{ $backText }}
            </a>
        </div>

        <!-- Ошибки валидации -->
        @if ($errors->any())
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/50 text-red-700 dark:text-red-400 px-4 py-3 rounded-xl mb-6 text-sm">
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Успешное уведомление -->
        @if(session('success'))
            <div class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800/50 text-emerald-700 dark:text-emerald-400 px-4 py-3 rounded-xl mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Основная карточка формы -->
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">
            <form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PATCH')

                @if($isAdmin)
                    <!-- Режим Администратора: Информация о юзере -->
                    <div class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-800/50 rounded-xl border border-gray-100 dark:border-gray-800">
                        <img class="h-12 w-12 rounded-full object-cover ring-2 ring-gray-200 dark:ring-gray-700"
                             src="{{ $user->getFirstMediaUrl('avatars', 'preview') ?: asset('img/default-avatar.png') }}" 
                             alt="Аватар">
                        <div>
                            <div class="font-semibold text-gray-900 dark:text-white leading-tight">{{ $user->getFullName() }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">{{ $user->getEmail() }}</div>
                        </div>
                    </div>
                    
                    <!-- Режим Администратора: Выбор роли -->
                    <div>
                        <label for="role-select" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Роль пользователя
                        </label>
                        <select id="role-select" name="role" 
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-3 py-2.5 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition shadow-sm cursor-pointer">
                            <option value="" disabled {{ !$user->roles->count() ? 'selected' : '' }}>Выберите роль</option>
                            
                            @php
                                $roleNames = [
                                    'Director' => 'Директор',
                                    'Manager' => 'Менеджер',
                                    'TechnicalSpecialist' => 'Технический специалист',
                                    'Admin' => 'Администратор'
                                ];
                            @endphp
                
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                    {{ $roleNames[$role->name] ?? $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <!-- Режим Пользователя: Загрузка аватара -->
                    <div class="flex flex-col sm:flex-row items-center gap-5 pb-6 border-b border-gray-100 dark:border-gray-800">
                        <img class="h-16 w-16 rounded-full object-cover border-2 border-indigo-500 p-0.5 shadow-sm"
                             src="{{ $user->getFirstMediaUrl('avatars', 'preview') ?: asset('img/default-avatar.png') }}" alt="Аватар">
                        <div class="flex-1 w-full">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Аватар профиля</label>
                            <input type="file" name="avatar" accept="image/*"
                                   class="w-full text-sm text-gray-500 dark:text-gray-400 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900/30 dark:file:text-indigo-300 transition">
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1.5">Рекомендуемый размер: 300x300 px. Максимум 2 МБ.</p>
                        </div>
                    </div>

                    <!-- Режим Пользователя: Личные данные -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Фамилия</label>
                            <input type="text" name="l_name" value="{{ old('l_name', $user->getLastName()) }}"
                                   class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition shadow-sm text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Имя</label>
                            <input type="text" name="f_name" value="{{ old('f_name', $user->getFirstName()) }}"
                                   class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition shadow-sm text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Отчество</label>
                            <input type="text" name="m_name" value="{{ old('m_name', $user->getMiddleName()) }}"
                                   class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition shadow-sm text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->getEmail()) }}"
                                   class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition shadow-sm text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Дата рождения</label>
                            <input type="date" name="birthday" value="{{ old('birthday', $user->getBirthday()) }}"
                                   class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition shadow-sm text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Телефон</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->getPhone()) }}"
                                   class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition shadow-sm text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Адрес проживания</label>
                            <input type="text" name="address" value="{{ old('address', $user->getAddress()) }}"
                                   class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition shadow-sm text-sm">
                        </div>
                    </div>
                @endif

                <!-- Нижняя панель действий -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-800">
                    <a href="{{ $backRoute }}" 
                       class="px-4 py-2 text-sm border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                        Отмена
                    </a>
                    <button type="submit" 
                            class="px-5 py-2 text-sm bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 shadow-sm hover:shadow transition">
                        Сохранить изменения
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection