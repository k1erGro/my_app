<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="flex min-h-screen">
    <aside class="w-64 bg-slate-800 text-white p-6">
        <h1 class="text-2xl font-bold mb-8 text-blue-400">Admin Panel</h1>
        <nav class="space-y-2">
            <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 bg-slate-700">
                Пользователи
            </a>
        </nav>
    </aside>

    <main class="flex-1 p-10">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>
</div>
</body>
</html>
