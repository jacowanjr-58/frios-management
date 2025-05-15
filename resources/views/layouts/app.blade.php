<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Frios Dashboard')</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.nav')

        <main class="p-6">
            @yield('content')
        </main>
    </div>

    @livewireScripts
    @stack('scripts')
    @include('components.franchise-switcher-script')
</body>
</html>
