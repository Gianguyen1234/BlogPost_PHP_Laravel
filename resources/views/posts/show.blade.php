@extends('layout')

@section('title', $post->title)

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h1 class="card-title">{{ $post->title }}</h1>
                    <p class="text-muted">{{ $post->slug }}</p> <!-- Slug under the title -->
                    <p class="text-muted">
                        <small>Published by {{ $post->author->name }} on {{ $post->created_at->format('F j, Y') }}</small>
                    </p>
                </div>
                <div class="card-body">
                    <div class="post-content mb-4">
                        {!! $post->content !!}
                    </div>
                    
                    @if($post->youtube_iframe)
                        <div class="youtube-embed mb-4">
                            {!! $post->youtube_iframe !!}
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    @if($post->category)
                        <p class="text-muted">
                            <strong>Category:</strong> 
                            <a href="{{ route('category.posts', $post->category->slug) }}">{{ $post->category->name }}</a>
                        </p>
                    @else
                        <p class="text-muted"><strong>Category:</strong> None</p>
                    @endif
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Categories</h5>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($categories as $category)
                        <li class="list-group-item">
                            <a href="{{ route('category.posts', $category->slug) }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Latest News</h5>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($latestPosts as $latestPost)
                        <li class="list-group-item">
                            <a href="{{ route('posts.show', $latestPost->slug) }}">{{ $latestPost->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
