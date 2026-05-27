@extends('layouts.admin')
@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Вопросы по заказам от пользователей</h1>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg text-sm">{{ session('success') }}</div>
        @endif

        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
            <table class="w-full text-left border-collapse">
                <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-gray-400 text-xs font-semibold uppercase">
                    <th class="p-4">Заказ / Пользователь</th>
                    <th class="p-4">Тема и вопрос</th>
                    <th class="p-4 w-1/3">Ответ администрации</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                @foreach($reports as $report)
                    <tr class="hover:bg-gray-50/50 transition-colors align-top">
                        <td class="p-4">
                            <div class="font-bold text-gray-900">Заказ №{{ $report->order_id }}</div>
                            <div class="text-gray-500 text-xs mt-1">Клиент: {{ $report->user->name ?? 'Удален' }}</div>
                            <div class="text-gray-400 text-xs">{{ $report->created_at->format('d.m.Y H:i') }}</div>
                        </td>
                        <td class="p-4">
                            <div class="font-semibold text-gray-800 mb-1">{{ $report->title }}</div>
                            <div class="text-gray-600 bg-gray-50 p-3 rounded-lg max-w-xl">{{ $report->description }}</div>
                        </td>
                        <td class="p-4">
                            <form action="{{ route('admin.order-reports.answer', $report->id) }}" method="POST" class="space-y-2">
                                @csrf
                                @method('PATCH')
                                <textarea name="admin_answer" rows="3" required placeholder="Напишите ответ..."
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:ring-blue-500 focus:border-blue-500">{{ $report->admin_answer }}</textarea>
                                <div class="flex justify-end">
                                    <button type="submit" class="px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-md shadow-sm transition">
                                        {{ $report->admin_answer ? 'Обновить ответ' : 'Ответить' }}
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @if($reports->isEmpty())
                <div class="p-8 text-center text-gray-500">Вопросов пока нет</div>
            @endif
        </div>
    </div>
@endsection
