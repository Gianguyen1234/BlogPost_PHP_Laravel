<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\PostView;

class PostController extends Controller
{

    public function index(Request $request)
    {
        // Default sort option
        $sort = $request->input('sort', 'newest');

        // Cache key based on the sort option
        $cacheKey = "posts_{$sort}";

        // Attempt to retrieve posts from cache
        $posts = Cache::remember($cacheKey, 60, function () use ($sort) {
            // Fetch only published posts (status = 1) with pagination (10 posts per page)
            $postsQuery = Post::where('status', 1)
                ->with(['category', 'author'])
                ->withCount('likes'); // Count likes

            // Apply sorting based on user selection
            switch ($sort) {
                case 'popularity':
                    $postsQuery->orderBy('likes_count', 'desc'); // Sort by likes count
                    break;

                case 'most_commented':
                    $postsQuery->withCount('comments') // Count comments
                        ->orderBy('comments_count', 'desc');
                    break;

                case 'newest':
                default:
                    $postsQuery->orderBy('created_at', 'desc');
                    break;
            }

            // Execute the query and paginate the results
            return $postsQuery->paginate(10); // Adjust the number as needed
        });

        return view('posts.index', compact('posts', 'sort'));
    }

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
            'status' => 'required|boolean', // Allow status (published or draft)
            'category_id' => 'nullable|exists:categories,id',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation for title_image
        ]);

        // Generate the slug from the title
        $slug = Str::slug($validated['title']);

        // Check if the slug is unique, and append a number if it already exists
        $existingSlugCount = Post::where('slug', 'like', $slug . '%')->count();
        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }

        // Set the post data
        $postData = [
            'title' => $validated['title'],
            'slug' => $slug,
            'content' => $validated['content'],
            'youtube_iframe' => $validated['youtube_iframe'],
            'meta_title' => $validated['meta_title'],
            'meta_description' => $validated['meta_description'],
            'meta_keyword' => $validated['meta_keyword'],
            'category_id' => $validated['category_id'],
            'created_by' => auth()->id(),
        ];
        if (auth()->user()->usertype == 'admin') {
            $postData['status'] = $validated['status']; // Admin can publish or set as draft
        } else {
            // For non-admins, set status to draft by default
            $postData['status'] = 0; // Draft (status 0)
        }

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/posts'), $imageName);
            $postData['banner_image'] = 'images/posts/' . $imageName;
        }

        // Handle title image upload
        if ($request->hasFile('title_image')) {
            $titleImage = $request->file('title_image');
            $titleImageName = time() . '_title_' . $titleImage->getClientOriginalName();
            $titleImage->move(public_path('images/title_image'), $titleImageName);
            $postData['title_image'] = 'images/posts/' . $titleImageName; // Store the title image path
        }

        try {
            // Create the post
            Post::create($postData);

            // Redirect with success message
            return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
        } catch (\Exception $e) {
            // Handle any exceptions
            return redirect()->back()->withErrors(['error' => 'Failed to create post. Please try again.']);
        }
    }


    public function edit($id)
    {
        $post = Post::findOrFail($id);
        // Check if the authenticated user is the owner or an admin
        if (auth()->id() !== $post->created_by && auth()->user()->role == 'admin') {
            return redirect()->route('admin.posts.index')->with('error', 'Unauthorized access.');
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
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation for title_image
        ]);

        $post = Post::findOrFail($id);

        // Generate and check the slug
        $slug = Str::slug($validated['title']);
        $existingSlugCount = Post::where('slug', 'like', $slug . '%')->where('id', '!=', $post->id)->count();
        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }

        // Clean the content and prepare post data
        $cleanContent = Purifier::clean($validated['content']);
        $postData = [
            'title' => $validated['title'],
            'slug' => $slug,
            'content' => $cleanContent,
            'youtube_iframe' => $validated['youtube_iframe'],
            'meta_title' => $validated['meta_title'],
            'meta_description' => $validated['meta_description'],
            'meta_keyword' => $validated['meta_keyword'],
            'status' => $validated['status'],
            'category_id' => $validated['category_id'],
        ];

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            // Check if the directory exists
            if (!file_exists(public_path('images/posts'))) {
                mkdir(public_path('images/posts'), 0755, true);
            }

            // Process the new banner image
            $image = $request->file('banner_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/posts'), $imageName);
            $postData['banner_image'] = 'images/posts/' . $imageName; // Store the banner image path
        }

        // Handle title image upload
        if ($request->hasFile('title_image')) {
            // Check if the directory exists
            if (!file_exists(public_path('images/posts'))) {
                mkdir(public_path('images/posts'), 0755, true);
            }

            // Process the new title image
            $titleImage = $request->file('title_image');
            $titleImageName = time() . '_title_' . $titleImage->getClientOriginalName();
            $titleImage->move(public_path('images/posts'), $titleImageName);
            $postData['title_image'] = 'images/posts/' . $titleImageName; // Store the title image path
        }

        // Update the post
        $post->update($postData);

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

    public function show($slug)
    {
        $post = Post::with('category')->where('slug', $slug)->firstOrFail();
         // Increment the view count for the post
        $this->incrementPostView($post);

        // Fetch paginated comments for the post (e.g., 5 comments per page)
        $comments = $post->comments()->orderBy('created_at', 'desc')->paginate(5);

        $categories = Category::all();
        $latestPosts = Post::latest()->take(5)->get();

        return view('posts.show', compact('post', 'comments', 'categories', 'latestPosts'));
    }

    public function likePost(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $user = auth()->user();
        $liked = $user->likes()->where('post_id', $post->id)->exists();

        if ($liked) {
            // If already liked, remove the like
            $user->likes()->detach($post->id);
        } else {
            // If not liked yet, like the post
            $user->likes()->attach($post->id);
        }

        // Return the new like count and whether the user has liked the post
        return response()->json([
            'success' => true,
            'likes_count' => $post->likes()->count(),
            'liked' => !$liked, // Tells if the user just liked or unliked
        ]);
    }

    // Function to increment the view count
    public function incrementPostView(Post $post)
    {
        // Check if a PostView record already exists for the post
        $postView = PostView::where('post_id', $post->id)->first();

        if ($postView) {
            // Increment the existing views_count
            $postView->increment('views_count');
        } else {
            // Create a new PostView record if none exists
            PostView::create([
                'post_id' => $post->id,
                'views_count' => 1,
            ]);
        }
    }
}
