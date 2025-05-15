@extends('layouts.app')

@section('title','View Pos Sale')

@section('content')
<div class="card">
  <h1 class="mb-4">Pos Sale Details</h1>
  <!-- TODO: Display {singular} details -->
  <a href="{ route('pos-sales.index') }" class="btn btn-secondary mt-2">Back to List</a>
</div>
@endsection
