@extends('layout')

@section('title', 'Home')

@section('content')
<div class="container mt-5">
    <!-- Floating Category Menu Button -->
    @include('partials.floatingmenu')

    <!-- Carousel Section for Featured Posts -->
    <div class="carousel-container mb-5">
        <h2 class="text-center mb-3">Featured Posts</h2>
        <div id="featuredCarousel" class="carousel slide shadow-lg" data-ride="carousel">
            <div class="carousel-inner rounded">
                @foreach ($posts as $index => $post)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img src="https://via.placeholder.com/900x400?text={{ urlencode($post->title) }}" class="d-block w-100" alt="Featured image for {{ $post->title }}">
                    <div class="carousel-caption">
                        <h4>{{ $post->title }}</h4>
                        <p>{{ Str::limit($post->content, 150, '...') }}</p>
                        <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#featuredCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#featuredCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <!-- Recent Blog Posts Section -->
    <h2 class="text-center mb-4">Recent Posts</h2>
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-light">
                <img src="https://via.placeholder.com/400x200?text={{ urlencode($post->title) }}" class="card-img-top" alt="{{ $post->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ Str::limit($post->content, 100, '...') }}</p>
                    <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-outline-primary">Read More</a>
                </div>
                <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                    <span>Posted on {{ $post->created_at->format('F j, Y') }}</span>
                    @if ($post->category)
                    <span class="badge badge-primary">{{ $post->category->name }}</span>
                    @else
                    <span class="badge badge-secondary">Uncategorized</span>
                    @endif
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
