@extends('layouts.app')

@section('title', '新規作成ページ')

@section('content')
    <div class="bg-white p-6 rounded shadow-sm">
        <form action="{{ route('todos.store') }}" method="POST">
            @csrf
            @include('todos._form')
            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded">登録</button>
        </form>
    </div>
@endsection
