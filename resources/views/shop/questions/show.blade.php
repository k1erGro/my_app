@extends('layouts.main')
@section('content')
    <div class="max-w-4xl mx-auto px-6 py-12">
        <div class="flex items-center justify-between mb-8">
            <a href="{{ route('product.show', $question->getProduct()->getSlug()) }}"
               class="inline-flex items-center gap-2 text-gray-500 hover:text-indigo-600 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Назад к товару
            </a>
        </div>

        <!-- Карточка вопроса -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-800 overflow-hidden mb-8">
            <div class="p-6 md:p-8">
                <h1 class="text-2xl md:text-3xl font-black uppercase tracking-tighter text-gray-900 dark:text-white mb-4">
                    {{ $question->getTitle() }}
                </h1>
                <div class="text-gray-700 dark:text-gray-300 text-base leading-relaxed">
                    {{ $question->getDescription() }}
                </div>
                <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                    Вопрос от {{ $question->getUser()?->getFirstName() }} • {{ $question->created_at->format('d.m.Y H:i') }}
                </div>
            </div>
        </div>

        <!-- Форма отправки ответа (доступна всем авторизованным) -->
        @auth
            <div class="bg-gray-50 dark:bg-gray-800/50 rounded-2xl p-6 border border-gray-200 dark:border-gray-800 mb-8">
                <h3 class="text-lg font-black uppercase tracking-tighter text-gray-900 dark:text-white mb-4">Ваш ответ</h3>
                <form action="{{ route('answer.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input name="product_id" type="hidden" value="{{ $question->getProduct()->getKey() }}">
                    <input name="question_id" type="hidden" value="{{ $question->getKey() }}">
                    <textarea required name="description" placeholder="Напишите ответ..."
                              class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white p-4 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"></textarea>
                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-black uppercase tracking-widest rounded-xl hover:bg-indigo-600 dark:hover:bg-indigo-500 hover:text-white transition shadow-md">
                        Опубликовать ответ
                    </button>
                </form>
            </div>
        @endauth

        <!-- Список ответов -->
        <h2 class="text-2xl font-black uppercase tracking-tighter text-gray-900 dark:text-white mb-6">Ответы ({{ $question->getAnswers()->count() }})</h2>
        <div class="space-y-5">
            @foreach($question->answers as $answer) {{-- Убедитесь, что связь называется так, либо замените на ваш метод получения ответов --}}
            {{-- Инициализируем изолированную область данных Alpine для каждого ответа --}}
            <div x-data="{ editing: false, answerDesc: '{{ addslashes($answer->getDescription()) }}' }"
                 class="bg-gray-50 dark:bg-gray-800/40 border border-gray-200 dark:border-gray-800 rounded-2xl p-6 transition-all">

                <div class="flex justify-between items-start mb-3">
                    <div class="flex items-center gap-3">
                        <img class="h-8 w-8 rounded-full object-cover border border-gray-200 dark:border-gray-700"
                             src="{{ $answer->getUser()->getFirstMediaUrl('avatars', 'preview') }}"
                             alt="Аватар">
                        <span class="text-sm font-bold text-gray-900 dark:text-white">
                    {{ $answer->getUser()->getFirstName() }}
                </span>

                        {{-- Показываем бейдж, если ответил администратор --}}
                        @if($answer->getUser()->hasRole('Admin'))
                            <span class="bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-[10px] uppercase tracking-wider font-extrabold px-2 py-0.5 rounded-full border border-indigo-100 dark:border-indigo-900/50">
                        Администрация
                    </span>
                        @endif

                        {{-- Кнопка редактирования (карандашик) --}}
                        @if(Auth::user() && Auth::user()->getKey() === $answer->getUser()->getKey())
                            <button @click="editing = !editing"
                                    class="text-gray-400 hover:text-indigo-600 transition"
                                    title="Редактировать ответ">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>

                {{-- Отображение текста ответа (скрывается при редактировании) --}}
                <div x-show="!editing" class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                    {{ $answer->getDescription() }}
                </div>

                {{-- Форма редактирования ответа (показывается при editing === true) --}}
                <div x-show="editing" class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-700" style="display: none;">
                    {{-- Предполагаю, что роут называется answer.update. Если это не так, замените на ваш --}}
                    <form action="{{ route('answer.update', $answer->getKey()) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('patch')

                        <input name="product_id" type="hidden" value="{{ $question->getProduct()->getKey() }}">
                        <input name="question_id" type="hidden" value="{{ $question->getKey() }}">

                        <textarea name="description" rows="3" required x-model="answerDesc"
                                  class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white p-4 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>

                        <div class="flex gap-3">
                            <button type="submit"
                                    class="bg-indigo-600 text-white rounded-xl py-2 px-6 font-bold hover:bg-indigo-700 transition text-sm">
                                Сохранить
                            </button>
                            {{-- Кнопка отмены скрывает форму и сбрасывает текст к исходному --}}
                            <button type="button"
                                    @click="editing = false; answerDesc = '{{ addslashes($answer->getDescription()) }}'"
                                    class="text-gray-500 hover:text-gray-700 font-medium text-sm">
                                Отмена
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
