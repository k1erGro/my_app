<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Личный кабинет</title>
</head>
<body class="bg-gray-50">
<nav class="bg-white shadow-sm p-4 mb-8">
    <div class="max-w-4xl mx-auto flex justify-between items-center">
        <span class="font-bold text-xl text-gray-800">My App</span>
        <div class="flex">

            <a href="{{ route('profile') }}">
                <div class="relative inline-block">
                    <img class="h-11 w-11 rounded-full object-cover" src="{{ Auth::user()->getFirstMediaUrl('avatars', 'preview') }}" alt="Аватар">
                </div>
            </a>

            <div class="ml-5">
                @can('view', Auth::user())
                    <a class="text-blue-500 hover:text-red-700 font-medium" href="{{ route('admin.index') }}">Админ панель</a>
                @endcan
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Выйти</button>
                </form>
            </div>

        </div>
    </div>
</nav>

<main class="max-w-4xl mx-auto p-4">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-3xl font-bold mb-4">Добро пожаловать, {{ Auth::user()->getFirstName() }}!</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="p-4 bg-blue-50 rounded-lg">
                <p class="text-sm text-blue-600 font-semibold uppercase">Ваш Email</p>
                <p class="text-lg text-gray-800">{{ Auth::user()->getEmail() }}</p>
            </div>
            <div class="p-4 bg-green-50 rounded-lg">
                <p class="text-sm text-green-600 font-semibold uppercase">Ваша роль</p>
                <p class="text-lg text-gray-800">{{ Auth::user()->hasrole('Admin') ? 'Администратор' : 'Пользователь' }}</p>
            </div>
        </div>

    </div>
</main>

</body>
</html>
