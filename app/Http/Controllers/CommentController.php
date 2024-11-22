<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;

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
        // Define a unique rate limit key (use user ID if logged in, otherwise fallback to IP)
        $key = $request->user() 
            ? 'comment|user:' . $request->user()->id 
            : 'comment|ip:' . $request->ip();

        // Check if the user/IP is rate-limited
        if (!RateLimiter::attempt($key, 1, function () {
            return true;
        }, 300)) { // 300 seconds = 5 minutes
            return redirect()->back()->withErrors(['error' => 'You can only post one comment every 5 minutes. Please wait and try again.']);
        }

        // Fetch the post by its slug
        $post = Post::where('slug', $slug)->firstOrFail();

        // Validate the incoming request
        $request->validate([
            'author_name' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',  // Validate parent comment
            'g-recaptcha-response' => 'required|string',  // reCAPTCHA validation
        ]);

        // Verify the reCAPTCHA response with Google's API
        $recaptchaResponse = $request->input('g-recaptcha-response');
        $recaptchaSecret = env('RECAPTCHA_SECRET_KEY');

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $recaptchaSecret,
            'response' => $recaptchaResponse,
            'remoteip' => $request->ip(),
        ]);

        if (!$response->json('success')) {
            return redirect()->back()->withErrors(['g-recaptcha-response' => 'Captcha verification failed.'])->withInput();
        }

        // Sanitize the comment content using HTML Purifier
        $sanitizedContent = Purifier::clean($request->content);

        if (empty(trim($sanitizedContent))) {
            return redirect()->back()->withErrors(['content' => 'Your comment does not contain valid content.'])->withInput();
        }

        // Create the comment or reply (escape author name and assign sanitized content)
        $post->comments()->create([
            'author_name' => htmlspecialchars($request->author_name, ENT_QUOTES, 'UTF-8'), // Escape author name
            'content' => $sanitizedContent,  // Store sanitized content
            'parent_id' => $request->parent_id,  // Assign parent_id if it's a reply
        ]);

        // Redirect back to the post page with a success message
        return redirect()->route('posts.show', $post->slug)->with('success', 'Comment posted successfully!');
    }

    public function upvote($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->increment('upvotes'); // Increase the upvote count
        return response()->json(['success' => true, 'upvotes' => $comment->upvotes]);
    }
}
