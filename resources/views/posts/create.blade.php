@extends('layout')

@section('title', 'Create New Post')

@section('content')
<div class="container mt-5">
    <h1 class="page-title">Create New Post</h1>
    <form action="{{ route('posts.store') }}" method="POST" class="post-form">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter the title here..." required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <!-- CKEditor textarea -->
            <textarea id="content" name="content" class="form-control" placeholder="Write your content here..." rows="10"  ></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>
@endsection