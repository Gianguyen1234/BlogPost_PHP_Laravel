@extends('layout')

@section('title', 'Create New Post')

@section('content')

<div class="container mt-5">
    <h1 class="page-title">Create New Post</h1>
    <form action="{{ Auth::check() && Auth::user()->usertype === 'admin' ? route('admin.posts.store') : route('posts.store') }}" method="POST" class="post-form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter the title here..." required>
        </div>

        <div class="form-group">
            <label for="slug">Slug (Optional)</label>
            <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter the slug here...">
        </div>

        <!-- Content with Code Block Insertion -->
        <div class="form-group" id="editor-container">
            <label for="content">Content</label>
            <textarea id="content" name="content" class="form-control" placeholder="Write your content here..." rows="10"></textarea>

            <!-- Code Block Button -->
            <button type="button" class="btn btn-secondary mt-2" id="add-code-block">
                <i class="fas fa-code"></i> Add Code Block
            </button>

            <!-- Convert Button -->
            <div class="mt-2">
                <button type="button" class="btn btn-primary" id="convert-button">Convert to HTML</button>
                <button type="submit" class="btn btn-success" id="save-button">Save to Database</button>
            </div>
        </div>

        <!-- Render HTML Output Here -->
        <div id="render-here" class="mt-3"></div>

        <!-- Other Form Fields (unchanged) -->
        <div class="form-group">
            <label for="banner_image">Banner Image (Optional)</label>
            <input type="file" class="form-control" name="banner_image" id="banner_image" accept="image/*">
            @error('banner_image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="title_image">Title Image</label>
            <input type="file" name="title_image" class="form-control" id="title_image" accept="image/*">
        </div>


        <!-- YouTube Iframe -->
        <div class="form-group">
            <label for="youtube_iframe">YouTube Iframe (Optional)</label>
            <input type="text" class="form-control" id="youtube_iframe" name="youtube_iframe" placeholder="Enter YouTube iframe code here...">
        </div>

        <!-- Meta Information (unchanged) -->
        <div class="form-group">
            <label for="meta_title">Meta Title (Optional)</label>
            <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter meta title here...">
        </div>

        <div class="form-group">
            <label for="meta_description">Meta Description (Optional)</label>
            <textarea id="meta_description" name="meta_description" class="form-control" placeholder="Enter meta description here..." rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="meta_keyword">Meta Keywords (Optional)</label>
            <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" placeholder="Enter meta keywords here...">
        </div>

        <!-- Status and Category (unchanged) -->
        @if(Auth::check() && Auth::user()->usertype === 'admin')
        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control" required>
                <option value="0">Draft</option>
                <option value="1" >Publish</option>                
            </select>
        </div>
        @else
        <input type="hidden" name="status" value="0">
        @endif

        <div class="form-group">
            <label for="category_id">Category</label>
            <select id="category_id" name="category_id" class="form-control">
                <option value="">Select a category (Optional)</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>

@endsection