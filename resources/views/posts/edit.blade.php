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
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
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

        {{-- Content Field with CodeMirror --}}
        <div class="form-group">
            <label for="content">Content</label>
            <textarea id="content" name="content" class="form-control" rows="10" required>{{ old('content', $post->content) }}</textarea>
           
        </div>
        <div id="render-here" class="mt-3"></div>

        {{-- Additional fields for banner image, YouTube iFrame, etc. --}}
        <div class="form-group">
            <label for="banner_image">Banner Image (Optional)</label>
            <input type="file" class="form-control" name="banner_image" id="banner_image" accept="image/*">
            @error('banner_image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="title_image">Title Image</label>
            <input type="file" name="title_image" class="form-control" id="title_image" accept="image/*">
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

{{-- Include CodeMirror JS and CSS --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/python/python.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/javascript/javascript.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/xml/xml.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/css/css.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/htmlmixed/htmlmixed.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/clike/clike.min.js"></script>

{{-- Initialize CodeMirror --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const contentArea = document.getElementById("content");
        const code = contentArea.value;

        // Function to detect language
        function detectLanguage(code) {
            if (code.includes('import') && code.includes('from')) {
                return 'python';
            } else if (code.includes('function') || code.includes('console')) {
                return 'javascript';
            } else if (code.includes('<html>') || code.includes('<body>')) {
                return 'htmlmixed';
            } else if (code.includes('class') && code.includes('public')) {
                return 'clike'; // For languages like Java or C#
            }
            // Add more conditions for other languages as needed
            return 'text/plain'; // Default to plain text if no match
        }

        // Detect language and initialize CodeMirror
        const mode = detectLanguage(code);
        const editor = CodeMirror.fromTextArea(contentArea, {
            lineNumbers: true,
            mode: mode,
            theme: "default",
            height: "auto",
            autoCloseBrackets: true,
            matchBrackets: true,
        });

        // Make sure CodeMirror content updates the original textarea value
        editor.on('change', function(instance) {
            contentArea.value = instance.getValue();
        });
    });
</script>
@endsection
