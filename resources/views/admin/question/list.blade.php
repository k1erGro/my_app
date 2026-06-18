@extends('layouts.admin')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">Список вопросов к товарам</h2>
    </div>
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg shadow-sm">
            <div class="flex items-center mb-2">
                <span class="font-bold">Внимание!</span>
            </div>
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-4 flex flex-wrap items-center gap-3">
        <form method="GET" action="{{ route('admin.questions.list') }}" class="flex items-center gap-2 flex-1 max-w-md">
            <input type="text" name="search" placeholder="Поиск..."
                   value="{{ request('search') }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition">
                Найти
            </button>
            @if(request('search'))
                <a href="{{ route('admin.questions.list', ['filter' => request('filter'), 'sort' => request('sort'), 'direction' => request('direction')]) }}"
                   class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-md hover:bg-gray-300 transition">
                    Сбросить
                </a>
            @endif
        </form>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.questions.list', ['search' => request('search'), 'sort' => request('sort'), 'direction' => request('direction')]) }}"
               class="px-4 py-2 text-sm font-medium rounded-md shadow-sm transition
              {{ !request('filter') ? 'bg-blue-600 text-white hover:bg-blue-700' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                Все
            </a>
            <a href="{{ route('admin.questions.list', ['filter' => 'pending', 'search' => request('search'), 'sort' => request('sort'), 'direction' => request('direction')]) }}"
               class="px-4 py-2 text-sm font-medium rounded-md shadow-sm transition
              {{ request('filter') == 'pending' ? 'bg-yellow-500 text-white hover:bg-yellow-600' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                На модерации
            </a>
            <a href="{{ route('admin.questions.list', ['filter' => 'approved', 'search' => request('search'), 'sort' => request('sort'), 'direction' => request('direction')]) }}"
               class="px-4 py-2 text-sm font-medium rounded-md shadow-sm transition
              {{ request('filter') == 'approved' ? 'bg-green-600 text-white hover:bg-green-700' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                Одобренные
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                <th class="px-5 py-3">
                    <a href="{{ route('admin.questions.list', array_merge(request()->only(['search', 'filter']), ['sort' => 'id', 'direction' => request('sort') == 'id' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                       class="flex items-center gap-1 hover:text-blue-700">
                        ID вопроса
                        @if(request('sort') == 'id')
                            <span>{{ request('direction') == 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </a>
                </th>
                <th class="px-5 py-3">
                    <a href="{{ route('admin.questions.list', array_merge(request()->only(['search', 'filter']), ['sort' => 'title', 'direction' => request('sort') == 'title' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                       class="flex items-center gap-1 hover:text-blue-700">
                        Вопрос
                        @if(request('sort') == 'title')
                            <span>{{ request('direction') == 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </a>
                </th>
                <th class="px-5 py-3">Пользователь</th>
                <th class="px-5 py-3">Продукт</th>
                <th class="px-5 py-3">Статус</th>
                <th class="px-5 py-3 text-right">Действия</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @foreach($questions as $question)

                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $question->getKey() }}</p>
                    </td>

                    <td class="px-5 py-5">
                        <a href="{{ route('admin.question.show', $question->getKey()) }}">
                            <p class="font-medium">{{ $question->getTitle() }}</p>
                        </a>
                    </td>


                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $question->getUser()->getFullName() }}</p>
                    </td>

                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $question->getProduct()->getName() }}</p>
                    </td>

                    <td class="px-5 py-5">
                        @if($question->is_approved)
                            <span
                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Одобрен
                            </span>
                        @else
                            <span
                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                На модерации
                            </span>
                        @endif
                    </td>

                    <td class="px-5 py-5 text-right text-sm">
                        <div class="flex items-center justify-end gap-1">
                            @can('delete-questions')
                                @if(!$question->is_approved)
                                    <form method="POST" action="{{ route('admin.question.moderate', $question) }}" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="approve">
                                        <button class="px-3 py-1 bg-green-600 text-white text-xs font-medium rounded-md shadow-sm hover:bg-green-700 transition min-w-[70px] inline-flex justify-center">
                                            Одобрить
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('admin.question.moderate', $question) }}" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="reject">
                                        <button class="px-3 py-1 bg-red-600 text-white text-xs font-medium rounded-md shadow-sm hover:bg-red-700 transition min-w-[70px] inline-flex justify-center">
                                            Отклонить
                                        </button>
                                    </form>
                                @endif
                            @endcan

                            @can('delete-questions')
                                <form method="POST" action="{{ route('admin.question.destroy', $question->getKey()) }}" class="inline-block">
                                    @csrf
                                    @method('delete')
                                    <button class="px-3 py-1 bg-gray-600 text-white text-xs font-medium rounded-md shadow-sm hover:bg-gray-700 transition min-w-[70px] inline-flex justify-center"
                                            onclick="return confirm('Удалить вопрос?')">
                                        Удалить
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </td>

                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $questions->links() }}
    </div>
@endsection
