@extends('layouts.app')

@section('title','View Restock Order')

@section('content')
<div class="card">
  <h1 class="mb-4">Restock Order Details</h1>
  <!-- TODO: Display {singular} details -->
  <a href="{ route('restock-orders.index') }" class="btn btn-secondary mt-2">Back to List</a>
</div>
@endsection
