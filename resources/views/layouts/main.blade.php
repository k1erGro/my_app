<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>My App</title>
</head>
<body class="bg-gray-100 min-h-screen">

<nav class="bg-white shadow-sm p-4 mb-8 z-50">
    <div class="max-w-5xl mx-auto flex justify-between items-center">
        <a href="{{ route('shop.index') }}">
            <span class="font-bold text-xl text-gray-800">My App</span>
        </a>
        <div class="flex items-center gap-4">
            <a href="{{ route('cart.show') }}" class="relative inline-block text-gray-700 hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>


            </a>

            <a href="{{ route('profile') }}">
                @if(auth()->user()->hasMedia('avatars'))
                    <img src="{{ auth()->user()->getFirstMediaUrl('avatars') }}" alt="Аватар" class="h-10 w-10 rounded-full object-cover">
                @else
                    <div class="h-12 w-12 bg-indigo-600 rounded-full flex items-center justify-center text-white">
                        {{ strtoupper(substr(auth()->user()->getFirstName(), 0, 1)) }}
                    </div>
                @endif
            </a>

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
