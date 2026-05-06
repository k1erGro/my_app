@extends('layouts.admin')
@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">ID вопроса пользователя: {{ $question->getKey() }}</h2>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.question.list') }}"
                   class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition">
                    К списку
                </a>
            </div>
        </div>
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
            <div class="md:flex">
                <p class="text-gray-600 leading-relaxed italic">
                    {{ $question->getTitle() }}
                </p>
                <div class="md:w-2/3 p-8">
                    <div class="border-t border-gray-100 pt-6">
                        <p class="text-gray-600 leading-relaxed italic">
                            {{ $question->getDescription() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
