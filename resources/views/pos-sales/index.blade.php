@extends('layouts.app')

@section('title','Pos Sale List')

@section('content')
<div class="card">
  <h1 class="mb-4">Pos Sale List</h1>
  <a href="{ route('pos-sales.create') }" class="btn btn-primary mb-2">New Pos Sale</a>
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
          <a href="{ route('pos-sales.edit', ${singular}) }" class="text-blue-600">Edit</a>
          <form action="{ route('pos-sales.destroy', ${singular}) }" method="POST" class="inline">
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
