@extends('layouts.main')
@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Ваши уведомления</h1>
        </div>

        @if(!Auth::check())
            <div class="text-center py-20 bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="mb-4">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-900">Требуется авторизация</h2>
                <p class="mt-2 text-gray-500 text-sm">Войдите в профиль, чтобы получать уведомления.</p>
                <a href="{{ route('show.login') }}"
                   class="mt-6 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition">
                    Авторизоваться
                </a>
            </div>
        @else
            <div class="grid gap-6">
                @foreach ($notifications as $notification)
                    @php
                        $type = $notification->data['type'] ?? 'default';
                    @endphp

                    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition-all duration-200">
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
                                        <span class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                                    </div>

                                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition">
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

                                    <p class="text-gray-600 mt-2">
                                        {{ $notification->data['message'] ?? 'У вас новое уведомление' }}
                                    </p>
                                </a>

                                <form action="{{ route('notifications.delete', $notification->getKey()) }}"
                                      method="POST"
                                      onsubmit="return confirm('Удалить уведомление?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 hover:bg-gray-100 rounded-full transition">
                                        <svg class="w-5 h-5 text-red-500 hover:text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <div class="mt-12 pt-6 border-t border-gray-200">
        {{ $notifications?->links() }}
    </div>
@endsection
