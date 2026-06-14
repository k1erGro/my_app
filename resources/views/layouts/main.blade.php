<!DOCTYPE html>
<html lang="ru" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        bg: '#ffffff',
                        block: '#f3f4f6',
                        text: '#111827',
                        accent: '#4f46e5',
                    }
                }
            }
        }
    </script>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,100..900&display=swap" rel="stylesheet">
    <title>Электроника</title>
</head>
<body
    class="bg-white text-gray-900 dark:bg-gray-950 dark:text-gray-100 min-h-screen flex flex-col transition-colors duration-300">

<nav class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 sticky top-0 z-50">
    <div class="max-w-[1600px] mx-auto px-4 sm:px-6 h-24 flex items-center justify-between">

        <a href="{{ route('shop.index') }}" class="text-3xl font-black text-gray-900 dark:text-white uppercase tracking-tighter z-20">
            Электроника<span class="text-indigo-600">.</span>
        </a>

        <div class="hidden xl:flex items-center gap-8">
            <div class="flex-1 max-w-2xl">
                <livewire:header-search/>
            </div>
            <div class="flex items-center gap-8">
                @if(Auth::check())
                    <a href="{{ route('notifications.list') }}" class="relative text-gray-500 hover:text-indigo-600 font-bold uppercase text-xs tracking-widest transition">
                        Уведомления
                        @if(isset($globalUnreadCount) && $globalUnreadCount > 0)
                            <span class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white shadow-sm ring-2 ring-white dark:ring-gray-900">
                            {{ $globalUnreadCount }}
                        </span>
                        @endif
                    </a>
                    <a href="{{ route('favourites.list') }}" class="text-gray-500 hover:text-indigo-600 font-bold uppercase text-xs tracking-widest transition">Избранное</a>
                    <a href="{{ route('cart.show') }}" class="relative inline-flex items-center text-gray-500 hover:text-indigo-600 font-bold uppercase text-xs tracking-widest transition pr-4 py-1">
                        Корзина
                        @if(isset($cartCount) && $cartCount > 0)
                            <span class="absolute -top-1 -right-2 flex h-5 w-5 items-center justify-center rounded-full bg-indigo-600 text-[10px] font-bold text-white shadow-sm ring-2 ring-white dark:ring-gray-900 animate-pulse">
                            {{ $cartCount }}
                        </span>
                        @endif
                    </a>
                    <a href="{{ route('orders.index') }}" class="text-gray-500 hover:text-indigo-600 font-bold uppercase text-xs tracking-widest transition">Заказы</a>
                @endif
            </div>
            <div class="flex items-center gap-4 pl-8 border-l border-gray-200 dark:border-gray-800">
                <!-- Переключатель темы -->
                <div x-data="{
                    darkMode: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches),
                    init() { this.applyTheme(this.darkMode); this.$watch('darkMode', (val) => this.applyTheme(val)); },
                    applyTheme(val) {
                        if (val) { document.documentElement.classList.add('dark'); localStorage.setItem('theme', 'dark'); }
                        else { document.documentElement.classList.remove('dark'); localStorage.setItem('theme', 'light'); }
                    },
                    toggle() { this.darkMode = !this.darkMode; }
                }" x-init="init()" @click="toggle" class="p-2 rounded-full cursor-pointer text-gray-500 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg x-show="darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path></svg>
                </div>
                @if (Auth::check())
                    <div class="flex items-center gap-3">
                        <a href="{{ route('profile') }}">
                            <img class="h-12 w-12 rounded-full object-cover border border-gray-300" src="{{ Auth::user()->getFirstMediaUrl('avatars', 'preview') }}" alt="User">
                        </a>
                        <div class="flex flex-col">
                            <span class="font-bold text-sm">{{ Auth::user()->name }}</span>
                            <div class="flex flex-col">
                                @can('login-to-admin-panel')
                                    <a class="text-[10px] text-gray-500 font-bold uppercase hover:text-indigo-600" href="{{ route('admin.index') }}">Админка</a>
                                @endcan
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-[10px] text-gray-500 font-bold uppercase hover:text-red-600">Выйти</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('show.login') }}" class="bg-indigo-600 text-white px-6 py-2.5 font-bold text-sm hover:bg-indigo-700 transition">Войти</a>
                @endif
            </div>
        </div>

        <!-- Бургер-меню для мобильных устройств (отображается на экранах меньше xl) -->
        <div x-data="{ open: false }" class="xl:hidden flex items-center">
            <button @click="open = !open" class="p-2 rounded-md text-gray-500 hover:text-indigo-600 focus:outline-none transition">
                <svg x-show="!open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                <svg x-show="open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <!-- Мобильное меню (выезжает сверху под шапку) -->
            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="absolute top-full left-0 right-0 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 shadow-xl p-5 z-50">
                <div class="space-y-6">
                    <!-- Поиск -->
                    <livewire:header-search/>

                    <!-- Ссылки для авторизованных -->
                    @if(Auth::check())
                        <div class="grid place-items-center grid-cols-2 gap-4">
                            <a href="{{ route('notifications.list') }}" class="text-gray-700 dark:text-gray-300 font-bold uppercase text-sm tracking-widest hover:text-indigo-600 transition">
                                Уведомления
                                @if(isset($globalUnreadCount) && $globalUnreadCount > 0)
                                    <span class="ml-1 inline-flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-[10px] text-white">{{ $globalUnreadCount }}</span>
                                @endif
                            </a>
                            <a href="{{ route('favourites.list') }}" class="text-gray-700 dark:text-gray-300 font-bold uppercase text-sm tracking-widest hover:text-indigo-600 transition">Избранное</a>
                            <a href="{{ route('cart.show') }}" class="relative text-gray-700 dark:text-gray-300 font-bold uppercase text-sm tracking-widest hover:text-indigo-600 transition">
                                Корзина
                                @if(isset($cartCount) && $cartCount > 0)
                                    <span class="ml-1 inline-flex h-5 w-5 items-center justify-center rounded-full bg-indigo-600 text-[10px] text-white">{{ $cartCount }}</span>
                                @endif
                            </a>
                            <a href="{{ route('orders.index') }}" class="text-gray-700 dark:text-gray-300 font-bold uppercase text-sm tracking-widest hover:text-indigo-600 transition">Заказы</a>
                        </div>
                    @endif

                    <!-- Блок пользователя / авторизация -->
                    <div class="border-t border-gray-100 dark:border-gray-800 pt-4">
                        @if(Auth::check())
                            <div class="flex items-center gap-3">
                                <img class="h-12 w-12 rounded-full object-cover border border-gray-300" src="{{ Auth::user()->getFirstMediaUrl('avatars', 'preview') }}" alt="User">
                                <div>
                                    <div class="font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</div>
                                    <div class="flex flex-col gap-3 mt-1">
                                        @can('login-to-admin-panel')
                                            <a class="text-xs text-gray-500 uppercase hover:text-indigo-600" href="{{ route('admin.index') }}">Админка</a>
                                        @endcan
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button class="text-xs text-gray-500 uppercase hover:text-red-600">Выйти</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('show.login') }}" class="block w-full text-center bg-indigo-600 text-white px-4 py-2.5 font-bold rounded-xl hover:bg-indigo-700 transition">Войти</a>
                        @endif
                    </div>

                    <!-- Переключатель темы (дублируем для мобильной версии) -->
                    <div class="border-t border-gray-100 dark:border-gray-800 pt-4 flex justify-between items-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Тёмная тема</span>
                        <div x-data="{
                            darkMode: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches),
                            init() { this.applyTheme(this.darkMode); this.$watch('darkMode', (val) => this.applyTheme(val)); },
                            applyTheme(val) {
                                if (val) { document.documentElement.classList.add('dark'); localStorage.setItem('theme', 'dark'); }
                                else { document.documentElement.classList.remove('dark'); localStorage.setItem('theme', 'light'); }
                            },
                            toggle() { this.darkMode = !this.darkMode; }
                        }" x-init="init()" @click="toggle" class="p-2 rounded-full cursor-pointer text-gray-500 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                            <svg x-show="!darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                            <svg x-show="darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<main class="flex-grow py-12 px-6 bg-gray-50 dark:bg-gray-950">
    <div class="max-w-[1600px] mx-auto">
        @yield('content')
    </div>
</main>

<footer class="bg-gray-900 text-gray-400 py-16">
    <div class="max-w-[1600px] mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-16">
        <div>
            <h2 class="font-black text-2xl text-white">Электроника</h2>
            <p class="mt-4">Премиальная техника для жизни.</p>
        </div>
        <div>
            <h3 class="font-bold uppercase text-sm mb-4 tracking-widest text-white">Навигация</h3>
            <a href="{{ route('catalog.index') }}" class="block hover:text-white py-1">Каталог</a>
        </div>
        <div>
            <h3 class="font-bold uppercase text-sm mb-4 tracking-widest text-white">Контакты</h3>
            <p class="py-1 text-xl font-bold text-white">+7 (800) 555-35-35</p>
        </div>
    </div>
</footer>

@livewireScripts
</body>
</html>
