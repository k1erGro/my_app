@extends('layouts.main')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Мои вопросы по заказам</h1>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg text-sm">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg text-sm">{{ session('error') }}</div>
        @endif

        @if($reports->isEmpty())
            <div class="bg-white border rounded-xl p-12 text-center shadow-sm">
                <p class="text-gray-500">Вы еще не задавали вопросов по заказам.</p>
            </div>
        @else
            <div class="space-y-6">
                @foreach($reports as $report)
                    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                        <div class="flex justify-between items-start border-b border-gray-100 pb-4 mb-4">
                            <div>
                                <span class="text-xs font-semibold uppercase tracking-wider text-blue-600">Заказ №{{ $report->order_id }}</span>
                                <h3 class="text-xl font-bold text-gray-900 mt-1">{{ $report->title }}</h3>
                            </div>
                            <span class="text-sm text-gray-400">{{ $report->created_at->format('d.m.Y H:i') }}</span>
                        </div>

                        <div class="text-gray-700 bg-gray-50 p-4 rounded-lg mb-4">
                            <p class="font-medium text-xs text-gray-400 uppercase mb-1">Ваш вопрос:</p>
                            {{ $report->description }}
                        </div>

                        @if($report->admin_answer)
                            <div class="text-gray-800 bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg">
                                <p class="font-medium text-xs text-blue-500 uppercase mb-1">Ответ администрации:</p>
                                {{ $report->admin_answer }}
                            </div>
                        @else
                            <div class="flex justify-between items-center bg-yellow-50 text-yellow-800 px-4 py-3 rounded-lg text-sm">
                                <span>В ожидании ответа администратора...</span>
                                <a href="{{ route('order-report.edit', $report->id) }}" class="text-blue-600 hover:underline font-medium">
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
