<div>
    <h2 class="text-xl font-bold mb-4">Schedule an Instagram Post</h2>

    @if(session()->has('message'))
        <div class="bg-green-100 text-green-800 p-2 mb-4">{{ session('message') }}</div>
    @endif

    <div class="grid grid-cols-4 gap-4">
        @foreach($files as $file)
            <div class="border p-2 cursor-pointer hover:bg-gray-100 {{ $selectedUrl === $file->webContentLink ? 'bg-gray-200' : '' }}">
                <img src="{{ $file->thumbnailLink }}" alt="{{ $file->name }}" class="w-full h-24 object-cover mb-2">
                <div class="text-sm truncate">{{ $file->name }}</div>
                <button wire:click="select('{{ $file->webContentLink }}')" class="mt-2 text-blue-600">Select</button>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        <label>Caption</label>
        <textarea wire:model="caption" class="w-full border p-2"></textarea>
    </div>

    <div class="mt-2">
        <label>Schedule At</label>
        <input type="datetime-local" wire:model="scheduledAt" class="border p-1">
    </div>

    <button wire:click="schedule" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Schedule Post</button>
</div>
