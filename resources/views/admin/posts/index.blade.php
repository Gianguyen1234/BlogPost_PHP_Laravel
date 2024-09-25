@extends('admin.dashboard')

@section('title', 'Manage Posts')

@section('content')
<h1>Manage Posts</h1>
<a href="#" class="btn btn-primary">Create New Post</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Category</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td>{!! Str::limit($post->title, 20) !!}</td>
            <td>{!! Str::limit($post->content, 80) !!}</td>
            <td>{{ $post->category ? $post->category->name : 'Uncategorized' }}</td>
            <td>{{ $post->created_at->format('Y-m-d H:i') }}</td>
            <td>
                <a href="#" class="btn btn-warning">Edit</a>
                <form action="#" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">No posts found.</td>
        </tr>
        @endforelse
    </tbody>

</table>
@endsection