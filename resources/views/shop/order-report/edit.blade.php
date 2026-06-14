@extends('layouts.main')

@section('content')
    <div class="max-w-2xl mx-auto px-6 py-12">
        <h1 class="text-3xl font-black uppercase tracking-tighter text-gray-900 dark:text-white mb-6">
            Редактировать вопрос по заказу №{{ $report->order_id }}
        </h1>

        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">
            <form action="{{ route('order-report.update', $report->id) }}" method="POST" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">Тема вопроса</label>
                    <input type="text" name="title" value="{{ old('title', $report->title) }}" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                </div>

                <div>
                    <label class="block text-sm font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-2">Ваш вопрос</label>
                    <textarea name="description" rows="5" required
                              class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">{{ old('description', $report->description) }}</textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('order-report.index') }}"
                       class="px-6 py-2.5 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                        Назад
                    </a>
                    <button type="submit"
                            class="px-6 py-2.5 bg-indigo-600 text-white font-black rounded-xl hover:bg-indigo-700 shadow-md transition">
                        Сохранить изменения
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
