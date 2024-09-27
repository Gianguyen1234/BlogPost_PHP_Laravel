<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


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
        // Find the post by slug
        $post = Post::where('slug', $slug)->firstOrFail();

        // Validate the request
        $request->validate([
            'author_name' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
        ]);

        // Create the comment
        $post->comments()->create([
            'author_name' => $request->author_name,
            'content' => $request->content,
        ]);

        // Redirect back to the post's detail page
        return redirect()->route('posts.show', $post->slug)->with('success', 'Comment posted successfully!');
    }
}
