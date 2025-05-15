@extends('layouts.app')

@section('title','Create Flavor')

@section('content')
<div class="card">
  <h1 class="mb-4">Create Flavor</h1>
  <form action="{ route('flavors.store') }" method="POST">
    @csrf
    <!-- TODO: Add form fields -->
    <button type="submit" class="btn btn-primary mt-2">Save</button>
  </form>
</div>
@endsection
