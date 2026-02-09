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
        <div>
            @if(Auth::guard('web')->user()->is_admin == 1)
                <a class="text-blue-500 hover:text-red-700 font-medium" href="{{ route('admin.index') }}">Админ панель</a>
            @endif
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Выйти</button>
            </form>
        </div>
    </div>
</nav>

<main class="max-w-4xl mx-auto p-4">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-3xl font-bold mb-4">Добро пожаловать, {{ $firstName }}!</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="p-4 bg-blue-50 rounded-lg">
                <p class="text-sm text-blue-600 font-semibold uppercase">Ваш Email</p>
                <p class="text-lg text-gray-800">{{ auth()->user()->email }}</p>
            </div>
            <div class="p-4 bg-green-50 rounded-lg">
                <p class="text-sm text-green-600 font-semibold uppercase">Ваша роль</p>
                <p class="text-lg text-gray-800">{{ auth()->user()->role }}</p>
            </div>
        </div>

        <div class="mt-8 border-t pt-6">
            <h3 class="text-lg font-semibold mb-2">Статус сессии:</h3>
            <p class="text-gray-600">
                Данные этого профиля сейчас хранятся в
                <span class="bg-red-100 text-red-700 px-2 py-1 rounded font-mono">Redis</span>
            </p>
        </div>
    </div>
</main>

</body>
</html>
