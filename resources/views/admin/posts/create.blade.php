@extends('admin.dashboard')

@section('content')
    <h1>Create Post</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.posts.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" required>
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" name="slug" id="slug" required>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" name="content" id="content" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label for="youtube_iframe">YouTube Iframe</label>
            <textarea class="form-control" name="youtube_iframe" id="youtube_iframe" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="meta_title">Meta Title</label>
            <input type="text" class="form-control" name="meta_title" id="meta_title">
        </div>

        <div class="form-group">
            <label for="meta_description">Meta Description</label>
            <textarea class="form-control" name="meta_description" id="meta_description" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="meta_keyword">Meta Keywords</label>
            <textarea class="form-control" name="meta_keyword" id="meta_keyword" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status" id="status">
                <option value="1">Published</option>
                <option value="0">Draft</option>
            </select>
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" name="category_id" id="category_id">
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="created_by" value="{{ auth()->id() }}">

        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
@endsection
