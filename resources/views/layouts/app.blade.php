<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Todoアプリ | @yield('title', '一覧ページ')</title>
</head>
<body>
    @if(session('status'))
        {{ session('status') }}
    @endif
    @yield('content')
</body>
</html>
