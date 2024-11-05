@extends('layout')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">User Profile</h1>
    <div class="card mb-4 shadow-sm border-0 rounded">
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-4 text-center">
                    <h4 class="mb-3">Profile Picture</h4>
                    @if($profile->profile_picture)
                        <div class="profile-picture-wrapper mb-3">
                            <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profile Picture" class="img-fluid rounded-circle shadow" style="width: 180px; height: 180px; object-fit: cover;">
                        </div>
                    @else
                        <div class="profile-picture-placeholder bg-light rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 180px; height: 180px;">
                            <i class="fas fa-user text-muted" style="font-size: 50px;"></i>
                        </div>
                    @endif
                </div>

                <div class="col-md-8">
                    <h4 class="mb-3">Basic Information</h4>
                    <p><strong>Bio:</strong> {{ $profile->bio ?? 'No bio available' }}</p>
                    <p><strong>GitHub:</strong> 
                        <a href="{{ $profile->github_link }}" class="text-decoration-none text-primary" target="_blank">{{ $profile->github_link }}</a>
                    </p>
                    <p><strong>Twitter:</strong> 
                        <a href="{{ $profile->twitter_link }}" class="text-decoration-none text-primary" target="_blank">{{ $profile->twitter_link }}</a>
                    </p>
                    <p><strong>LinkedIn:</strong> 
                        <a href="{{ $profile->linkedin_link }}" class="text-decoration-none text-primary" target="_blank">{{ $profile->linkedin_link }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 shadow-sm border-0 rounded">
        <div class="card-body p-4">
            <h5 class="d-flex align-items-center mb-4">Project Status</h5>
            <div class="progress-section">
                <div class="mb-3">
                    <p class="mb-1">Web Design</p>
                    <div class="progress" style="height: 8px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <p class="mb-1">Website Markup</p>
                    <div class="progress" style="height: 8px">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <p class="mb-1">One Page</p>
                    <div class="progress" style="height: 8px">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <p class="mb-1">Mobile Template</p>
                    <div class="progress" style="height: 8px">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div>
                    <p class="mb-1">Backend API</p>
                    <div class="progress" style="height: 8px">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('userprofile.edit') }}" class="btn btn-primary btn-lg px-4">Edit Profile</a>
    </div>
</div>

<style>
    .profile-picture-wrapper img {
        transition: transform 0.3s;
    }
    .profile-picture-wrapper img:hover {
        transform: scale(1.05);
    }
    .progress-section p {
        font-weight: 500;
        color: #333;
    }
    .progress-bar {
        transition: width 0.5s ease;
    }
</style>
@endsection
