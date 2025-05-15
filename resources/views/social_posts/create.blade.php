@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Social Post</h1>
    <form action="{{ route('social_posts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="media_url">Media URL</label>
            <input type="url" name="media_url" id="media_url" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="caption">Caption</label>
            <textarea name="caption" id="caption" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="scheduled_at">Schedule At</label>
            <input type="datetime-local" name="scheduled_at" id="scheduled_at" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary mt-2">Schedule</button>
    </form>
</div>
@endsection
