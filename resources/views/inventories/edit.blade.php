@extends('layouts.app')

@section('title','Edit Inventorie')

@section('content')
<div class="card">
  <h1 class="mb-4">Edit Inventorie</h1>
  <form action="{ route('inventories.update', ${singular}) }" method="POST">
    @csrf
    @method('PUT')
    <!-- TODO: Add form fields prefilled with ${singular} data -->
    <button type="submit" class="btn btn-primary mt-2">Update</button>
  </form>
</div>
@endsection
