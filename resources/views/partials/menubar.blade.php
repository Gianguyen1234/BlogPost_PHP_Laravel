<div class="col-lg-4">
    <div class="card shadow-lg mb-4 border-0 rounded-3 custom-card">
        <div class="card-body">
            <h5 class="card-title">Categories</h5>
            <ul class="list-group list-group-flush">
                @foreach($categories as $category)
                <li class="list-group-item">
                    <a href="{{ route('category.posts', $category->slug) }}" class="text-decoration-none">{{ $category->name }}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="card shadow-lg mb-4 border-0 rounded-3 custom-card">
        <div class="card-body">
            <h5 class="card-title">Latest News</h5>
            <ul class="list-group list-group-flush">
                @foreach($latestPosts as $latestPost)
                <li class="list-group-item">
                    <a href="{{ route('posts.show', $latestPost->slug) }}" class="text-decoration-none">{{ $latestPost->title }}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- author profile -->
    <div class="card shadow-lg mb-4 border-0 rounded-3 custom-card">
        <div class="card-body d-flex align-items-center">
            <div class="author-avatar me-3">
                <img src="{{ $post->author->avatar ?? 'default-avatar.jpg' }}" alt="Author's Avatar" class="rounded-circle" width="80" height="80">
            </div>
            <div>
                <h5 class="card-title mb-1">{{ $post->author->name }}</h5>
                <p class="text-muted mb-2">{{ $post->author->bio }}</p>
                <form action="#" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline-success">Follow</button>
                </form>

            </div>
        </div>
    </div>

</div>