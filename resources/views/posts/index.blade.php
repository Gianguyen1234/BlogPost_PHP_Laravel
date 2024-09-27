@extends('layout')

@section('title', 'All Blog Posts')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4 text-center">All Blog Posts</h1>
        
        @if($posts->isEmpty())
            <div class="alert alert-warning text-center" role="alert">
                No posts available at the moment.
            </div>
        @else
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm card-animation">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{!! Str::limit($post->content, 150, '...') !!}</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">View</a>
                                @if(Auth::check() && Auth::user()->role === 'admin') <!-- Show Edit and Delete buttons only for admins -->
                                    <div>
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection


<style>
    .card {
        border: none; /* Remove default card border */
        transition: transform 0.3s, box-shadow 0.3s; /* Smooth transition for hover effects */
        position: relative; /* Allow absolute positioning for overlay effect */
    }

    .card-animation:hover {
        transform: translateY(-5px); /* Lift card on hover */
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1); /* Increase shadow on hover */
    }

    .card-body {
        background-color: #f8f9fa; 
        border-radius: 0.5rem; 
    }

    .card-footer {
        background-color: #ffffff; /* White background for card footer */
        border-top: 1px solid #dee2e6; /* Subtle top border */
    }

    .btn {
        transition: background-color 0.3s, transform 0.3s; /* Smooth transition for button hover */
    }

    .btn:hover {
        transform: scale(1.05); /* Slightly enlarge buttons on hover */
    }

    /* Additional styling for button colors */
    .btn-primary {
        background-color: #007bff; /* Bootstrap primary color */
        border: none; /* Remove border */
    }

    .btn-warning {
        background-color: #ffc107; /* Bootstrap warning color */
        border: none; /* Remove border */
    }

    .btn-danger {
        background-color: #dc3545; /* Bootstrap danger color */
        border: none; /* Remove border */
    }

    /* Add media queries for better responsiveness */
    @media (max-width: 576px) {
        .card-title {
            font-size: 1.25rem; /* Adjust font size on small screens */
        }
    }
</style>

