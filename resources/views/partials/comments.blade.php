<div class="card shadow-lg mb-4 border-0 rounded-3 custom-card">
    <div class="card-body">
        <h5 class="card-title text-primary">Comments</h5>
        
        <!-- Display existing comments -->
        @if($post->comments->isNotEmpty())
            @foreach($post->comments as $comment)
                <div class="comment mb-4 p-3 border rounded bg-light">
                    <strong class="text-success">{{ $comment->author_name }}</strong>
                    <p class="mt-2">{{ $comment->content }}</p>
                    <small class="text-muted">{{ $comment->created_at->format('F j, Y') }}</small>
                </div>
            @endforeach
        @else
            <div class="alert alert-info" role="alert">
                No comments yet. Be the first to comment!
            </div>
        @endif

        <!-- Comment Form -->
        <h6 class="mt-4">Leave a Comment:</h6>
        <form action="{{ route('comments.store', $post->slug) }}" method="POST" class="bg-light p-4 rounded border">
            @csrf
            <div class="mb-3">
                <label for="author_name" class="form-label">Name</label>
                <input type="text" class="form-control" name="author_name" placeholder="Your name" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Comment</label>
                <textarea class="form-control" name="content" rows="3" placeholder="Your comment..." required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Post Comment</button>
        </form>
    </div>
</div>
