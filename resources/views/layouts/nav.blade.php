<nav class="bg-white border-b px-4 py-3 shadow flex justify-between items-center">
    <div>
        <span class="font-bold text-xl text-blue-700">Frios Dashboard</span>
    </div>

    <div class="flex flex-col md:flex-row md:items-center md:space-x-4 text-sm text-gray-700">
        <div>
            👤 {{ auth()->user()->name }}<br>
            📧 {{ auth()->user()->email }}<br>
            🛡️ Role: {{ auth()->user()->getRoleNames()->implode(', ') }}
        </div>

        <div class="mt-2 md:mt-0">
            @if(auth()->user()->franchisees->count() > 1)
                @livewire('franchise-switcher')
            @else
                <span class="text-gray-500">Franchise: {{ auth()->user()->franchisees->first()->name ?? 'N/A' }}</span>
            @endif
        </div>

        <div>
            <a href="{{ route('profile.show') }}" class="text-blue-600 hover:underline">Profile</a>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-red-600 hover:underline">Logout</button>
        </form>
    </div>
</nav>
