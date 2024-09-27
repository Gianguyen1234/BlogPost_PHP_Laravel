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
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow-sm border-0">
                            <div class="row g-0">
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                        <p class="card-text">{!! Str::limit($post->content, 150, '...') !!}</p>
                                        <small class="text-muted">Posted on {{ $post->created_at->format('M d, Y') }}</small>
                                        <div class="mt-3">
                                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Continue reading</a>
                                            @if(Auth::check() && Auth::user()->role === 'admin') <!-- Show Edit and Delete buttons only for admins -->
                                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-items-center justify-content-center">
                                    @if($post->image_url)
                                        <img src="{{ $post->image_url }}" class="img-fluid rounded-start" alt="{{ $post->title }} image" /> <!-- Image on the right -->
                                    @else
                                        <img src="https://placehold.co/400" class="img-fluid rounded-start" alt="Placeholder image" /> <!-- Placeholder image -->
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@section('styles')
<style>
    .card {
        transition: transform 0.3s, box-shadow 0.3s; /* Smooth transition for hover effects */
    }

    .card:hover {
        transform: translateY(-5px); /* Lift card on hover */
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2); /* Increase shadow on hover */
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
</style>
@endsection
