@extends('layout')

@section('title', 'Search Results')

@section('content')
<div class="container mt-5">
    <h1>Search Results for "{{ $query }}"</h1>
    
    @if($posts->isEmpty())
        <p>No results found.</p>
    @else
        <div class="list-group">
            @foreach($posts as $post)
                <a href="{{ route('posts.show', $post->slug) }}" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">{{ $post->title }}</h5>
                    <p class="mb-1">{{ Str::limit($post->content, 100) }}</p>
                    <small>Published on {{ $post->created_at->format('F j, Y') }}</small>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
