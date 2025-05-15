@extends('layouts.app')

@section('title','View User')

@section('content')
<div class="card">
  <h1 class="mb-4">User Details</h1>
  <!-- TODO: Display {singular} details -->
  <a href="{ route('users.index') }" class="btn btn-secondary mt-2">Back to List</a>
</div>
@endsection
