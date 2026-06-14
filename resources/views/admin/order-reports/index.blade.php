@extends('layouts.admin')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">Вопросы по заказам от пользователей</h2>
    </div>


    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                <th class="px-5 py-3">Заказ / Пользователь</th>
                <th class="px-5 py-3">Тема и вопрос</th>
                <th class="px-5 py-3 w-1/3">Ответ администрации</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @foreach($reports as $report)
                <tr class="border-b border-gray-200 hover:bg-gray-50 align-top">
                    <td class="px-5 py-5">
                        <p class="font-bold text-gray-900">Заказ №{{ $report->order_id }}</p>
                        <p class="text-gray-500 text-xs mt-1">Клиент: {{ $report->user->name ?? 'Удален' }}</p>
                        <p class="text-gray-400 text-xs mt-0.5">{{ $report->created_at->format('d.m.Y H:i') }}</p>
                    </td>

                    <td class="px-5 py-5">
                        <p class="font-semibold text-gray-800 mb-1">{{ $report->title }}</p>
                        <div class="text-gray-600 bg-gray-50 p-3 rounded-lg max-w-xl border border-gray-100">{{ $report->description }}</div>
                    </td>

                    <td class="px-5 py-5">
                        <form action="{{ route('admin.order-reports.answer', $report->id) }}" method="POST" class="space-y-2">
                            @csrf
                            @method('PATCH')
                            <textarea name="admin_answer" rows="3" required placeholder="Напишите ответ..."
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 outline-none">{{ $report->admin_answer }}</textarea>
                            <div class="flex justify-end">
                                <button type="submit" class="px-4 py-1.5 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded shadow transition">
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
            <div class="p-8 text-center text-gray-500 border-b border-gray-200">
                Вопросов пока нет
            </div>
        @endif
    </div>

    @if(method_exists($reports, 'links'))
        <div class="mt-4">
            {{ $reports->links() }}
        </div>
    @endif
@endsection
