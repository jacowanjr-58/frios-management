@extends('layouts.app')

@section('title','View Case Batche')

@section('content')
<div class="card">
  <h1 class="mb-4">Case Batche Details</h1>
  <!-- TODO: Display {singular} details -->
  <a href="{ route('case-batches.index') }" class="btn btn-secondary mt-2">Back to List</a>
</div>
@endsection
