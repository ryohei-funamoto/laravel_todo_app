@extends('layouts.app')

@section('title', '編集ページ')

@section('content')
    <div class="bg-white p-6 rounded shadow-sm">
        <form action="{{ route('todos.update', $todo) }}" method="POST">
            @csrf
            @method('PUT')
            @include('todos._form')
            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded">更新</button>
        </form>
    </div>
@endsection
