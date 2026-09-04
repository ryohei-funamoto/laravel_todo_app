@extends('layouts.app')

@section('content')
    <a href="{{ route('todos.create') }}">登録ページへ</a>
    <ul>
        @foreach($todos as $todo)
            <li>
                <span class="{{ $todo->completed ? 'line-through text-gray-400' : '' }}">{{ $todo->title }}</span>
                <a href="{{ route('todos.edit', $todo) }}">編集</a>
                <form action="{{ route('todos.toggle', $todo) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit">完了</button>
                </form>
                <form action="{{ route('todos.destroy', $todo) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">削除</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
