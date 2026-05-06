@extends(Auth::user()->hasRole('Admin') ? 'layouts.admin' : 'layouts.main')
@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div class="flex space-x-3">
                <a href="{{ route('product.show', $question->getProduct()->getSlug()) }}"
                   class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition">
                    Назад
                </a>
            </div>
        </div>

        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="p-6">
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-8">
                    <div class="sm:col-span-1">
                        <dt class="font-bold text-gray-900 text-3xl tracking-wide">{{ $question->getTitle() }}</dt>
                        <dd class="mt-1 text-xl text-gray-900">{{ $question->getDescription() }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <div class="mt-5 mb-5">
            <form action="{{ route('answer.store') }}" method="POST">
                @csrf
                <input name="product_id" type="hidden" value="{{ $question->getProduct()->getKey() }}">
                <input name="question_id" type="hidden" value="{{ $question->getKey() }}">

                <div class="md:col-span-3">
                    <textarea required name="description" placeholder="Ваш ответ..."
                              class="w-full rounded-xl border-gray-200 p-4 border"></textarea>
                </div>

                <button type="submit"
                        class="bg-blue-600 text-white rounded-xl py-3 px-8 font-bold hover:bg-blue-700 transition uppercase text-xs tracking-widest">
                    Опубликовать
                </button>
            </form>
        </div>

        <h1 class="my-5">Ответы</h1>
        @foreach($question->getAnswers() as $answer)
            <div class="bg-white mt-4 shadow-xl rounded-lg overflow-hidden answer-item"
                 data-answer-id="{{ $answer->getKey() }}">
                <div class="sm:col-span-1 p-4">
                    <div class="flex justify-between items-start">
                        <dt class="text-sm font-medium text-gray-500 uppercase tracking-wide">
                            Ответ от {{ $answer->getUser()->getFirstName() }}
                        </dt>
                        @if(Auth::check() && Auth::user()->getKey() === $answer->getUser()->getKey())
                            <button class="edit-answer-btn text-gray-400 hover:text-blue-600 transition"
                                    title="Редактировать">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            </button>
                        @endif
                    </div>
                    <div class="answer-text mt-1 text-base text-gray-900">{{ $answer->getDescription() }}</div>

                    <div class="edit-answer-form hidden mt-4 pt-4 border-t border-gray-200">
                        <form action="{{ route('answer.update', $answer->getKey()) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('patch')
                            <input name="product_id" type="hidden" value="{{ $question->getProduct()->getKey() }}">
                            <input name="question_id" type="hidden" value="{{ $question->getKey() }}">
                            <textarea name="description" class="w-full rounded-xl border-gray-300 p-4 border"
                                      rows="3">{{ $answer->getDescription() }}</textarea>
                            <div class="flex space-x-3">
                                <button type="submit"
                                        class="bg-blue-600 text-white rounded-xl py-2 px-6 font-bold hover:bg-blue-700 transition text-sm">
                                    Сохранить
                                </button>
                                <button type="button"
                                        class="cancel-edit-answer-btn text-gray-500 hover:text-gray-700 font-medium text-sm">
                                    Отмена
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
