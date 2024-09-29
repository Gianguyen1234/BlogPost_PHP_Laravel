@extends('admin.dashboard')

@section('title', 'Add Category')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <h1>Add Category</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Upload Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        <div class="mb-3">
            <label for="meta_title" class="form-label">Meta Title</label>
            <input type="text" class="form-control" id="meta_title" name="meta_title">
        </div>
        <div class="mb-3">
            <label for="meta_description" class="form-label">Meta Description</label>
            <textarea class="form-control" id="meta_description" name="meta_description"></textarea>
        </div>
        <div class="mb-3">
            <label for="meta_keyword" class="form-label">Meta Keyword</label>
            <textarea class="form-control" id="meta_keyword" name="meta_keyword"></textarea>
        </div>
        <div class="mb-3">
            <label for="navbar_status" class="form-label">Navbar Status</label>
            <select class="form-select" id="navbar_status" name="navbar_status" required>
                <option value="1">Show</option>
                <option value="0">Hide</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <input type="hidden" name="created_by" value="{{ auth()->user()->name }}">
        <button type="submit" class="btn btn-success">Create Category</button>
    </form>
    <hr>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-primary mt-3">View All Categories</a>
@endsection
