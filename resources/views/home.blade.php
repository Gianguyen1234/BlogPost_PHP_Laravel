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
                    <!-- Responsive Image -->
                    <img src="https://via.placeholder.com/900x400?text={{ urlencode($post->title) }}" class="d-block w-100 img-fluid" alt="Featured image for {{ $post->title }}">
                    <div class="carousel-caption d-none d-md-block">
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
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-light">
                <img src="https://via.placeholder.com/400x200?text={{ urlencode($post->title) }}" class="card-img-top img-fluid" alt="{{ $post->title }}">
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

<style>
    /* Carousel caption styles for mobile */
    .carousel-caption {
        position: absolute;
        bottom: 10px;
        left: 10px;
        right: 10px;
        padding-bottom: 10px;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
        padding: 15px;
        border-radius: 10px;
        text-align: left;
    }

    .carousel-caption h4,
    .carousel-caption p {
        color: #fff;
    }

    /* Adjust caption font size for smaller screens */
    @media (max-width: 768px) {
        .carousel-caption h4 {
            font-size: 1.25rem;
        }

        .carousel-caption p {
            font-size: 0.9rem;
        }
    }

    /* Make sure the carousel images are responsive */
    .carousel-item img {
        width: 100%;
        height: auto;
    }

    /* Responsive adjustments for cards */
    @media (max-width: 576px) {
        .card-body h5 {
            font-size: 1rem;
        }

        .card-body p {
            font-size: 0.9rem;
        }

        .btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
        }
    }
</style>
