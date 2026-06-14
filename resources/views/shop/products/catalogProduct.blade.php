@extends('layouts.main')
@section('content')
    <div>
        <livewire:catalog-component :subCategory="$subCategory" />
    </div>
@endsection
