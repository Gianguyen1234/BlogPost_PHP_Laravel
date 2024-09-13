@extends('layout')

@section('title', 'Create New Post')

@section('content')
    <div class="container">
        <h1 class="page-title">Create New Post</h1>
        <form action="{{ route('posts.store') }}" method="POST" class="post-form">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter the title here...">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <div class="editor-toolbar">
                    <button type="button" class="toolbar-btn" data-command="bold"><i class="fas fa-bold"></i></button>
                    <button type="button" class="toolbar-btn" data-command="italic"><i class="fas fa-italic"></i></button>
                    <button type="button" class="toolbar-btn" data-command="underline"><i class="fas fa-underline"></i></button>
                    <button type="button" class="toolbar-btn" data-command="code"><i class="fas fa-code"></i></button>
                    <button type="button" class="toolbar-btn" data-command="image"><i class="fas fa-image"></i></button>
                    <button type="button" class="toolbar-btn" data-command="link"><i class="fas fa-link"></i></button>
                    <button type="button" class="toolbar-btn" data-command="upload"><i class="fas fa-upload"></i></button>
                </div>
                <textarea class="form-control" id="content" name="content" placeholder="Write your content here..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.toolbar-btn');
    const textarea = document.getElementById('content');
    
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const command = button.getAttribute('data-command');
            document.execCommand(command, false, null);
            textarea.focus();
        });
    });
});
</script>

