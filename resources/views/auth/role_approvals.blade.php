<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold">Pending Role Requests</h2>
  </x-slot>

  <div class="p-6 bg-white shadow-sm rounded-lg space-y-4">
    @forelse ($pendingRequests as $req)
      <div class="border p-4 rounded-lg flex justify-between items-center">
        <div>
          <p>
            <strong>{{ $req->user->name }}</strong>
            requested <em>{{ $req->desired_role }}</em>
            @if($req->franchisee_id)
              for franchise #{{ $req->franchisee_id }}
            @endif
          </p>
        </div>
        <div class="space-x-2">
          <form method="POST" action="{{ route('approvals.approve', $req) }}" class="inline">
            @csrf
            <button class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
              Approve
            </button>
          </form>
          <form method="POST" action="{{ route('approvals.reject', $req) }}" class="inline">
            @csrf
            <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
              Reject
            </button>
          </form>
        </div>
      </div>
    @empty
      <p class="text-gray-500">No pending requests.</p>
    @endforelse
  </div>
</x-app-layout>
