<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title','Frios Management')</title>
  @vite('resources/css/app.css')
  @livewireStyles
</head>
<body class="min-h-screen flex bg-gray-100 text-gray-800">

  {{-- Sidebar (md+) --}}
  <aside class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64 bg-white border-r">
      <div class="h-16 flex items-center justify-center text-2xl font-bold" style="color:var(--brand-primary)">
        Frios
      </div>
      <nav class="flex-1 px-2 py-4 space-y-1">
        <a href="{{ route('dashboard') }}"
           class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('dashboard') ? 'bg-gray-200 font-semibold' : '' }}">
          Dashboard
        </a>
        <a href="{{ route('franchisees.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200">
          Franchisees
        </a>
        <a href="{{ route('flavors.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200">
          Flavors
        </a>
        <a href="{{ route('events.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200">
          Events
        </a>
        <a href="{{ route('social_posts.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200">
          Social Posts
        </a>
        {{-- more links here --}}
      </nav>
    </div>
  </aside>

  {{-- Main content --}}
  <div class="flex-1 flex flex-col">

    {{-- Mobile header + menu --}}
    <header class="md:hidden bg-white border-b">
      <div class="flex items-center justify-between h-16 px-4">
        <button id="mobile-menu-button" class="text-gray-500 focus:outline-none">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
        <div class="text-xl font-bold" style="color:var(--brand-primary)">Frios</div>
        <div></div>
      </div>
      <nav id="mobile-menu" class="hidden px-2 pb-4 space-y-1">
        <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-200">Dashboard</a>
        <a href="{{ route('franchisees.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200">Franchisees</a>
        <a href="{{ route('flavors.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200">Flavors</a>
        <a href="{{ route('events.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200">Events</a>
        <a href="{{ route('social_posts.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200">Social Posts</a>
      </nav>
    </header>

    {{-- Page content --}}
    <main class="flex-1 overflow-y-auto p-6">
      @yield('content')
    </main>
  </div>

  @livewireScripts
  <script>
    document.getElementById('mobile-menu-button').addEventListener('click', () => {
      document.getElementById('mobile-menu').classList.toggle('hidden');
    });
  </script>
</body>
</html>
