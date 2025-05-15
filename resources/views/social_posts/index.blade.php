@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Social Posts</h1>
    <a href="{{ route('social_posts.create') }}" class="btn btn-primary mb-3">New Post</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Platform</th>
                <th>Caption</th>
                <th>Media</th>
                <th>Scheduled At</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->platform }}</td>
                <td>{{ $post->caption }}</td>
                <td><a href="{{ $post->media_url }}" target="_blank">View</a></td>
                <td>{{ $post->scheduled_at }}</td>
                <td>{{ $post->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
