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

