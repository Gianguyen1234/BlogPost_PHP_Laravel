<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Str;

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
            'content' => 'required|string',
            'youtube_iframe' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'status' => 'required|boolean',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        // Generate the slug from the title
        $slug = Str::slug($validated['title']);

        // Check if slug is unique, and append a number if it already exists
        $existingSlugCount = Post::where('slug', 'like', $slug . '%')->count();
        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }

        // Clean the content to avoid XSS attacks
        $cleanContent = strip_tags(Purifier::clean($validated['content']));

        // Create the post
        Post::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'content' => $cleanContent,
            'youtube_iframe' => $validated['youtube_iframe'],
            'meta_title' => $validated['meta_title'],
            'meta_description' => $validated['meta_description'],
            'meta_keyword' => $validated['meta_keyword'],
            'status' => $validated['status'],
            'category_id' => $validated['category_id'],
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }


    public function index()
    {
        $posts = Post::with(['category', 'author'])->get();
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
            'content' => 'required|string',
            'youtube_iframe' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'status' => 'required|boolean',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $post = Post::findOrFail($id);

        // Ensure the user has permission to update the post
        if (auth()->id() !== $post->created_by && auth()->user()->role !== 'admin') {
            return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        }

        // Generate the slug from the title
        $slug = Str::slug($validated['title']);

        // Check if slug is unique, and append a number if it already exists
        $existingSlugCount = Post::where('slug', 'like', $slug . '%')
            ->where('id', '!=', $post->id) // Exclude current post
            ->count();
        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }

        // Clean the content to avoid XSS attacks
        $cleanContent = strip_tags(Purifier::clean($validated['content']));

        // Update the post
        $post->update([
            'title' => $validated['title'],
            'slug' => $slug,
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
        // Fetch the post with its category
        $post = Post::with('category')->findOrFail($id);

        // Fetch all categories for the sidebar
        $categories = Category::all();

        // Fetch latest posts for the sidebar (optional)
        $latestPosts = Post::latest()->take(5)->get();

        // Pass the post, categories, and latest posts to the view
        return view('posts.show', compact('post', 'categories', 'latestPosts'));
    }
}
