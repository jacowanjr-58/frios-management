@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Permissions for {{ ucfirst($role) }}</h1>
    @livewire('permission-matrix.editor', ['roleName' => $role])
@endsection
