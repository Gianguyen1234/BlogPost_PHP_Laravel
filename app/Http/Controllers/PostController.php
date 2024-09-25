<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Mews\Purifier\Facades\Purifier;

class PostController extends Controller
{
    public function create()
    {
        // Fetch all categories to display in the create form
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug',
            'content' => 'required|string',
            'youtube_iframe' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'status' => 'required|boolean',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        // Avoid XSS attacks and prevent malicious code injection
        $cleanContent = strip_tags(Purifier::clean($validated['content']));

        // Create the post
        Post::create([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'content' => $cleanContent,
            'youtube_iframe' => $validated['youtube_iframe'],
            'meta_title' => $validated['meta_title'],
            'meta_description' => $validated['meta_description'],
            'meta_keyword' => $validated['meta_keyword'],
            'status' => $validated['status'],
            'category_id' => $validated['category_id'],
            'created_by' => auth()->id(), // Store the ID of the user creating the post
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function index()
    {
        $posts = Post::with('category')->get(); 
        return view('posts.index', compact('posts'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        // Check if the authenticated user is the owner or an admin
        if (auth()->id() !== $post->created_by && auth()->user()->role !== 'admin') {
            return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        }
        $categories = Category::all(); 
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug,' . $id,
            'content' => 'required|string',
            'youtube_iframe' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'status' => 'required|boolean',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $post = Post::findOrFail($id);
        
        if (auth()->id() !== $post->created_by && auth()->user()->role !== 'admin') {
            return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        }
        $cleanContent = strip_tags(Purifier::clean($validated['content']));

        // Update the post
        $post->update([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'content' => $cleanContent,
            'youtube_iframe' => $validated['youtube_iframe'],
            'meta_title' => $validated['meta_title'],
            'meta_description' => $validated['meta_description'],
            'meta_keyword' => $validated['meta_keyword'],
            'status' => $validated['status'],
            'category_id' => $validated['category_id'],
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if (auth()->id() !== $post->created_by && auth()->user()->role !== 'admin') {
            return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        }
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    public function show($id)
    {
        $post = Post::with('category')->findOrFail($id); 
        return view('posts.show', compact('post'));
    }
}
