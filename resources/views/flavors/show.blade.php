@extends('layouts.app')

@section('title','View Flavor')

@section('content')
<div class="card">
  <h1 class="mb-4">Flavor Details</h1>
  <!-- TODO: Display {singular} details -->
  <a href="{ route('flavors.index') }" class="btn btn-secondary mt-2">Back to List</a>
</div>
@endsection
