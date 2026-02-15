<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Профиль пользователя</title>
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-white shadow-sm p-4 mb-8">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <span class="font-bold text-xl text-gray-800">My App</span>
            <div class="flex items-center gap-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Выйти</button>
                </form>
            </div>
        </div>
    </nav>

    @yield('content')

</body>
</html>
