<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>My App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
<nav class="bg-white shadow-sm p-4 mb-8 z-50">
    <div class="max-w-5xl mx-auto flex justify-between items-center">
        <a href="{{ route('shop.index') }}">
            <span class="font-bold text-xl text-gray-800">My App</span>
        </a>
        <div class="flex items-center gap-4">
            <a href="{{ route('cart.show') }}" class="relative inline-block text-gray-700 hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>


            </a>
            @if (Auth::check())
            <a href="{{ route('profile') }}">
                <div class="relative inline-block">
                    <img class="h-11 w-11 rounded-full object-cover" src="{{ Auth::user()->getFirstMediaUrl('avatars', 'preview') }}" alt="Аватар">
                </div>
            </a>
            <div>
                @can('view', Auth::user())
                    <a class="text-blue-500 hover:text-red-700 font-medium" href="{{ route('admin.index') }}">Админ панель</a>
                @endcan
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Выйти</button>
                </form>
                </div>
            @else
                <a href="{{ route('show.login') }}">Войти</a>
            @endif
        </div>
    </div>
</nav>

@yield('content')

</body>
</html>
