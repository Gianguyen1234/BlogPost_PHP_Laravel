<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Retrieve the latest 5 posts
        $posts = Post::latest()->take(5)->get();

        // Pass the posts to the view
        return view('home', compact('posts'));
    }
}






