<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;


class CommentController extends Controller
{
    public function index($slug)
    {
        // Find the post by slug
        $post = Post::where('slug', $slug)->firstOrFail();
        // Fetch comments related to the specific post
        $comments = $post->comments; // Assuming you have a relationship set up
        return view('comments.index', compact('comments', 'post'));
    }

    public function create($slug)
    {
        // Optionally show a form to create a comment for the specific post
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('comments.create', compact('post'));
    }

    public function show($slug, $id)
    {
        // Find the post by slug
        $post = Post::where('slug', $slug)->firstOrFail();
        // Show a specific comment for the post
        $comment = $post->comments()->findOrFail($id);
        return view('comments.show', compact('comment', 'post'));
    }

    public function store(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        // Validate the request
        $request->validate([
            'author_name' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',  // Validate the parent comment (if any)
        ]);

        // Create the comment or reply
        $post->comments()->create([
            'author_name' => $request->author_name,
            'content' => $request->content,
            'parent_id' => $request->parent_id,  // Set parent_id if it's a reply
        ]);

        return redirect()->route('posts.show', $post->slug)->with('success', 'Comment posted successfully!');
    }
    
    public function upvote($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->increment('upvotes'); // Increase the upvote count
        return response()->json(['success' => true, 'upvotes' => $comment->upvotes]);
    }
}
