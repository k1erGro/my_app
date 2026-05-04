<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
<div class="flex min-h-screen">
    <aside class="w-64 flex flex-col bg-slate-800 text-white p-6">
        <h1 class="text-2xl font-bold mb-8 text-blue-400">Admin Panel</h1>
        <nav class="space-y-2 flex-grow">
            <a href="{{ route('admin.index') }}"
               class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 bg-slate-700">
                Пользователи
            </a>
            <a href="{{ route('admin.category.index') }}"
               class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 bg-slate-700">
                Категории
            </a>
            <a href="{{ route('admin.product.index') }}"
               class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 bg-slate-700">
                Товары
            </a>
            <a href="{{ route('admin.subCategory.index') }}"
               class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 bg-slate-700">
                Подкатегории
            </a>
            <a href="{{ route('admin.property.index') }}"
               class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 bg-slate-700">
                Характеристики
            </a>
            <a href="{{ route('admin.address.index') }}"
               class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 bg-slate-700">
                Адреса
            </a>
            <a href="{{ route('admin.orders.index') }}"
               class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 bg-slate-700">
                Заказы
            </a>
            <a href="{{ route('admin.reviews.index') }}"
               class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 bg-slate-700">
                Отзывы
            </a>
        </nav>
        <div class="">
            <a href="{{ route('shop.index') }}"
               class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 bg-slate-700">
                Назад
            </a>
        </div>

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
