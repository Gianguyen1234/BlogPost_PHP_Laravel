<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        
        // Search for posts matching the query in title or content
        $posts = Post::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->get();

        return view('search', compact('posts', 'query'));
    }
}
