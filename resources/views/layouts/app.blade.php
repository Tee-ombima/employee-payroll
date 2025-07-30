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
    <!-- Add this to your navigation menu -->
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="flex items-center space-x-2 text-red-500 hover:text-red-700">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
        </svg>
        <span>Logout</span>
    </button>
</form>

    <main>
        @yield('content')
    </main>
</body>
</html>