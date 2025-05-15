@extends('layouts.app')

@section('title','View Flavor Categorie')

@section('content')
<div class="card">
  <h1 class="mb-4">Flavor Categorie Details</h1>
  <!-- TODO: Display {singular} details -->
  <a href="{ route('flavor-categories.index') }" class="btn btn-secondary mt-2">Back to List</a>
</div>
@endsection
