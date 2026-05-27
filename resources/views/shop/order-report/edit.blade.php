@extends('layouts.main')

@section('content')
    <div class="max-w-2xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Редактировать вопрос по заказу №{{ $report->order_id }}</h1>

        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <form action="{{ route('order-report.update', $report->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Тема вопроса</label>
                    <input type="text" name="title" value="{{ old('title', $report->title) }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ваш вопрос</label>
                    <textarea name="description" rows="5" required
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm">{{ old('description', $report->description) }}</textarea>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <a href="{{ route('order-report.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg text-sm hover:bg-gray-50">
                        Назад
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">
                        Сохранить изменения
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
