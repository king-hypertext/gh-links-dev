@extends('employer.layout')
@section('content')
    @php
        $user = auth('employer')->user();
    @endphp
    <h5 class="h6 text-capitalize fw-semibold">
        hello, {{ $user->full_name }}
    </h5>
    <p class="text-lead text-muted">
        Here is your dashboard overview
    </p>
    {{-- @if ($emailNotVerified)
        <div class="alert alert-info" role="alert">
            <strong>Email Not Verified!</strong>
        </div>
    @else --}}
        <div class="overview-container">
            <div class="card-group">
                <div class="card mx-md-3">
                    <div class="card-body d-flex flex-row justify-content-between flex-nowrap">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="h6 fw-semibold mb-0">{{ $user->profile->jobs->count() }}</h6>
                            <span>Jobs</span>
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
                            <h6 class="h6 fw-semibold mb-0">{{ $user->profile->saved_candidates->count() }}</h6>
                            <span>Applications</span>
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
                            <h6 class="h6 fw-semibold mb-0">{{ $user->profile->saved_candidates->count() }}</h6>
                            <span>Candidates</span>
                        </div>
                        <div class="d-flex flex-row justify-content-center align-items-center">
                            <img src="{{ asset('icons/svgs/solid/suitcase.svg') }}" class="bg-body-secondary img-thumbnail"
                                style="color: var(--bs-primary)" width="50" alt="">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    {{-- @endif --}}
@endsection
