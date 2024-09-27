@extends('layout')

@section('title', 'Home')

@section('content')
    <div class="container mt-5">
        <!-- Welcome Section -->
        <div class="jumbotron">
            <h1 class="display-4">Welcome to MyBlog!</h1>
            <p class="lead">Your go-to place for the latest updates, articles, and insights on various topics. Dive into our recent posts or explore different categories.</p>
            <hr class="my-4">
            <p>We offer a wide range of topics from technology to lifestyle and travel. Feel free to browse around and find what interests you the most!</p>
        </div>

        <!-- Recent Blog Posts Section -->
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">Recent Posts</h2>
                @foreach ($posts as $post)
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{!! Str::limit($post->content, 150, '...') !!}</p>
                            <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-primary">Read More</a>
                        </div>
                        <div class="card-footer text-muted">
                            Posted on {{ $post->created_at->format('F j, Y') }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
