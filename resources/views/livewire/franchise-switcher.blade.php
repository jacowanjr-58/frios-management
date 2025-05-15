<div class="text-sm text-gray-700">
    <label for="franchiseSelect" class="mr-2">Franchise:</label>
    <select id="franchiseSelect" wire:model="selectedFranchise"
            class="border border-gray-300 rounded p-1 bg-white shadow-sm">
        @foreach($franchisees as $franchise)
            <option value="{{ $franchise->id }}">{{ $franchise->name }}</option>
        @endforeach
    </select>
</div>
