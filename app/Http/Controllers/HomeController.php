<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Retrieve the latest 5 posts
        $posts = Post::latest()->take(5)->get();

        // Retrieve all categories
        $categories = Category::all();

        // Pass the posts and categories to the view
        return view('home', compact('posts', 'categories'));
    }
}






