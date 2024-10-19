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
                    <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-gradient-warning">
                        <span>Read More</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
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
            <img src="{{ $post->title_image ? asset($post->title_image) : asset('images/logo/default.png') }}"
                class="card-img-top img-fluid rounded-top custom-image"
                style=" object-fit: cover;"
                alt="{{ $post->title }}">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{!! Str::limit(strip_tags(preg_replace('/<img[^>]+\>/i', '', $post->content)), 120) !!}</p>
                <a href="{{ route('posts.show', $post->slug) }}" class="read-more-btn" style=" text-decoration: none;">
                    <span>Read More</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                <span>Posted on {{ $post->created_at->format('F j, Y') }}</span>

                @if ($post->category)
                <span class="badge badge-warning d-flex align-items-center">
                    <i class="fas fa-tag mr-2"></i> <!-- Font Awesome tag icon -->
                    {{ $post->category->name }}
                </span>
                @else
                <span class="badge badge-secondary d-flex align-items-center">
                    <i class="fas fa-question-circle mr-2"></i> <!-- Icon for uncategorized -->
                    Uncategorized
                </span>
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
            <img src="{{ $post->title_image ? asset($post->title_image) : asset('images/logo/default.png') }}"
                class="card-img-top img-fluid rounded-top custom-image"
                alt="{{ $post->title }}">

            <div class="card-body d-flex flex-column">
                <h5 class="card-title text-warning">{{ $post->title }}</h5>
                <p class="card-text text-muted flex-grow-1">{!! Str::limit(strip_tags(preg_replace('/<img[^>]+\>/i', '', $post->content)), 120) !!}</p>
                <a href="{{ route('posts.show', $post->slug) }}" class="read-more-btn" style=" text-decoration: none;">
                    <span>Read More</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="card-footer  text-muted d-flex justify-content-between align-items-center">
                <span>Likes: {{ $post->likes_count }}</span>
                <span>Posted on {{ $post->created_at->format('F j, Y') }}</span>
                @if ($post->category)
                <span class="badge badge-warning d-flex align-items-center">
                    <i class="fas fa-tag mr-2"></i> <!-- Font Awesome tag icon -->
                    {{ $post->category->name }}
                </span>
                @else
                <span class="badge badge-secondary d-flex align-items-center">
                    <i class="fas fa-question-circle mr-2"></i> <!-- Icon for uncategorized -->
                    Uncategorized
                </span>
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
            <img src="{{ $post->title_image ? asset($post->title_image) : asset('images/logo/default.png') }}"
                class="card-img-top img-fluid rounded-top custom-image"
                alt="{{ $post->title }}">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title text-warning">{{ $post->title }}</h5>
                <p class="card-text text-muted flex-grow-1">{!! Str::limit(strip_tags(preg_replace('/<img[^>]+\>/i', '', $post->content)), 120) !!}</p>
                <a href="{{ route('posts.show', $post->slug) }}" class="read-more-btn" style=" text-decoration: none;">
                    <span>Read More</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="card-footer  text-muted d-flex justify-content-between align-items-center">
                <span>Comments: {{ $post->comments_count }}</span>
                <span>Posted on {{ $post->created_at->format('F j, Y') }}</span>
                @if ($post->category)
                <span class="badge badge-warning d-flex align-items-center">
                    <i class="fas fa-tag mr-2"></i> <!-- Font Awesome tag icon -->
                    {{ $post->category->name }}
                </span>
                @else
                <span class="badge badge-secondary d-flex align-items-center">
                    <i class="fas fa-question-circle mr-2"></i> <!-- Icon for uncategorized -->
                    Uncategorized
                </span>
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
        font-size: 1.75rem;
        /* Larger, but still readable */
        color: #ffcc00;
        /* Your original color, but we can improve contrast */
        font-weight: 900;
        /* Stronger emphasis for a bold statement */
        text-transform: uppercase;
        /* Uppercase for a modern, bold look */
        text-align: left;
        /* Align to left for a structured appearance */
        margin-bottom: 10px;
        /* Space between title and content */
        line-height: 1.2;
        /* Compact line height */
        letter-spacing: 0.02em;
        /* Tighten spacing to keep it professional */
        position: relative;
        /* For adding decorative elements */
    }

    .card-title::before {
        content: "";
        /* Decorative underline */
        position: absolute;
        left: 0;
        bottom: -5px;
        width: 40px;
        /* Customize width for style */
        height: 3px;
        background-color: #ffcc00;
        /* Matches title color */
        border-radius: 2px;
        /* Rounded for softer effect */
    }


    .custom-image {
        width: 100%;
        height: 100px;
        border: 1px solid #ddd;
        padding: 5px;
        background-color: #f8f9fa;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease-in-out;
    }

    .custom-image:hover {
        transform: scale(1.05);
    }



    .card-footer {
        font-size: 0.8rem;
    }

    .read-more-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #ffcc00;
        color: #000;
        padding: 12px 28px;
        border-radius: 50px;
        font-weight: bold;
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        cursor: pointer;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);

    }

    .read-more-btn:hover {
        background-color: #ffd633;
        box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.25);
        transform: translateY(-3px);
        /* Moves button up slightly on hover */
    }

    .read-more-btn i {

        margin-left: 10px;
        font-size: 18px;
        /* Adjust icon size */
        transition: transform 0.3s ease;
    }

    .read-more-btn:hover i {
        transform: translateX(5px);
        /* Moves the icon slightly to the right on hover */
    }

    .read-more-btn:active {
        transform: scale(0.98);
        /* Press-down effect */
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