@extends('layouts.app')

@section('title','Edit Pos Sale')

@section('content')
<div class="card">
  <h1 class="mb-4">Edit Pos Sale</h1>
  <form action="{ route('pos-sales.update', ${singular}) }" method="POST">
    @csrf
    @method('PUT')
    <!-- TODO: Add form fields prefilled with ${singular} data -->
    <button type="submit" class="btn btn-primary mt-2">Update</button>
  </form>
</div>
@endsection
