@extends('layouts.app')

@section('title','View Franchisee')

@section('content')
<div class="card">
  <h1 class="mb-4">Franchisee Details</h1>
  <!-- TODO: Display {singular} details -->
  <a href="{ route('franchisees.index') }" class="btn btn-secondary mt-2">Back to List</a>
</div>
@endsection
