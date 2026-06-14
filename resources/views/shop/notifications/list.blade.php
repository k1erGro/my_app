@extends('layouts.main')
@section('content')
    <div class="max-w-[1600px] mx-auto px-6 py-12">
        <h1 class="text-4xl font-black uppercase tracking-tighter text-gray-900 dark:text-white mb-8">Уведомления</h1>

        @if(!Auth::check())
            <div class="text-center py-20 bg-gray-50 dark:bg-gray-900 rounded-3xl">
                <div class="mb-4">
                    <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-black text-gray-900 dark:text-white">Требуется авторизация</h2>
                <p class="mt-2 text-gray-500 dark:text-gray-400">Войдите в профиль, чтобы получать уведомления.</p>
                <a href="{{ route('show.login') }}"
                   class="mt-6 inline-flex items-center px-8 py-3 bg-indigo-600 text-white font-bold rounded-full hover:bg-indigo-700 transition shadow-md">
                    Авторизоваться
                </a>
            </div>
        @else
            <div class="grid gap-5">
                @forelse ($notifications as $notification)
                    @php
                        $type = $notification->data['type'] ?? 'default';
                    @endphp
                    <div class="group bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden hover:shadow-xl transition-all duration-300">
                        <div class="p-6">
                            <div class="flex justify-between items-start gap-4">
                                <a href="{{ route('notification.show', $notification->getKey()) }}" class="flex-1">
                                    <div class="flex items-center gap-3 mb-3">
                                        @switch($type)
                                            @case('product_entrance')
                                                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                @break
                                            @case('product_arrival')
                                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                                </svg>
                                                @break
                                            @default
                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                        @endswitch
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                    <h3 class="text-xl font-black uppercase tracking-tight text-gray-900 dark:text-white">
                                        @switch($type)
                                            @case('product_entrance')
                                                Новый товар на складе
                                                @break
                                            @case('product_arrival')
                                                Товар снова в наличии
                                                @break
                                            @default
                                                Уведомление
                                        @endswitch
                                    </h3>
                                    <p class="text-gray-600 dark:text-gray-300 mt-2">
                                        {{ $notification->data['message'] ?? 'У вас новое уведомление' }}
                                    </p>
                                </a>
                                <form action="{{ route('notifications.delete', $notification->getKey()) }}"
                                      method="POST"
                                      onsubmit="return confirm('Удалить уведомление?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-full transition">
                                        <svg class="w-5 h-5 text-red-500 hover:text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-gray-50 dark:bg-gray-900 rounded-3xl">
                        <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <p class="text-xl text-gray-500 dark:text-gray-400 mt-4">Нет уведомлений</p>
                    </div>
                @endforelse
            </div>

            @if($notifications->hasPages())
                <div class="mt-12 pt-6 border-t border-gray-200 dark:border-gray-800">
                    {{ $notifications->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection
