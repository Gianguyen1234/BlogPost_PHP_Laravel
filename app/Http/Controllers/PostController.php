<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Mews\Purifier\Facades\Purifier;


class PostController extends Controller
{

    public function create()
    {
        return view('posts.create');
    }
    // public function store(Request $request)
    // {
    // $validated = $request->validate(['title' => 'required|max:255',
    // 'content' => 'required',
    // ]);

    // Post::create(['title' => $validated['title'],
    // 'content' => $validated['content'],
    // ]);

    // return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    // }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // avoid XSS attacks and prevent malicious code injection
        $cleanContent = Purifier::clean($validated['content']);

        Post::create([
            'title' => $validated['title'],
            'content' => $cleanContent,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }
}
