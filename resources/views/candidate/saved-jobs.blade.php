@extends('candidate.layout')
@section('content')
    @php
        $user = auth('candidate')->user();
    @endphp
    <div class="container mt-3">
        <div class="overview-container">
            @if (!$user->isEmailVerified())
                <div class="alert alert-warning" role="alert">
                    <strong>Email not verified: </strong> To be able to setup your account, you need to verify your email.
                    <button class="btn btn-sm">resend verification link</button>
                </div>
            @endif
            @if (!$user->candidate?->isProfileCompleted())
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Profile Setup!</strong> Your profile setup is not completed yet.
                </div>
            @endif
            <h5 class="h5 text-uppercase fw-semibold">
                saved jobs
            </h5>
            <h6 class="h6 text-capitalize">My Jobs ({{ $user->candidate?->savedJobs->count() ?? 0 }})</h6>
            <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
            @session('success')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Success!</strong> Job has been removed from favourites list
            </div>
            @endif
            @isset($user->candidate->savedJobs)
                @foreach ($user->candidate?->savedJobs as $saved_job)
                    <div class="row shadow-2 p-2 rounded-2 mt-2">
                        <div class="d-flex flex-row flex-wrap justify-content-between">
                            <div class="d-flex flex-wrap">
                                <img class="d-flex justify-content-center align-items-center"
                                    src="{{ $saved_job->job->company->image->logo_image ?? asset('icons/avatar-png.png') }}"
                                    width="55" height="55" alt="">
                                <div class="d-flex flex-column ms-sm-3">
                                    <ul class="list-unstyled mb-0">
                                        <li class="py-0 text-uppercase d-flex align-items-center">
                                            <strong>
                                                {{ $saved_job->job->title }}
                                            </strong>
                                            <span
                                                class="btn btn-secondary text-nowrap px-2 py-1 ms-2">{{ $saved_job->job->type }}</span>
                                        </li>
                                        <li class="py-0 text-capitalize fw-semibold text-primary">
                                            @ {{ $saved_job->job->company->company_name }}
                                            <i class="fas fa-map-marker-alt ms-1"></i>
                                            {{ $saved_job->job->company->company_location }}
                                        </li>
                                        <li class="py-0 text-truncate d-flex flex-row align-items-center">
                                            <span class="text-capitalize me-2">
                                                salary range GHS
                                                {{ number_format($saved_job->job->min_salary, 2) . ' - ' . number_format($saved_job->job->max_salary, 2) }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center justify-content-end">
                                <button data-job-id="{{ $saved_job->job_id }}" type="button" title="Remove from favorites"
                                    class="btn btn-secondary px-3 unsave-job me-2 me-md-2">
                                    <i class="fas fa-heart user-select-none"></i>
                                </button>
                                @if ($saved_job->job->isAppliedByUser())
                                    <button type="button" disabled class="btn btn-primary rounded-0 text-nowrap px-2 px-md-4"
                                        title="click to apply for this job">
                                        <span>
                                            applied
                                        </span>
                                        <i class="fas fa-check-double ms-2"></i>
                                    </button>
                                @else
                                    <button type="button" data-is_login="{{ auth('candidate')->check() ? 1 : 0 }}"
                                        id="apply-job" class="btn btn-primary rounded-0 apply-job text-nowrap px-2 px-md-4"
                                        title="click to apply for this job" data-job-id="{{ $saved_job->job_id }}">
                                        <span>
                                            apply
                                        </span>
                                        <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
    @include('modals.apply-job')
@endsection
