@extends('layouts.app')

@section('title','Invoice Item List')

@section('content')
<div class="card">
  <h1 class="mb-4">Invoice Item List</h1>
  <a href="{ route('invoice-items.create') }" class="btn btn-primary mb-2">New Invoice Item</a>
  <table class="w-full table-auto">
    <thead>
      <tr>
        <!-- TODO: Add table headers -->
      </tr>
    </thead>
    <tbody>
      @foreach(${plural} as ${singular})
      <tr>
        <!-- TODO: Display fields -->
        <td>
          <a href="{ route('invoice-items.edit', ${singular}) }" class="text-blue-600">Edit</a>
          <form action="{ route('invoice-items.destroy', ${singular}) }" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button class="text-red-600 ml-2">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
