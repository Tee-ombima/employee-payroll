<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    @if (!request()->is('login') && !request()->is('register') && !request()->is('password/*'))
        <nav class="bg-gray-800 text-white shadow-lg">
            <!-- Your existing nav content -->
        </nav>
    @endif

    <main>
        @yield('content')
    </main>
</body>
</html>