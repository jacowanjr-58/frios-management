<div>
    <h2 class="text-xl font-bold mb-4">Permission Matrix: {{ ucfirst($role->name) }}</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($permissions as $permission)
            <label class="flex items-center space-x-2">
                <input type="checkbox" wire:model.defer="selectedPermissions" value="{{ $permission }}">
                <span>{{ $permission }}</span>
            </label>
        @endforeach
    </div>

    <button wire:click="updatedSelectedPermissions" class="mt-6 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Save Permissions
    </button>
</div>
