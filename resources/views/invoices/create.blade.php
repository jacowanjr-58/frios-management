@extends('layouts.app')

@section('title','Create Invoice')

@section('content')
<div class="card">
  <h1 class="mb-4">Create Invoice</h1>
  <form action="{ route('invoices.store') }" method="POST">
    @csrf
    <!-- TODO: Add form fields -->
    <button type="submit" class="btn btn-primary mt-2">Save</button>
  </form>
</div>
@endsection
