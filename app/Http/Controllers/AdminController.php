<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\PostView;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all posts
        $posts = Post::with('category')->get();

        // Pass the posts to the view
        return view('admin.posts.index', compact('posts'));
    }
    public function showAnalytics()
    {
        // Fetch total user data
        $uniqueVisitors = \App\Models\Visit::distinct('ip_address')->count('ip_address');
        $totalUsers = \App\Models\Visit::count();

        // Fetch most viewed posts, including their titles and view counts
        $mostViewedPosts = \App\Models\PostView::with('post') // Eager load the related Post
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get(['post_id', 'views_count']); // Include 'post_id' to join with the Post table

        // Find the post with the largest view count
        $topPost = \App\Models\PostView::with('post')
            ->orderBy('views_count', 'desc')
            ->first(['post_id', 'views_count']); // Get only the top post

        return view('admin.analytics', compact('totalUsers', 'uniqueVisitors', 'mostViewedPosts', 'topPost'));
    }


    public function createPost()
    {
        // Fetch all categories to display in the create form
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function storePost(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|string',
            'youtube_iframe' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'status' => 'required|in:0,2',
            'category_id' => 'nullable|exists:categories,id',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

        // If the user is an admin, allow them to set the status
        if (auth()->user()->usertype == 'admin') {
            $postData['status'] = $validated['status']; // Admin can publish or set as draft
        } else {
            // For non-admins, set status to draft by default
            $postData['status'] = 0;
        }

        // Handle image upload
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/posts'), $imageName);
            $postData['banner_image'] = 'images/posts/' . $imageName;
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

    public function draftPosts()
    {
        // Fetch draft posts (status 0), rejected posts (status 2), and approved posts (status 1)
        $draftPosts = Post::where('status', 0)->with('author')->get(); // Draft status
        $rejectedPosts = Post::where('status', 2)->with('author')->get(); // Rejected status
        $approvedPosts = Post::where('status', 1)->with('author')->get(); // Approved status

        return view('admin.posts.draft', compact('draftPosts', 'rejectedPosts', 'approvedPosts'));
    }
    // Function to display the edit view for a draft post
    public function editDraftPost($id)
    {
        $post = Post::findOrFail($id);  // Fetch the post by ID

        return view('admin.posts.draftedit', compact('post'));
    }

    // Function to handle the update after the post is edited
    public function updateDraftPost(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Determine if the form is trying to publish or reject a post
        $isStatusUpdate = $request->has('status') && !$request->has('title') && !$request->has('content');

        // Validate incoming data
        if ($isStatusUpdate) {
            // If it's just a status update (publish/reject), only validate the status field
            $request->validate([
                'status' => 'required|integer|in:0,1,2',
            ]);
        } else {
            // Otherwise, validate all fields for draft editing
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required',
                'status' => 'required|integer|in:0,1,2',
            ]);
        }

        // Update the post
        $post->update([
            'title' => $request->input('title', $post->title),
            'content' => $request->input('content', $post->content), // Use current content if not provided
            'status' => $request->input('status'),
        ]);

        // Set the appropriate success message based on status
        $message = '';
        if ($request->input('status') == 1) {
            $message = 'Draft post published successfully.';
        } elseif ($request->input('status') == 2) {
            $message = 'Draft post rejected successfully.';
        } else {
            $message = 'Draft post updated successfully.';
        }

        // Redirect to post management page with a success message
        return redirect()->route('admin.posts.index')->with('success', $message);
    }
}
