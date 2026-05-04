@extends('layouts.admin')
@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Отзыв</h2>
                <p class="text-gray-500">ID отзыва: #{{ $review->getKey() }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.reviews.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition">
                    К списку
                </a>
            </div>
        </div>

        <div class="bg-white shadow-xl rounded-lg overflow-hidden">

            <div class="p-6">
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-8">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 uppercase tracking-wide"></dt>
                        <dd class="mt-1 text-lg text-gray-900 font-semibold">{{ $review->getRating() }}</dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 uppercase tracking-wide">Последнее обновление</dt>
                        <dd class="mt-1 text-base text-gray-900">{{ $review->getReview() }}</dd>
                    </div>
                </dl>
            </div>

            <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex justify-end">
                <form method="POST" action="{{ route('admin.reviews.destroy', $review->getKey()) }}">
                    @csrf
                    @method('delete')
                    <button class="text-red-600 hover:text-red-900">Удалить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
