@extends('layouts.app')

@section('title','Edit Additional Charge')

@section('content')
<div class="card">
  <h1 class="mb-4">Edit Additional Charge</h1>
  <form action="{ route('additional-charges.update', ${singular}) }" method="POST">
    @csrf
    @method('PUT')
    <!-- TODO: Add form fields prefilled with ${singular} data -->
    <button type="submit" class="btn btn-primary mt-2">Update</button>
  </form>
</div>
@endsection
