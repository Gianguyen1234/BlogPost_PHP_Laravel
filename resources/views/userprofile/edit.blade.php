@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header text-center bg-light">
            <h2 class="mb-3" style="font-family: 'Poppins', sans-serif; color: #2c3e50;">Edit Profile</h2>
            <p class="text-muted">"God is in the details"</p>
        </div>
        <div class="card-body bg-light p-4">
            <form method="POST" action="{{ route('userprofile.update') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="bio" class="form-label fw-bold">Bio <i class="bi bi-pencil"></i></label>
                    <textarea id="bio" name="bio" rows="4" class="form-control @error('bio') is-invalid @enderror" placeholder="Describe yourself in a few words">{{ old('bio', $profile->bio) }}</textarea>
                    @error('bio')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="github_link" class="form-label fw-bold">GitHub Link <i class="bi bi-github text-dark"></i></label>
                    <input id="github_link" name="github_link" type="url" class="form-control @error('github_link') is-invalid @enderror" placeholder="https://github.com/username" value="{{ old('github_link', $profile->github_link) }}">
                    @error('github_link')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="twitter_link" class="form-label fw-bold">Twitter Link <i class="bi bi-twitter text-info"></i></label>
                    <input id="twitter_link" name="twitter_link" type="url" class="form-control @error('twitter_link') is-invalid @enderror" placeholder="https://twitter.com/username" value="{{ old('twitter_link', $profile->twitter_link) }}">
                    @error('twitter_link')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="linkedin_link" class="form-label fw-bold">LinkedIn Link <i class="bi bi-linkedin text-primary"></i></label>
                    <input id="linkedin_link" name="linkedin_link" type="url" class="form-control @error('linkedin_link') is-invalid @enderror" placeholder="https://linkedin.com/in/username" value="{{ old('linkedin_link', $profile->linkedin_link) }}">
                    @error('linkedin_link')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="profile_picture" class="form-label fw-bold">Profile Picture <i class="bi bi-image"></i></label>
                    <input id="profile_picture" name="profile_picture" type="file" class="form-control" accept="image/*" onchange="previewImage(event)">
                    <div id="imagePreview" class="mt-2 text-center" style="display:none;">
                        <img id="preview" src="" alt="Profile Picture Preview" class="img-fluid rounded-circle shadow" style="width: 150px; height: 150px; border: 3px solid #3498db;">
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill">Save Changes <i class="bi bi-save"></i></button>
                </div>
            </form>
        </div>

        <div class="card-footer text-center bg-light">
            <p class="mb-0 text-muted">"Your journey is sacred."</p>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('preview');
            output.src = reader.result;
            document.getElementById('imagePreview').style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
