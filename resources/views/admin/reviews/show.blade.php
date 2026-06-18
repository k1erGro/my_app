@extends('layouts.admin')
@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Просмотр отзыва</h2>
                <p class="text-gray-500">ID: #{{ $review->getKey() }}</p>
            </div>
            <a href="{{ route('admin.reviews.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition">
                ← К списку
            </a>
        </div>

        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="p-6 space-y-6">
                <!-- Информация об авторе и продукте -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 uppercase tracking-wide">Автор</dt>
                        <dd class="mt-1 text-lg text-gray-900 font-semibold">
                            {{ $review->getUser()->getFullName() }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 uppercase tracking-wide">Продукт</dt>
                        <dd class="mt-1 text-lg text-gray-900 font-semibold">
                            {{ $review->getProduct()->getName() }}
                        </dd>
                    </div>
                </div>

                <!-- Рейтинг и статус -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 uppercase tracking-wide">Рейтинг</dt>
                        <dd class="mt-1 text-2xl text-yellow-500 font-bold">
                            {{ $review->getRating() }} / 5
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 uppercase tracking-wide">Статус</dt>
                        <dd class="mt-1">
                            @if($review->is_approved)
                                <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                    Одобрен
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    На модерации
                                </span>
                            @endif
                        </dd>
                    </div>
                </div>

                <!-- Текст отзыва -->
                <div>
                    <dt class="text-sm font-medium text-gray-500 uppercase tracking-wide">Текст отзыва</dt>
                    <dd class="mt-2 p-4 bg-gray-50 rounded-lg border border-gray-200 text-gray-800 leading-relaxed">
                        {{ $review->getReview() }}
                    </dd>
                </div>

                <!-- Даты -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-500 border-t border-gray-100 pt-4">
                    <div>
                        <span class="font-medium">Создан:</span> {{ $review->created_at->format('d.m.Y H:i') }}
                    </div>
                    <div>
                        <span class="font-medium">Обновлён:</span> {{ $review->updated_at->format('d.m.Y H:i') }}
                    </div>
                </div>
            </div>

            <!-- Блок действий -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex flex-wrap justify-end gap-2">
                @can('delete-reviews')
                    @if(!$review->is_approved)
                        <form method="POST" action="{{ route('admin.reviews.approve', $review) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="action" value="approve">
                            <button class="px-5 py-2 bg-green-600 text-white font-semibold rounded-md shadow hover:bg-green-700 transition min-w-[120px]">
                                Одобрить
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('admin.reviews.approve', $review) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="action" value="reject">
                            <button class="px-5 py-2 bg-red-600 text-white font-semibold rounded-md shadow hover:bg-red-700 transition min-w-[120px]">
                                Отклонить
                            </button>
                        </form>
                    @endif
                @endcan

                @can('delete-reviews')
                    <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}">
                        @csrf
                        @method('delete')
                        <button class="px-5 py-2 bg-gray-600 text-white font-semibold rounded-md shadow hover:bg-gray-700 transition min-w-[120px]"
                                onclick="return confirm('Удалить отзыв?')">
                            Удалить
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
@endsection
