@extends('layout')

@section('title', 'Create New Post')

@section('content')
<div class="container mt-5">
    <h1 class="page-title">Create New Post</h1>
    <form action="{{ route('admin.posts.store') }}" method="POST" class="post-form">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter the title here..." required>
        </div>
        
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter the slug here..." >
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <!-- CKEditor textarea -->
            <textarea id="content" name="content" class="form-control" placeholder="Write your content here..." rows="10"></textarea>
        </div>

        <div class="form-group">
            <label for="youtube_iframe">YouTube Iframe (Optional)</label>
            <input type="text" class="form-control" id="youtube_iframe" name="youtube_iframe" placeholder="Enter YouTube iframe code here...">
        </div>

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

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control" required>
                <option value="1">Published</option>
                <option value="0">Draft</option>
            </select>
        </div>

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
