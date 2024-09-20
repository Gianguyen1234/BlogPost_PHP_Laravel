<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all(); // Get all categories
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create'); // Show form for creating a category
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'navbar_status' => 'required|boolean',
            'status' => 'required|boolean',
            'created_by' => 'required|string',
        ]);

        // Sanitize the input using Purifier
        $data = $request->all();
        $data['description'] = Purifier::clean($data['description'] ?? '');
        $data['meta_description'] = Purifier::clean($data['meta_description'] ?? '');
        $data['meta_keyword'] = Purifier::clean($data['meta_keyword'] ?? '');

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category')); // Show form for editing a category
    }
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'navbar_status' => 'required|boolean',
            'status' => 'required|boolean',
        ]);

        // Sanitize the input using Purifier
        $data = $request->all();
        $data['description'] = Purifier::clean($data['description'] ?? '');
        $data['meta_description'] = Purifier::clean($data['meta_description'] ?? '');
        $data['meta_keyword'] = Purifier::clean($data['meta_keyword'] ?? '');

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
