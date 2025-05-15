@extends('layouts.app')

@section('title','View Location')

@section('content')
<div class="card">
  <h1 class="mb-4">Location Details</h1>
  <!-- TODO: Display {singular} details -->
  <a href="{ route('locations.index') }" class="btn btn-secondary mt-2">Back to List</a>
</div>
@endsection
