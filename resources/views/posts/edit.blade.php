@extends('layout')
@section('title', 'Edit Post')
@section('content')
<div class="container">
    <h1>Edit Post</h1>

    {{-- Display any validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Post edit form --}}
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Title Field --}}
        <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
        </div>

        {{-- Slug Field --}}
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug', $post->slug) }}" required>
        </div>

        {{-- Content Field --}}
        <div class="form-group">
            <label for="content">Content</label>
            <textarea id="content" name="content" class="form-control" rows="10" required>{{ old('content', $post->content) }}</textarea>
            <div class="mt-2">
                <button type="button" class="btn btn-primary" id="convert-button">Convert to HTML</button>
                <button type="submit" class="btn btn-success" id="save-button">Save to Database</button>
            </div>
        </div>
        <div id="render-here" class="mt-3"></div>

        <div class="form-group">
            <label for="banner_image">Banner Image (Optional)</label>
            <input type="file" class="form-control" name="banner_image" id="banner_image" accept="image/*">
            @error('banner_image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>


        {{-- YouTube iFrame Field --}}
        <div class="form-group">
            <label for="youtube_iframe">YouTube iFrame (Optional)</label>
            <input type="text" name="youtube_iframe" class="form-control" value="{{ old('youtube_iframe', $post->youtube_iframe) }}">
        </div>

        {{-- Meta Title --}}
        <div class="form-group">
            <label for="meta_title">Meta Title</label>
            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $post->meta_title) }}">
        </div>

        {{-- Meta Description --}}
        <div class="form-group">
            <label for="meta_description">Meta Description</label>
            <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $post->meta_description) }}</textarea>
        </div>

        {{-- Meta Keyword --}}
        <div class="form-group">
            <label for="meta_keyword">Meta Keywords</label>
            <input type="text" name="meta_keyword" class="form-control" value="{{ old('meta_keyword', $post->meta_keyword) }}">
        </div>

        {{-- Category Select Dropdown --}}
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == old('category_id', $post->category_id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Status Radio Buttons --}}
        <div class="form-group">
            <label for="status">Status</label>
            <div>
                <label>
                    <input type="radio" name="status" value="1" {{ old('status', $post->status) == 1 ? 'checked' : '' }}> Published
                </label>
                <label>
                    <input type="radio" name="status" value="0" {{ old('status', $post->status) == 0 ? 'checked' : '' }}> Pending
                </label>
            </div>
        </div>

        {{-- Save Changes Button --}}
        <button type="submit" class="btn btn-primary">Save Changes</button>

        {{-- Cancel Button --}}
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection
