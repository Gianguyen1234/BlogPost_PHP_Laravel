@extends('admin.dashboard')

@section('title', 'Manage Posts')

@section('content')
<h1>Manage Posts</h1>
<a href="{{route('admin.posts.create')}}" class="btn btn-primary">Create New Post</a>

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
                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('admin.posts.delete', $post->id) }}" method="POST" class="delete-post-form" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger delete-button">Delete</button>
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

<script>
    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent the form from submitting directly

            const form = this.closest('form'); // Get the form related to the button clicked

            // Trigger SweetAlert confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // If confirmed, submit the form
                }
            })
        });
    });
</script>

@endsection