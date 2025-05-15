@extends('layouts.app')

@section('title','Schedule Post')

@section('content')
  <div class="card">
    <h1 class="mb-4">Schedule Instagram Post</h1>

    {{-- This renders your Livewire component --}}
    <livewire:social-post-scheduler />
  </div>
@endsection
