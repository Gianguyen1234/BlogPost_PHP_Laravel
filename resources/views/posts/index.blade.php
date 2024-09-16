@extends('layout')

@section('title', 'All Blog Posts')

@section('content')
    <h1>All Blog Posts</h1>
    
    @foreach ($posts as $post)
        <h2>{{ $post->title }}</h2>
        <p>{!! Str::limit($post->content, 150, '...') !!}</p>
        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">View</a>
        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
        
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
       
    @endforeach
@endsection
