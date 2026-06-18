@extends('layouts.admin')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">Список отзывов</h2>
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
    <div class="mb-4 flex flex-wrap items-center gap-2">
        <div>
            <form method="GET" action="{{ route('admin.reviews.index') }}"
                  class="flex items-center gap-2 flex-1 max-w-md">
                <input type="text" name="search" placeholder="Поиск..."
                       value="{{ request('search') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition">
                    Найти
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.reviews.index', ['filter' => request('filter')]) }}"
                       class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-md hover:bg-gray-300 transition">
                        Сбросить
                    </a>
                @endif
            </form>
        </div>

        <a href="{{ route('admin.reviews.index') }}"
           class="px-4 py-2 text-sm font-medium rounded-md shadow-sm transition
              {{ !request('filter') ? 'bg-blue-600 text-white hover:bg-blue-700' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
            Все
        </a>
        <a href="{{ route('admin.reviews.index', ['filter' => 'pending']) }}"
           class="px-4 py-2 text-sm font-medium rounded-md shadow-sm transition
              {{ request('filter') == 'pending' ? 'bg-yellow-500 text-white hover:bg-yellow-600' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
            На модерации
        </a>
        <a href="{{ route('admin.reviews.index', ['filter' => 'approved']) }}"
           class="px-4 py-2 text-sm font-medium rounded-md shadow-sm transition
              {{ request('filter') == 'approved' ? 'bg-green-600 text-white hover:bg-green-700' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
            Одобренные
        </a>
    </div>
    <div class="bg-white shadow-md rounded-lg overflow-hidden">

        <table class="min-w-full leading-normal">
            <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                <th class="px-5 py-3">ID отзыва</th>
                <th class="px-5 py-3">Рейтинг</th>
                <th class="px-5 py-3">Отзыв</th>
                <th class="px-5 py-3">Пользователь</th>
                <th class="px-5 py-3">Продукт</th>
                <th class="px-5 py-3 text-right">Действия</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @foreach($reviews as $review)

                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $review->getKey() }}</p>
                    </td>

                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $review->getRating() }}</p>
                    </td>

                    <td class="px-5 py-5 max-w-xs">
                        <a href="{{ route('admin.reviews.show', $review->getKey()) }}" class="block truncate">
                            <p class="font-medium">{{ $review->getReview() }}</p>
                        </a>
                    </td>

                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $review->getUser()->getFullName() }}</p>
                    </td>

                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $review->getProduct()->getName() }}</p>
                    </td>

                    <td class="px-5 py-5">
                        <div class="flex items-center justify-end gap-1">
                            @can('delete-reviews')
                                @if(!$review->is_approved)
                                    <form method="POST" action="{{ route('admin.reviews.approve', $review) }}"
                                          class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="approve">
                                        <button
                                            class="px-3 py-1 bg-green-600 text-white text-xs font-medium rounded-md shadow-sm hover:bg-green-700 transition min-w-[70px] inline-flex justify-center">
                                            Одобрить
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('admin.reviews.approve', $review) }}"
                                          class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="reject">
                                        <button
                                            class="px-3 py-1 bg-red-600 text-white text-xs font-medium rounded-md shadow-sm hover:bg-red-700 transition min-w-[70px] inline-flex justify-center">
                                            Отклонить
                                        </button>
                                    </form>
                                @endif
                            @endcan

                            @can('delete-reviews')
                                <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}"
                                      class="inline-block">
                                    @csrf
                                    @method('delete')
                                    <button
                                        class="px-3 py-1 bg-gray-600 text-white text-xs font-medium rounded-md shadow-sm hover:bg-gray-700 transition min-w-[70px] inline-flex justify-center"
                                        onclick="return confirm('Удалить отзыв?')">
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
        {{ $reviews->links() }}
    </div>
@endsection
