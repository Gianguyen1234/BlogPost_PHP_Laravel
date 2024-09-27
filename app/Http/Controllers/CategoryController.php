<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'navbar_status' => 'required|boolean',
            'status' => 'required|boolean',
            'created_by' => 'required|string',
        ]);

        try {
            $data = $request->all();

            // Sanitize input
            $data['description'] = strip_tags(Purifier::clean($data['description'] ?? ''));
            $data['meta_description'] = strip_tags(Purifier::clean($data['meta_description'] ?? ''));
            $data['meta_keyword'] = strip_tags(Purifier::clean($data['meta_keyword'] ?? ''));

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/categories'), $imageName);
                $data['image'] = 'images/categories/' . $imageName;
            }

            // Create category
            Category::create($data);

            return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            // Log the error and redirect back with an error message
            Log::error('Category creation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create category. Please try again.');
        }
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Updated to validate image
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'navbar_status' => 'required|boolean',
            'status' => 'required|boolean',
        ]);

        try {
            // Sanitize the input using Purifier
            $data = $request->except(['image']);  // Exclude image from $data array for now
            $data['description'] = strip_tags(Purifier::clean($data['description'] ?? ''));
            $data['meta_description'] = strip_tags(Purifier::clean($data['meta_description'] ?? ''));
            $data['meta_keyword'] = strip_tags(Purifier::clean($data['meta_keyword'] ?? ''));

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($category->image && file_exists(public_path($category->image))) {
                    unlink(public_path($category->image));
                }

                // Upload the new image
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->move(public_path('images/categories'), $imageName);

                // Save the new image path
                $data['image'] = 'images/categories/' . $imageName;
            }

            // Update the category with the new data
            $category->update($data);

            return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Category update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update category. Please try again.');
        }
    }


    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Category deletion failed: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to delete category. Please try again.');
        }
    }

    public function showUncategorized()
    {
        // Fetch posts or data for uncategorized category
        $uncategorizedPosts = Post::whereNull('category_id')->get(); // Assuming uncategorized posts have no category_id
        return view('posts.uncategorized', compact('uncategorizedPosts'));
    }
    public function showCategoryPosts($id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);

        // Fetch posts associated with the category
        $posts = $category->posts()->latest()->get();

        // Pass data to the view
        return view('posts.showcategory', compact('category', 'posts'));
    }
}
