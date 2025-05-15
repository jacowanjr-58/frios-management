@extends('layouts.app')

@section('title','View Restock Item')

@section('content')
<div class="card">
  <h1 class="mb-4">Restock Item Details</h1>
  <!-- TODO: Display {singular} details -->
  <a href="{ route('restock-items.index') }" class="btn btn-secondary mt-2">Back to List</a>
</div>
@endsection
