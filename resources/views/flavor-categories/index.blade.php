@extends('layouts.app')

@section('title','Flavor Categorie List')

@section('content')
<div class="card">
  <h1 class="mb-4">Flavor Categorie List</h1>
  <a href="{ route('flavor-categories.create') }" class="btn btn-primary mb-2">New Flavor Categorie</a>
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
          <a href="{ route('flavor-categories.edit', ${singular}) }" class="text-blue-600">Edit</a>
          <form action="{ route('flavor-categories.destroy', ${singular}) }" method="POST" class="inline">
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
