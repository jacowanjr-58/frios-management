@extends('layouts.app')

@section('title','View Event')

@section('content')
<div class="card">
  <h1 class="mb-4">Event Details</h1>
  <!-- TODO: Display {singular} details -->
  <a href="{ route('events.index') }" class="btn btn-secondary mt-2">Back to List</a>
</div>
@endsection
