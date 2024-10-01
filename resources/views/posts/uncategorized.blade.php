@extends('layout')

@section('title', 'Uncategorized Posts')

@section('content')
<div class="container my-5">
    <div class="row mb-4">
        <div class="col text-center">
            <h1 class="display-4">Uncategorized Posts</h1>
        </div>
    </div>

    @if($uncategorizedPosts->isEmpty())
    <div class="alert alert-warning text-center" role="alert">
        No uncategorized posts found.
    </div>
    @else
    <div class="row">
        @foreach($uncategorizedPosts as $post)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <!-- Image display removed -->
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <!-- Strip image tags from the content -->
                    <p class="card-text flex-grow-1">
                        {!! Str::limit(strip_tags(preg_replace('/<img[^>]+\>/i', '', $post->content)), 120) !!}
                    </p>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">
                        Posted on {{ $post->created_at->format('M d, Y') }} by {{ $post->author->name ?? 'Unknown' }}
                    </small>
                    <br>
                    <a href="{{ url('/posts', $post->slug) }}" class="btn btn-outline-primary mt-2">Read More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
