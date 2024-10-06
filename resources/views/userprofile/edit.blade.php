@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h2>Edit Profile</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('userprofile.update') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea id="bio" name="bio" rows="3" class="form-control @error('bio') is-invalid @enderror">{{ old('bio', $profile->bio) }}</textarea>
                    @error('bio')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="github_link" class="form-label">GitHub Link <i class="bi bi-github"></i></label>
                    <input id="github_link" name="github_link" type="url" class="form-control @error('github_link') is-invalid @enderror" value="{{ old('github_link', $profile->github_link) }}">
                    @error('github_link')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="twitter_link" class="form-label">Twitter Link <i class="bi bi-twitter"></i></label>
                    <input id="twitter_link" name="twitter_link" type="url" class="form-control @error('twitter_link') is-invalid @enderror" value="{{ old('twitter_link', $profile->twitter_link) }}">
                    @error('twitter_link')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="linkedin_link" class="form-label">LinkedIn Link <i class="bi bi-linkedin"></i></label>
                    <input id="linkedin_link" name="linkedin_link" type="url" class="form-control @error('linkedin_link') is-invalid @enderror" value="{{ old('linkedin_link', $profile->linkedin_link) }}">
                    @error('linkedin_link')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="profile_picture" class="form-label">Profile Picture</label>
                    <input id="profile_picture" name="profile_picture" type="file" class="form-control" accept="image/*" onchange="previewImage(event)">
                    <div id="imagePreview" class="mt-2" style="display:none;">
                        <img id="preview" src="" alt="Profile Picture Preview" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
        <div class="card-footer text-muted">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="d-flex align-items-center mb-3">Project Status</h5>
                            <p>Web Design</p>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p>Website Markup</p>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p>One Page</p>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p>Mobile Template</p>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p>Backend API</p>
                            <div class="progress" style="height: 5px">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection