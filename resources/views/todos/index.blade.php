@extends('layouts.app')

@section('content')
    <a href="{{ route('todos.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded mb-6 hover:bg-blue-700">登録ページへ</a>
    <ul class="space-y-2">
        @foreach($todos as $todo)
            <li class="flex items-center justify-between bg-white px-4 py-3 rounded shadow-sm">
                <span class="flex-1 {{ $todo->completed ? 'line-through text-gray-400' : '' }}">{{ $todo->title }}</span>
                <div class="flex items-center gap-2">
                    <a href="{{ route('todos.edit', $todo) }}" class="text-blue-600">編集</a>
                    <form action="{{ route('todos.toggle', $todo) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="{{ $todo->completed ? 'text-gray-600 bg-gray-100 hover:bg-gray-200' : 'text-green-600 bg-green-100 hover:bg-green-200' }} px-3 py-1 rounded">
                            {{ $todo->completed ? '未完了に戻す' : '完了' }}
                        </button>
                    </form>
                    <form action="{{ route('todos.destroy', $todo) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 bg-red-100 hover:bg-red-200 px-3 py-1 rounded">削除</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
