<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>My App</title>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
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
            <a href="{{ route('orders.index') }}" class="relative inline-block text-gray-700 hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </a>
            @if (Auth::check())
                <a href="{{ route('profile') }}">
                    <div class="relative inline-block">
                        <img class="h-11 w-11 rounded-full object-cover"
                             src="{{ Auth::user()->getFirstMediaUrl('avatars', 'preview') }}" alt="Аватар">
                    </div>
                </a>
                <div>
                    @can('login-to-admin-panel')
                        <a class="text-blue-500 hover:text-red-700 font-medium" href="{{ route('admin.index') }}">Админ
                            панель</a>
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
<main class="flex-grow">
    @yield('content')
</main>
<footer class="bg-white border-t border-gray-200 mt-7">
    <div class="max-w-5xl mx-auto px-4 py-10">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-sm">

            <div>
                <h2 class="text-lg font-bold text-gray-800">My App</h2>
                <p class="mt-3 text-gray-500">
                    Комплектующие и готовые решения для геймеров и профессионалов.
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-700 mb-3">Навигация</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('catalog.index') }}" class="text-gray-500 hover:text-blue-600 transition">Каталог</a>
                    </li>

                </ul>
            </div>

            <div>
                <h3 class="font-semibold text-gray-700 mb-3">Контакты</h3>
                <ul class="space-y-2 text-gray-500">
                    <li>Email: support@myapp.ru</li>
                    <li>Телефон: +7 (999) 123-45-67</li>
                </ul>
            </div>

        </div>

        <div class="mt-8 pt-6 border-t border-gray-200 text-center text-xs text-gray-400">
            © {{ date('Y') }} My App. Все права защищены.
        </div>

    </div>
</footer>
</body>
</html>
