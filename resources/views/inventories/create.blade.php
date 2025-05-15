@extends('layouts.app')

@section('title','Create Inventorie')

@section('content')
<div class="card">
  <h1 class="mb-4">Create Inventorie</h1>
  <form action="{ route('inventories.store') }" method="POST">
    @csrf
    <!-- TODO: Add form fields -->
    <button type="submit" class="btn btn-primary mt-2">Save</button>
  </form>
</div>
@endsection
