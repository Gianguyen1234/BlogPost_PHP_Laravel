<div class="card shadow-lg mb-4 border-0 rounded-3 custom-card">
    <div class="card-body">
        <h5 class="card-title text-primary">Comments</h5>

        @if($post->comments->isNotEmpty())
        <!-- Display top-level comments -->
        @foreach($post->comments->where('parent_id', null) as $comment)
        <div class="comment mb-4 p-3 border rounded bg-light">
            <strong class="text-success">{{ $comment->author_name }}</strong>
            <p class="mt-2">{!! $comment->content !!}</p>
            <small class="text-muted">{{ $comment->created_at->format('F j, Y') }}</small>

            <!-- Upvote Button -->
            <button class="btn btn-outline-primary btn-sm upvote-button" data-id="{{ $comment->id }}">
                <i class="fas fa-thumbs-up"></i> <!-- Font Awesome thumbs up icon -->
                <span class="upvote-count">{{ $comment->upvotes }}</span>
            </button>

            <!-- Display Reply Form -->
            <button class="btn btn-link text-primary" data-bs-toggle="collapse" href="#replyForm{{$comment->id}}" aria-expanded="false">Reply</button>

            <div class="collapse" id="replyForm{{$comment->id}}">
                <form action="{{ route('comments.store', $post->slug) }}" method="POST" class="bg-light p-3 rounded border">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <div class="mb-3">
                        <label for="author_name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="author_name" placeholder="Your name" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Comment</label>
                        <textarea class="form-control" name="content" rows="3" placeholder="Your comment..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Post Reply</button>
                </form>
            </div>

            <!-- Display Nested Replies -->
            @if($comment->replies->isNotEmpty())
            <div class="replies ms-4 mt-4">
                @foreach($comment->replies as $reply)
                <div class="comment mb-3 p-2 border rounded bg-white">
                    <strong class="text-info">{{ $reply->author_name }}</strong>
                    <p class="mt-1">{{ $reply->content }}</p>
                    <small class="text-muted">{{ $reply->created_at->format('F j, Y') }}</small>
                </div>
                @endforeach
            </div>
            @endif
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