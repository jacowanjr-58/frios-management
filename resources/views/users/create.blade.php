@extends('layouts.app')

@section('title','Create User')

@section('content')
<div class="card">
  <h1 class="mb-4">Create User</h1>
  <form action="{ route('users.store') }" method="POST">
    @csrf
    <!-- TODO: Add form fields -->
    <button type="submit" class="btn btn-primary mt-2">Save</button>
  </form>
</div>
@endsection
