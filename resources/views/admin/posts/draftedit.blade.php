@extends('admin.dashboard')

@section('title', 'Edit Draft Post')

@section('content')
<div class="container mt-5">
    <h1>Edit Draft Post</h1>

    <!-- Display any success messages -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Back to Draft Posts button -->
    <a href="{{ route('admin.posts.draft') }}" class="btn btn-outline-info mt-2 mb-2">Back to Draft Posts</a>

    <!-- Edit post form -->
    <form action="{{ route('admin.posts.draftupdate', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title) }}" required>
        </div>

        <div class="form-group">
            <label for="content">Post Content</label>
            <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content', strip_tags($post->content, '<b><i><strong>')) }}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Post Status</label>
            <select name="status" id="status" class="form-control">
                <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Draft</option>
                <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Published</option>
                <option value="2" {{ $post->status == 2 ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Post</button>
    </form>

    <!-- Another Back to Draft Posts button at the bottom -->
    <a href="{{ route('admin.posts.draft') }}" class="btn btn-outline-info mt-4">Back to Draft Posts</a>
</div>
@endsection
