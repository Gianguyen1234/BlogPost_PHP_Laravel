@extends('layout')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Create Profile</h1>

    <form method="POST" action="{{ route('userprofile.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea id="bio" name="bio" rows="3" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="github_link" class="form-label">GitHub Link</label>
            <input id="github_link" name="github_link" type="url" class="form-control">
        </div>

        <div class="mb-3">
            <label for="twitter_link" class="form-label">Twitter Link</label>
            <input id="twitter_link" name="twitter_link" type="url" class="form-control">
        </div>

        <div class="mb-3">
            <label for="linkedin_link" class="form-label">LinkedIn Link</label>
            <input id="linkedin_link" name="linkedin_link" type="url" class="form-control">
        </div>

        <div class="mb-3">
            <label for="profile_picture" class="form-label">Profile Picture</label>
            <input id="profile_picture" name="profile_picture" type="file" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create Profile</button>
    </form>
</div>
@endsection
