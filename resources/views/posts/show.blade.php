@extends('layout')

@section('title', $post->title)

@section('meta')
<meta name="keywords" content="{{ $post->meta_keyword }}">
@endsection
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-lg mb-4 border-0 rounded-3 custom-card">
                <div class="card-body">
                    <h1 class="custom-title" style="font-family: 'Poppins', sans-serif; font-size: 3rem; font-weight: bold; text-decoration: none; ">
                        {{ $post->title }}
                    </h1>

                    <!-- Show meta keywords only if they exist -->
                    @if(!empty($post->meta_keyword))
                    <p class="text-muted mb-4">
                        <strong>Keywords:</strong> {{ $post->meta_keyword }}
                    </p>
                    @endif

                    <!-- Slug and Love Button Section -->
                    <div class="d-flex align-items-center mb-4">
                        <p class="text-muted mb-0 me-3">{{ $post->slug }}</p> <!-- Added margin to separate slug and icon -->
                        <!-- Push love icon to the right -->
                        @auth
                        <button id="like-btn" class="btn btn-outline-none p-0 ms-auto" data-like-url="{{ route('like.post', $post->slug) }}">
                            <i class="fas {{ Auth::user()->likes()->where('post_id', $post->id)->exists() ? 'fa-heart text-danger' : 'fa-heart text-muted' }} fs-4"></i> <!-- Increase font size with fs-4 class -->
                            <span id="like-count" class="ms-2">{{ $post->likes->count() }}</span> <!-- Added margin to the count for spacing -->
                        </button>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-outline-none p-0 ms-auto" aria-label="Login to Like" style="margin-left: 20px;">
                            <i class="fas fa-sign-in-alt fs-1" style="color: #ff4d4f;font-size: 1.75rem;"></i> <!-- "Love" color (red) icon -->
                        </a>
                        @endauth
                    </div>
                    <p class="text-muted mb-4">
                        <small>Published by <strong>{{ $post->author->name }}</strong> on {{ $post->created_at->format('F j, Y') }}</small>
                    </p>
                    <div class="post-content mb-4">
                        <pre><code class="language-python">{{  $post->content  }}</code></pre>
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

            <!-- Include Comments Section -->
            @include('partials.comments')

        </div>
        <!-- Menu bar section -->
        <div class="col-lg-4">
            @include('partials.menubar')
            <!-- author card -->
            <div class="card shadow-lg mb-4 border-0 rounded-3 custom-card">
                <div class="card-body d-flex align-items-center">
                    <div class="author-avatar me-3">
                        <img src="{{ $post->author->avatar ?? 'default-avatar.jpg' }}" alt="Author's Avatar" class="rounded-circle" width="80" height="80">
                    </div>
                    <div>
                        <h5 class="card-title mb-1 ml-2">{{ $post->author->name }}</h5>
                        <p class="text-muted mb-2">{{ $post->author->bio }}</p>
                        @auth
                        <form id="follow-form" method="POST"
                            data-follow-url="{{ route('follow', ['slug' => $post->slug, 'id' => $post->author->id]) }}"
                            data-unfollow-url="{{ route('unfollow', ['slug' => $post->slug, 'id' => $post->author->id]) }}">
                            @csrf
                            <button type="submit" id="follow-btn" class="btn btn-info ml-2">
                                {{ Auth::user()->following()->where('followed_id', $post->author->id)->exists() ? 'Unfollow' : 'Follow' }}
                            </button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-info ml-2">
                            Follow
                        </a>
                        @endauth

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<script>
    document.getElementById('follow-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        const followBtn = document.getElementById('follow-btn');
        const currentText = followBtn.innerText; // Current button text (Follow/Unfollow)

        // Get the URLs from data attributes
        const followUrl = this.getAttribute('data-follow-url');
        const unfollowUrl = this.getAttribute('data-unfollow-url');

        // Determine the action URL based on the button's current text
        const actionUrl = currentText === 'Follow' ? followUrl : unfollowUrl;

        // Make an AJAX request
        fetch(actionUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Toggle the button text between Follow and Unfollow
                    followBtn.innerText = currentText === 'Follow' ? 'Unfollow' : 'Follow';
                } else {
                    alert('Something went wrong. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>

{{-- Include Highlight.js for syntax highlighting --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/styles/default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/highlight.min.js"></script>
<script>
    hljs.highlightAll();
</script>

@endsection

<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Arial', sans-serif;
    }

    .post-content img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 0 auto;
        padding: 10px 0;
    }

    .custom-card {
        border-radius: 10px;
        transition: transform 0.3s;
    }

    .custom-card:hover {
        transform: scale(1.02);
        /* Slightly enlarge on hover */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        /* Shadow effect */
    }

    .card-title {
        font-size: 2.5rem;
        /* Larger title font */
    }

    .post-content {
        line-height: 1.6;
        /* Improved readability */
        font-size: 1.1rem;
        /* Slightly larger font */
    }

    .btn-outline-secondary,
    .btn-outline-primary,
    .btn-outline-info,
    .btn-outline-danger {
        transition: background-color 0.3s, color 0.3s;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }

    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: white;
    }

    .btn-outline-info:hover {
        background-color: #0dcaf0;
        color: white;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        /* Darken button on hover */
        color: white;
    }

    .list-group-item {
        background-color: #fff;
        /* White background for list items */
        transition: background-color 0.2s;
        /* Smooth hover effect */
    }

    .list-group-item:hover {
        background-color: #f1f1f1;
        /* Light grey on hover */
    }

    .author-avatar img {
        object-fit: cover;
    }

    #like-btn i {
        font-size: 24px;
        /* Adjust size as needed */
    }

    #like-btn {
        margin-left: 20px;
        /* Adjust spacing from slug */
    }
</style>