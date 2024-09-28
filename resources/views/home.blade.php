@extends('layout')

@section('title', 'Home')

@section('content')
<div class="container mt-5">
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
                    <span class="badge badge-primary">{{ $post->category->name }}</span> <!-- Display category name if it exists -->
                    @else
                    <span class="badge badge-secondary">Uncategorized</span> <!-- Fallback if no category -->
                    @endif
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    /* Card Styles */
    .card {
        border-radius: 10px;
        /* Rounded corners */
        transition: transform 0.2s, box-shadow 0.2s;
        /* Smooth transition effects */
    }

    .card:hover {
        transform: translateY(-5px);
        /* Slight lift on hover */
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        /* Shadow on hover */
    }

    .card-img-top {
        border-top-left-radius: 10px;
        /* Match card border radius */
        border-top-right-radius: 10px;
        /* Match card border radius */
    }

    .btn-outline-primary {
        color: #007bff;
        /* Text color */
        border-color: #007bff;
        /* Border color */
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        /* Background color on hover */
        color: white;
        /* Text color on hover */
    }

    .badge {
        font-size: 0.85rem;
        /* Slightly smaller badge font */
        padding: 0.5em 0.75em;
        /* Padding for badge */
    }
</style>
@endsection