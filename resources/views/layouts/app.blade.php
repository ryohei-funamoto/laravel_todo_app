<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Todoアプリ | @yield('title', '一覧ページ')</title>
</head>
<body class="bg-gray-50 min-h-screen font-sans text-gray-800">
    <main class="max-w-2xl mx-auto px-4 py-8">
        @if(session('status'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
