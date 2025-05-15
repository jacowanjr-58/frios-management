@extends('layouts.app')

@section('title','View Invoice Item')

@section('content')
<div class="card">
  <h1 class="mb-4">Invoice Item Details</h1>
  <!-- TODO: Display {singular} details -->
  <a href="{ route('invoice-items.index') }" class="btn btn-secondary mt-2">Back to List</a>
</div>
@endsection
