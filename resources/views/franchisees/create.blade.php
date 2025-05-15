@extends('layouts.app')

@section('title','Create Franchisee')

@section('content')
<div class="card">
  <h1 class="mb-4">Create Franchisee</h1>
  <form action="{ route('franchisees.store') }" method="POST">
    @csrf
    <!-- TODO: Add form fields -->
    <button type="submit" class="btn btn-primary mt-2">Save</button>
  </form>
</div>
@endsection
