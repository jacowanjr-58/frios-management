@extends('layouts.app')

@section('title','Create Flavor Option')

@section('content')
<div class="card">
  <h1 class="mb-4">Create Flavor Option</h1>
  <form action="{ route('flavor-options.store') }" method="POST">
    @csrf
    <!-- TODO: Add form fields -->
    <button type="submit" class="btn btn-primary mt-2">Save</button>
  </form>
</div>
@endsection
