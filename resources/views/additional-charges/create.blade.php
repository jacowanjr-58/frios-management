@extends('layouts.app')

@section('title','Create Additional Charge')

@section('content')
<div class="card">
  <h1 class="mb-4">Create Additional Charge</h1>
  <form action="{ route('additional-charges.store') }" method="POST">
    @csrf
    <!-- TODO: Add form fields -->
    <button type="submit" class="btn btn-primary mt-2">Save</button>
  </form>
</div>
@endsection
