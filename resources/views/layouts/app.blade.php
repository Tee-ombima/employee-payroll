<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body class="font-sans antialiased">
@include('components.alert')



    @if (!request()->is('login') && !request()->is('register') && !request()->is('password/*'))
        <nav class="bg-gray-800 text-white shadow-lg">
            <!-- Your existing nav content -->
        </nav>
    @endif
    {{-- @if (session('status'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif
 --}}
@if ($errors->any())
    <div id="validation-errors" class="bg-red-100 text-red-800 px-4 py-3 rounded mb-4 mx-4 mt-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <main>
        @yield('content')
    </main>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const alertIds = ['success-alert', 'error-alert', 'validation-errors'];

        alertIds.forEach(id => {
            const alert = document.getElementById(id);
            if (alert) {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 3000); // disappear after 3 seconds
            }
        });
    });
</script>


</body>

</html>