@extends('layouts.main')
@section('content')
    <form action="{{ route('order-report.store') }}">
        <input type="hidden" name="order_id" value="">
        <input type="text" name="title">
        <textarea name="description"></textarea>
        <input type="submit">
    </form>
@endsection
