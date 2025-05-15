@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold capitalize">Dashboard: franchise</h1>
            <p class="text-sm text-gray-600">
                Welcome, { '{' } auth()->user()->name } ({ '{' } auth()->user()->email })
            </p>
            <p class="text-sm text-gray-600">
                Current Role: { '{' } auth()->user()->getRoleNames()->implode(', ') }<br>
                Current Franchise:
                @if(auth()->user()->franchisees->count() > 1)
                    <form method="POST" action="{ '{' } route('franchise.switch') }" class="inline">
                        @csrf
                        <select name="franchise_id" onchange="this.form.submit()" class="ml-2 p-1 rounded border border-gray-300">
                            @foreach(auth()->user()->franchisees as $franchise)
                                <option value="{ '{' } $franchise->id }"
                                    { '{' } session('active_franchise_id') == $franchise->id ? 'selected' : '' }>
                                    { '{' } $franchise->name }
                                </option>
                            @endforeach
                        </select>
                    </form>
                @else
                    { '{' } auth()->user()->franchisees->first()->name ?? 'None' }
                @endif
            </p>
        </div>
        <div>
            <a href="{ '{' } route('profile.show') }"
               class="text-sm text-blue-500 hover:text-blue-700 underline">
               Profile Settings
            </a>
        </div>
    </div>

    <div class="bg-white p-6 shadow rounded">
        <p>This is the franchise dashboard view.</p>
    </div>
</div>
@endsection
