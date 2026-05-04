@extends('layouts.admin')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">Список отзывов</h2>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                <th class="px-5 py-3">ID отзыва</th>
                <th class="px-5 py-3">Рейтинг</th>
                <th class="px-5 py-3">Отзыв</th>
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

                    <td class="px-5 py-5">
                        <p class="font-medium">{{ $review->getReview() }}</p>
                    </td>

                    <td class="px-5 py-5 text-right text-sm">
                        <form method="POST" action="{{ route('admin.reviews.destroy', $review->getKey()) }}">
                            @csrf
                            @method('delete')
                            <button class="text-red-600 hover:text-red-900" onclick="return confirm('Вы уверены что хотите удалить данные?')">Удалить</button>
                        </form>
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
