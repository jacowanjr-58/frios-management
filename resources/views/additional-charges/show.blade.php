@extends('layouts.app')

@section('title','View Additional Charge')

@section('content')
<div class="card">
  <h1 class="mb-4">Additional Charge Details</h1>
  <!-- TODO: Display {singular} details -->
  <a href="{ route('additional-charges.index') }" class="btn btn-secondary mt-2">Back to List</a>
</div>
@endsection
