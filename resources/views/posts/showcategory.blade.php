@extends('layout')

@section('title', $category->name . ' Posts')

@section('content')
<div class="container my-5">
    <div class="row mb-4">
        <div class="col text-center">
            <h1 class="display-4">{{ $category->name }} Posts</h1>
        </div>
    </div>

    @if($posts->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            No posts found in this category.
        </div>
    @else
    <div class="row">
        @foreach($posts as $post)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">{{ $post->title }}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ Str::limit($post->content, 100) }}</p> <!-- Truncate content -->
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        Posted on {{ $post->created_at->format('M d, Y') }} <br>
                        by <strong>{{ $post->author->name ?? 'Unknown' }}</strong>
                    </small>
                    <a href="{{ url('/posts', $post->id) }}" class="btn btn-outline-primary btn-sm">Read More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
