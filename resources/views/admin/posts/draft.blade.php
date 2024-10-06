@extends('admin.dashboard')

@section('title', 'Draft, Approved, and Rejected Posts')

@section('content')


<div class="container mt-5">
    <h1 class="page-title text-center mb-4">Post Management</h1>

    <div class="section mb-5">
        <h2 class="mb-3">Draft Posts</h2>
        @if($draftPosts->isEmpty())
        <div class="alert alert-info">No draft posts found.</div>
        @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($draftPosts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->author->name }}</td>
                        <td>Draft</td>
                        <td>
                            <a href="{{ route('admin.posts.draftedit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.posts.draftupdate', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="1">
                                <button type="submit" class="btn btn-sm btn-success">Publish</button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <div class="section mb-5">
        <h2 class="mb-3">Approved Posts</h2>
        @if($approvedPosts->isEmpty())
        <div class="alert alert-info">No approved posts found.</div>
        @else
        <div class="table-responsive">
            <table class="table table-hover" id="addTable">
                <thead class="thead-light">
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($approvedPosts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->author->name }}</td>
                        <td>Approved</td>
                        <td>
                            <a href="{{ route('admin.posts.draftedit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <!-- Button to reject a draft with SweetAlert confirmation -->
                            <form id="rejectForm-{{ $post->id }}" action="{{ route('admin.posts.draftupdate', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="2"> <!-- Change to rejected status -->
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmReject('{{ $post->id }}')">Reject</button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <div class="section mb-5">
        <h2 class="mb-3">Rejected Posts</h2>
        @if($rejectedPosts->isEmpty())
        <div class="alert alert-info">No rejected posts found.</div>
        @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rejectedPosts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->author->name }}</td>
                        <td>Rejected</td>
                        <td>
                            <a href="{{ route('admin.posts.draftedit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.posts.draftupdate', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="0"> <!-- Change back to draft -->
                                <button type="submit" class="btn btn-sm btn-secondary">Revert to Draft</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

@endsection