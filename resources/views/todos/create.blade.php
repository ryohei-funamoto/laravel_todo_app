@extends('layouts.app')

@section('title', '新規作成ページ')

@section('content')
    <form action="{{ route('todos.store') }}" method="POST">
        @csrf
        @include('todos._form')
        <button type="submit">登録</button>
    </form>
@endsection
