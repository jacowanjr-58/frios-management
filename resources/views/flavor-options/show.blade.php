@extends('layouts.app')

@section('title','View Flavor Option')

@section('content')
<div class="card">
  <h1 class="mb-4">Flavor Option Details</h1>
  <!-- TODO: Display {singular} details -->
  <a href="{ route('flavor-options.index') }" class="btn btn-secondary mt-2">Back to List</a>
</div>
@endsection
