@extends('layouts.app')

@section('title','View Pos Item')

@section('content')
<div class="card">
  <h1 class="mb-4">Pos Item Details</h1>
  <!-- TODO: Display {singular} details -->
  <a href="{ route('pos-items.index') }" class="btn btn-secondary mt-2">Back to List</a>
</div>
@endsection
