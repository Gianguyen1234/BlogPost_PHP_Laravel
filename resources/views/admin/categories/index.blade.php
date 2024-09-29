@extends('admin.dashboard')

@section('title', 'Categories')

@section('content')

    <h1>Categories</h1>

    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary" style="margin-bottom: 20px;">Add New Category</a>

    @if($categories->isEmpty())
        <p>No categories found.</p>
    @else
        <table class="table" id="addTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{!! Str::limit($category->description, 150, '...') !!}</td>
                        <td>
                            @if($category->image)
                                <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" width="50">
                            @else
                                No image
                            @endif
                        </td>
                        <td>{{ $category->status ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const form = this.closest('form');

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
                        form.submit(); 
                    }
                });
            });
        });
    </script>
@endsection
