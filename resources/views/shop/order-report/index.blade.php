@extends('layouts.main')

@section('content')
    <div class="max-w-5xl mx-auto px-6 py-12">
        <h1 class="text-4xl font-black uppercase tracking-tighter text-gray-900 dark:text-white mb-8">Мои вопросы по заказам</h1>

        @if(session('success'))
            <div class="mb-6 px-5 py-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 rounded-xl text-sm">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 px-5 py-3 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 rounded-xl text-sm">
                {{ session('error') }}
            </div>
        @endif

        @if($reports->isEmpty())
            <div class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-12 text-center shadow-sm">
                <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-gray-500 dark:text-gray-400">Вы еще не задавали вопросов по заказам.</p>
            </div>
        @else
            <div class="space-y-6">
                @foreach($reports as $report)
                    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-300">
                        <!-- Шапка карточки -->
                        <div class="flex flex-wrap justify-between items-start gap-3 border-b border-gray-100 dark:border-gray-800 pb-4 mb-4">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400"><a href="{{ route('orders.show', $report->order_id) }}">Заказ №{{ $report->order_id }}</a></span>
                                <h3 class="text-xl font-black uppercase tracking-tight text-gray-900 dark:text-white mt-1">{{ $report->title }}</h3>
                            </div>
                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $report->created_at->format('d.m.Y H:i') }}</span>
                        </div>

                        <!-- Текст вопроса -->
                        <div class="text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-800/50 p-4 rounded-xl mb-4">
                            <p class="font-bold text-xs text-gray-400 dark:text-gray-500 uppercase mb-1">Ваш вопрос:</p>
                            <p class="leading-relaxed">{{ $report->description }}</p>
                        </div>

                        <!-- Блок ответа администрации -->
                        @if($report->admin_answer)
                            <div class="bg-indigo-50 dark:bg-indigo-900/20 border-l-4 border-indigo-500 p-4 rounded-r-xl">
                                <p class="font-bold text-xs text-indigo-600 dark:text-indigo-400 uppercase mb-1">Ответ администрации:</p>
                                <p class="text-gray-800 dark:text-gray-200 leading-relaxed">{{ $report->admin_answer }}</p>
                            </div>
                        @else
                            <div class="flex flex-wrap justify-between items-center gap-3 bg-yellow-50 dark:bg-yellow-900/20 text-yellow-800 dark:text-yellow-300 px-4 py-3 rounded-xl text-sm">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                В ожидании ответа администратора...
                            </span>
                                <a href="{{ route('order-report.edit', $report->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline font-bold">
                                    Редактировать вопрос
                                </a>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
