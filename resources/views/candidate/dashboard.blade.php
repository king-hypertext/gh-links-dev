@extends('candidate.layout')
@section('content')
    @php
        $user = auth('candidate')->user();
    @endphp
    @if (!$user->profile?->isProfileCompleted())
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Profile Setup!</strong> Your profile setup is not completed yet.
        </div>
    @endif
    <div class="container mt-3">
        <h5 class="h6 text-capitalize fw-semibold">
            hello, {{ $user->profile->full_name }}
        </h5>
        <p class="text-lead text-muted">
            Here is your dashboard overview
        </p>
        <div class="overview-container">
            <div class="card-group">
                <div class="card mx-md-3">
                    <div class="card-body d-flex flex-row justify-content-between flex-nowrap">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="h6 fw-semibold mb-0">{{ $user->profile->job_applications->count() }}</h6>
                            <span>Applied jobs</span>
                        </div>
                        <div class="d-flex flex-row justify-content-center align-items-center">
                            <img src="{{ asset('icons/svgs/solid/suitcase.svg') }}" class="bg-body-secondary img-thumbnail"
                                style="color: var(--bs-primary)" width="50" alt="">
                        </div>
                    </div>
                </div>
                <div class="card mx-md-3">
                    <div class="card-body d-flex flex-row justify-content-between flex-nowrap">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="h6 fw-semibold mb-0">{{ $user->profile->saved_jobs->count() }}</h6>
                            <span>Favourite jobs</span>
                        </div>
                        <div class="d-flex flex-row justify-content-center align-items-center">
                            <img src="{{ asset('icons/svgs/solid/heart.svg') }}" class="bg-body-secondary img-thumbnail"
                                style="color: var(--bs-primary)" width="50" alt="">
                        </div>
                    </div>
                </div>
                <div class="card mx-md-3">
                    <div class="card-body d-flex flex-row justify-content-between flex-nowrap">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="h6 fw-semibold mb-0">{{ $user->profile->job_applications->count() }}</h6>
                            <span>Applied jobs</span>
                        </div>
                        <div class="d-flex flex-row justify-content-center align-items-center">
                            <img src="{{ asset('icons/svgs/solid/suitcase.svg') }}" class="bg-body-secondary img-thumbnail"
                                style="color: var(--bs-primary)" width="50" alt="">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
