<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all posts
        $posts = Post::all();

        // Pass the posts to the view
        return view('admin.dashboard', compact('posts'));
    }
    public function showAnalytics()
    {
        // Fetch total user data (this is an example)
        $totalUsers = 1234;
        return view('admin.analytics', compact('totalUsers'));
    }
}
