@extends('admin.dashboard')

@section('title', 'Edit Category')

@section('content')
    <h1>Edit Category</h1>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ $category->slug }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description">{!! $category->description !!}</textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image URL</label>
            <input type="text" class="form-control" id="image" name="image" value="{{ $category->image }}">
        </div>
        <div class="mb-3">
            <label for="meta_title" class="form-label">Meta Title</label>
            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $category->meta_title }}">
        </div>
        <div class="mb-3">
            <label for="meta_description" class="form-label">Meta Description</label>
            <textarea class="form-control" id="meta_description" name="meta_description">{!! $category->meta_description !!}</textarea>
        </div>
        <div class="mb-3">
            <label for="meta_keyword" class="form-label">Meta Keyword</label>
            <textarea class="form-control" id="meta_keyword" name="meta_keyword">{!! $category->meta_keyword !!}</textarea>
        </div>
        <div class="mb-3">
            <label for="navbar_status" class="form-label">Navbar Status</label>
            <select class="form-select" id="navbar_status" name="navbar_status" required>
                <option value="1" {{ $category->navbar_status ? 'selected' : '' }}>Show</option>
                <option value="0" {{ !$category->navbar_status ? 'selected' : '' }}>Hide</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="1" {{ $category->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$category->status ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
@endsection
