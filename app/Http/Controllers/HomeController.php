<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Recent posts
        $posts = Post::where('status', 1)
            ->latest()
            ->take(5)
            ->get();
        
        // Top liked posts
        $topLikedPosts = Post::where('status', 1)
            ->withCount('likes') // Count likes
            ->orderBy('likes_count', 'desc')
            ->take(5) // Limit to top 5
            ->get();
        
        // Top commented posts
        $topCommentedPosts = Post::where('status', 1)
            ->withCount('comments') // Count comments
            ->orderBy('comments_count', 'desc')
            ->take(5) // Limit to top 5
            ->get();
        
        $categories = Category::all();
        
        return view('home', compact('posts', 'categories', 'topLikedPosts', 'topCommentedPosts'));
    }
}
