@extends('layout')

@section('title', 'All Blog Posts')

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-center">All Blog Posts</h1>

    <!-- Sort Filter -->
    <div class="mb-3">
        <form action="{{ route('posts.index') }}" method="GET" class="form-inline">
            <label for="sort" class="mr-2">Sort by:</label>
            <select name="sort" id="sort" class="form-control" onchange="this.form.submit()">
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                <option value="popularity" {{ request('sort') == 'popularity' ? 'selected' : '' }}>Popularity</option>
                <option value="most_commented" {{ request('sort') == 'most_commented' ? 'selected' : '' }}>Most Commented</option>
            </select>
        </form>
    </div>

    @if($posts->isEmpty())
    <div class="alert alert-warning text-center" role="alert">
        No posts available at the moment.
    </div>
    @else

    <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-6 col-sm-12 mb-4"> <!-- Responsive columns -->
            <div class="card shadow-sm border-0  h-100"> <!-- Ensure full height -->
                <div class="row g-0 h-100">
                    <div class="col-md-8 d-flex flex-column"> <!-- Vertical alignment -->
                        <div class="card-body flex-grow-1 d-flex flex-column"> <!-- Flex column for card body -->
                            <h5 class="card-title" style="min-height: 60px;">{{ $post->title }}</h5> <!-- Fixed height for title -->
                            <p class="card-text" style="min-height: 40px;">{!! Str::limit(strip_tags(preg_replace('/<img[^>]+\>/i', '', $post->content)), 50) !!}</p> <!-- Fixed height for content -->
                            <small class="text-muted">Posted on {{ $post->created_at->format('M d, Y') }}</small>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-2">
                            <div class="btn-group" role="group" aria-label="Post actions"> <!-- Button group for better alignment -->
                                <a href="{{ route('posts.show', $post->slug) }}" class=" btn-primary " style=" text-decoration: none;">Continue reading</a>
                                @if(Auth::check() && Auth::user()->usertype === 'admin') <!-- Show Edit and Delete buttons only for admins -->
                                <a href="{{ route('posts.edit', $post->id) }}" class=" btn-warning" style=" text-decoration: none;">Edit</a>
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
                        @if($post->title_image)
                        <img src="{{ $post->title_image }}" class="img-fluid rounded-start post-image" alt="{{ $post->title }}" />
                        @else
                        <img src="https://placehold.co/400" class="img-fluid rounded-start post-image" alt="Placeholder image" /> <!-- Placeholder image -->
                        @endif
                    </div>


                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="row">
        <div class="col text-center">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    {{-- Previous Page Link --}}
                    @if ($posts->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                    @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $posts->previousPageUrl() }}" rel="prev">Previous</a>
                    </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @for ($i = 1; $i <= $posts->lastPage(); $i++)
                        @if ($i == $posts->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{ $i }}</span>
                        </li>
                        @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $posts->url($i) }}">{{ $i }}</a>
                        </li>
                        @endif
                        @endfor

                        {{-- Next Page Link --}}
                        @if ($posts->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $posts->nextPageUrl() }}" rel="next">Next</a>
                        </li>
                        @else
                        <li class="page-item disabled">
                            <span class="page-link">Next</span>
                        </li>
                        @endif
                </ul>
            </nav>
        </div>
    </div>
    @endif
</div>
@endsection

<style>
    .card {
        transition: transform 0.3s, box-shadow 0.3s;
        /* Smooth transition for hover effects */
    }

    .card:hover {
        transform: translateY(-5px);
        /* Lift card on hover */
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        /* Increase shadow on hover */
    }

    .btn {
        padding: 0.375rem 0.75rem;
        /* Adjust padding to control button size */
        font-size: 1rem;
        /* Set font size */
        line-height: 1.5;
        /* Set line height for better vertical alignment */
    }

    .btn-group .btn {
        margin-right: 5px;
        /* Adds space between buttons */
    }

    .btn-group .btn:last-child {
        margin-left: 5px;
        /* Remove right margin for the last button */
    }

    .btn:hover {
        transform: scale(1.05);
        /* Slightly enlarge buttons on hover */
    }

    .btn-primary {
        background-color: #007bff;
        /* Bootstrap primary color */
        border: none;
        /* Remove border */
        display: inline-flex;
        /* Use inline-flex for buttons */
        align-items: center;
        /* Center items vertically */
        justify-content: center;
        /* Center items horizontally */
        padding: 0.5rem 0.75rem;
        /* Add some padding */
        font-size: 1rem;
        /* Set font size */
        border-radius: 0.25rem;
        /* Optional: rounded corners */
        height: fit-content;
    }

    .btn-warning {
        background-color: #ffc107;
        /* Bootstrap warning color */
        border: none;
        height: fit-content;
        border-radius: 0.25rem;
        /* Optional: rounded corners */
        padding: 0.5rem 0.75rem;
        /* Add some padding */
        font-size: 1rem;
        /* Set font size */
        margin-left: 5px;
    }

    .post-image {
        border-radius: 8px;
        /* Rounded corners */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        /* Subtle shadow */
        transition: transform 0.3s, box-shadow 0.3s;
        /* Smooth transition */
        max-width: 100%;
        /* Ensure responsiveness */
        height: 400px;
        /* Maintain aspect ratio */
    }

    .post-image:hover {
        transform: scale(1.05);
        /* Slightly enlarge on hover */
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        /* Increase shadow on hover */
    }
</style>