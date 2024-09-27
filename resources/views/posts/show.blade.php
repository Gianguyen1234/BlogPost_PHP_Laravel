@extends('layout')

@section('title', $post->title)

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-lg mb-4 border-0 rounded-3 custom-card">
                <div class="card-body">
                    <h1 class="card-title text-primary fw-bold">{{ $post->title }}</h1>
                    <p class="text-muted">{{ $post->slug }}</p>
                    <p class="text-muted mb-4">
                        <small>Published by <strong>{{ $post->author->name }}</strong> on {{ $post->created_at->format('F j, Y') }}</small>
                    </p>
                    <div class="post-content mb-4">
                        {!! $post->content !!}
                    </div>
                    
                    @if($post->youtube_iframe)
                        <div class="youtube-embed mb-4">
                            {!! $post->youtube_iframe !!}
                        </div>
                    @endif
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center border-top-0">
                    @if($post->category)
                        <p class="text-muted mb-0">
                            <strong>Category:</strong> 
                            <a href="{{ route('category.posts', $post->category->slug) }}" class="text-decoration-none">{{ $post->category->name }}</a>
                        </p>
                    @else
                        <p class="text-muted mb-0"><strong>Category:</strong> None</p>
                    @endif
                    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">Back to Posts</a>
                </div>
            </div>

            <!-- Share Section -->
            <div class="card shadow-lg mb-4 border-0 rounded-3 custom-card">
                <div class="card-body">
                    <h5 class="card-title">Share this Post</h5>
                    <div>
                        <a href="#" class="btn btn-outline-primary me-2">Facebook</a>
                        <a href="#" class="btn btn-outline-info me-2">Twitter</a>
                        <a href="#" class="btn btn-outline-danger">Google+</a>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="card shadow-lg mb-4 border-0 rounded-3 custom-card">
                <div class="card-body">
                    <h5 class="card-title">Comments</h5>
                    <!-- Placeholder for existing comments -->
                    <div class="comment mb-3">
                        <strong>John Doe</strong>
                        <p>This is a sample comment.</p>
                        <small class="text-muted">January 1, 2024</small>
                    </div>

                    <!-- Comment Form -->
                    <h6 class="mt-4">Leave a Comment:</h6>
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="author_name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="author_name" placeholder="Your name" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Comment</label>
                            <textarea class="form-control" name="content" rows="3" placeholder="Your comment..." required></textarea>
                        </div>
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <button type="submit" class="btn btn-success">Post Comment</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-lg mb-4 border-0 rounded-3 custom-card">
                <div class="card-body">
                    <h5 class="card-title">Categories</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($categories as $category)
                            <li class="list-group-item">
                                <a href="{{ route('category.posts', $category->slug) }}" class="text-decoration-none">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="card shadow-lg mb-4 border-0 rounded-3 custom-card">
                <div class="card-body">
                    <h5 class="card-title">Latest News</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($latestPosts as $latestPost)
                            <li class="list-group-item">
                                <a href="{{ route('posts.show', $latestPost->slug) }}" class="text-decoration-none">{{ $latestPost->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style>
    body {
    background-color: #f8f9fa; /* Light background for better contrast */
    font-family: 'Arial', sans-serif; 
}

.custom-card {
    border-radius: 10px; 
    transition: transform 0.3s; /* Smooth hover effect */
}

.custom-card:hover {
    transform: scale(1.02); /* Slightly enlarge on hover */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); /* Shadow effect */
}

.card-title {
    font-size: 2.5rem; /* Larger title font */
}

.post-content {
    line-height: 1.6; /* Improved readability */
    font-size: 1.1rem; /* Slightly larger font */
}

.btn-outline-secondary, .btn-outline-primary, .btn-outline-info, .btn-outline-danger {
    transition: background-color 0.3s, color 0.3s; /* Smooth button transitions */
}

.btn-outline-secondary:hover {
    background-color: #6c757d; /* Darken button on hover */
    color: white; /* Change text color */
}

.btn-outline-primary:hover {
    background-color: #0d6efd; /* Darken button on hover */
    color: white; 
}

.btn-outline-info:hover {
    background-color: #0dcaf0; /* Darken button on hover */
    color: white; /* Change text color */
}

.btn-outline-danger:hover {
    background-color: #dc3545; /* Darken button on hover */
    color: white; 
}

.list-group-item {
    background-color: #fff; /* White background for list items */
    transition: background-color 0.2s; /* Smooth hover effect */
}

.list-group-item:hover {
    background-color: #f1f1f1; /* Light grey on hover */
}

</style>