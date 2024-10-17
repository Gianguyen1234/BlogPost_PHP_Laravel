@extends('layout')

@section('title', 'Home')

@section('content')

<!-- Carousel Section for Featured Posts -->
<div class="carousel-container mb-5">
    <h2 class="text-center display-4 mb-3 text-gradient">Featured Posts</h2>
    <div id="featuredCarousel" class="carousel slide shadow-lg" data-ride="carousel">
        <div class="carousel-inner rounded-lg">
            @foreach ($posts as $index => $post)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img data-src="{{ $post->banner_image ? asset($post->banner_image) : 'https://via.placeholder.com/900x500?text=' . urlencode($post->title) }}" class="d-block w-100 img-fluid rounded-lg lazyload" alt="Featured image for {{ $post->title }}">
                <div class="carousel-caption d-none d-md-block bg-gradient-dark p-3 rounded-lg">
                    <h4>{{ $post->title }}</h4>
                    <p>{!! Str::limit(strip_tags(preg_replace('/<img[^>]+\>/i', '', $post->content)), 120) !!}</p>
                    <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-gradient-warning">Read More</a>
                </div>
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#featuredCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#featuredCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<!-- Recent Blog Posts Section -->
<h2 class="text-center display-4 mb-4 text-gradient">Recent Posts</h2>
<div class="row">
    @foreach ($posts as $post)
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card h-100 shadow-sm border-0 rounded-lg bg-gradient-dark d-flex flex-column">
        <img src="{{ $post->title_image ? asset($post->title_image) : 'https://via.placeholder.com/400x200?text=' . urlencode($post->title) }}" class="card-img-top img-fluid rounded-top" alt="{{ $post->title }}">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{!! Str::limit(strip_tags(preg_replace('/<img[^>]+\>/i', '', $post->content)), 120) !!}</p>
                <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-gradient-warning btn-block mt-auto">Read More</a>
            </div>
            <div class="card-footer bg-dark text-muted d-flex justify-content-between align-items-center">
                <span>Posted on {{ $post->created_at->format('F j, Y') }}</span>
                @if ($post->category)
                <span class="badge badge-warning">{{ $post->category->name }}</span>
                @else
                <span class="badge badge-secondary">Uncategorized</span>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Top Liked Posts -->
<h2 class="text-center display-4 mb-4 text-gradient">Top Liked Posts</h2>
<div class="row">
    @foreach ($topLikedPosts as $post)
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card h-100 shadow-sm border-0 rounded-lg bg-gradient-dark d-flex flex-column">
        <img src="{{ $post->title_image ? asset($post->title_image) : 'https://via.placeholder.com/400x200?text=' . urlencode($post->title) }}" class="card-img-top img-fluid rounded-top" alt="{{ $post->title }}">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title text-warning">{{ $post->title }}</h5>
                <p class="card-text text-muted flex-grow-1">{!! Str::limit(strip_tags(preg_replace('/<img[^>]+\>/i', '', $post->content)), 120) !!}</p>
                <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-gradient-warning btn-block mt-auto">Read More</a>
            </div>
            <div class="card-footer bg-dark text-muted d-flex justify-content-between align-items-center">
                <span>Likes: {{ $post->likes_count }}</span>
                <span>Posted on {{ $post->created_at->format('F j, Y') }}</span>
                @if ($post->category)
                <span class="badge badge-warning">{{ $post->category->name }}</span>
                @else
                <span class="badge badge-secondary">Uncategorized</span>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Top Commented Posts -->
<h2 class="text-center display-4 mb-4 text-gradient">Top Commented Posts</h2>
<div class="row">
    @foreach ($topCommentedPosts as $post)
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card h-100 shadow-sm border-0 rounded-lg bg-gradient-dark d-flex flex-column">
        <img src="{{ $post->title_image ? asset($post->title_image) : 'https://via.placeholder.com/400x200?text=' . urlencode($post->title) }}" class="card-img-top img-fluid rounded-top" alt="{{ $post->title }}">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title text-warning">{{ $post->title }}</h5>
                <p class="card-text text-muted flex-grow-1">{!! Str::limit(strip_tags(preg_replace('/<img[^>]+\>/i', '', $post->content)), 120) !!}</p>
                <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-gradient-warning btn-block mt-auto">Read More</a>
            </div>
            <div class="card-footer bg-dark text-muted d-flex justify-content-between align-items-center">
                <span>Comments: {{ $post->comments_count }}</span>
                <span>Posted on {{ $post->created_at->format('F j, Y') }}</span>
                @if ($post->category)
                <span class="badge badge-warning">{{ $post->category->name }}</span>
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
    body {
        font-family: 'Roboto', sans-serif;
    }

    .text-gradient {
        background: linear-gradient(90deg, #ffcc00, #333);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .carousel-caption h4 {
        font-size: 1.75rem;
        font-weight: bold;
    }

    .carousel-caption p {
        font-size: 1.1rem;
    }

    /* Buttons with gradient */
    .btn-gradient-warning {
        background: linear-gradient(90deg, #ffcc00, #333);
        color: #fff;
        border: none;
        box-shadow: 0 4px 8px rgba(255, 204, 0, 0.4);
    }

    .btn-gradient-warning:hover {
        background: linear-gradient(90deg, #333, #ffcc00);
        color: #fff;
    }

    /* Carousel Improvements */
    .carousel-item img {
        object-fit: cover;
        height: 500px;
        /* Adjust the height */
        width: 100%;
        /* Keep the width full */
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: #333;
        padding: 15px;
        border-radius: 50%;
    }

    .carousel-caption {
        background: rgba(0, 0, 0, 0.7);
        padding: 20px;
        border-radius: 10px;
    }

    /* Card Styles with gradient */
    .card {
        display: flex;
        flex-direction: column;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card-body {
        display: flex;
        flex-direction: column;
    }

    .card-text {
        flex-grow: 1;
    }

    .btn-block {
        margin-top: auto;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .card-title {
        font-size: 1.25rem;
        color: #ffcc00;
    }

    .card-text {
        font-size: 0.9rem;
        color: #ddd;
    }

    .card-footer {
        font-size: 0.8rem;
    }

    /* Gradient for cards */
    .bg-gradient-dark {
        background: linear-gradient(135deg, #333, #000);
    }

    @media (max-width: 412px) {
        .carousel-item img {
            height: 400px;
        }

        .carousel-caption h4 {
            font-size: 1.25rem;
        }

        .carousel-caption p {
            font-size: 1rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .card-body h5 {
            font-size: 1rem;
        }

        .card-body p {
            font-size: 0.85rem;
        }
    }

    .loading-spinner {
        border: 8px solid #f3f3f3;
        border-radius: 50%;
        border-top: 8px solid #333;
        width: 40px;
        height: 40px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>