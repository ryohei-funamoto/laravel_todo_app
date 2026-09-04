@extends('layouts.app')

@section('title', '編集ページ')

@section('content')
    <form action="{{ route('todos.update', $todo) }}" method="POST">
        @csrf
        @method('PUT')
        @include('todos._form')
        <button type="submit">更新</button>
    </form>
@endsection
