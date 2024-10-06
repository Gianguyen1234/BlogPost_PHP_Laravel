@extends('layout')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">User Profile</h1>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <h4 class="mb-3">Profile Picture</h4>
                    @if($profile->profile_picture)
                        <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                    @else
                        <div class="bg-light rounded-circle" style="width: 150px; height: 150px; display: flex; align-items: center; justify-content: center;">
                            <span class="text-muted">No Image</span>
                        </div>
                    @endif
                </div>

                <div class="col-md-8">
                    <h4 class="mb-3">Basic Information</h4>
                    <p><strong>Bio:</strong> {{ $profile->bio ?? 'No bio available' }}</p>
                    <p><strong>GitHub:</strong> 
                        <a href="{{ $profile->github_link }}" class="text-primary" target="_blank">{{ $profile->github_link }}</a>
                    </p>
                    <p><strong>Twitter:</strong> 
                        <a href="{{ $profile->twitter_link }}" class="text-primary" target="_blank">{{ $profile->twitter_link }}</a>
                    </p>
                    <p><strong>LinkedIn:</strong> 
                        <a href="{{ $profile->linkedin_link }}" class="text-primary" target="_blank">{{ $profile->linkedin_link }}</a>
                    </p>
                </div>
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
    </div>

    <div class="text-center">
        <a href="{{ route('userprofile.edit') }}" class="btn btn-primary">Edit Profile</a>
    </div>
</div>
@endsection
