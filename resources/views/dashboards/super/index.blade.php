@extends('layouts.app')

@section('title', 'Dashboard: Super')

@section('content')
    <div class="bg-white p-6 rounded shadow space-y-4">
        <h1 class="text-2xl font-bold text-blue-700">Dashboard: Super</h1>

        <div class="text-gray-700">
            <p>
                👤 <strong>Welcome:</strong> {{ auth()->user()->name }} ({{ auth()->user()->email }})
            </p>
            <p>
                🛡️ <strong>Current Role:</strong> {{ auth()->user()->getRoleNames()->implode(', ') }}
            </p>
            <p>
                🏢 <strong>Current Franchise:</strong> {{ auth()->user()->franchisees->first()->name ?? 'None' }}
            </p>
        </div>

        <div class="pt-4">
            <a href="{{ route('profile.show') }}" class="text-blue-600 hover:underline">⚙️ Profile Settings</a>
        </div>

        <div class="pt-4 text-sm text-gray-600">
            <em>This is the super dashboard view.</em>
        </div>
    </div>
@endsection

