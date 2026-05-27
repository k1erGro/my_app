@extends('layouts.admin')
@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Добавить новый товар</h2>
            <a href="{{ route('admin.product.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center">
                Назад к списку
            </a>
        </div>

        <livewire:admin.product-form />
    </div>
@endsection
