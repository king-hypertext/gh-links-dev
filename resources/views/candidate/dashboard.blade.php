@extends('candidate.layout')
@section('content')
    @php
        $user = auth('candidate')->user();
        $applied_jobs = $user->candidate?->jobApplications;
    @endphp
    @use(Carbon\Carbon)
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
            <h5 class="h6 text-capitalize fw-semibold">
                hello, {{ $user->candidate?->full_name ?? $user->username }}
            </h5>
            <p class="text-lead text-muted">
                Here is your dashboard overview
            </p>
            <div class="card-group">
                <div class="card mx-md-3">
                    <div class="card-body d-flex flex-row justify-content-between flex-nowrap">
                        <div class="d-flex flex-column justify-content-center">
                            <span class="fw-semibold fs-5 text-capitalize">Applied jobs</span>
                        </div>
                        <div class="d-flex flex-row justify-content-center align-items-center">
                            <h6 class="fs-4 fw-semibold mb-0">{{ $user->candidate?->jobApplications->count() ?? 0 }}</h6>
                        </div>
                    </div>
                </div>
                <div class="card mx-md-3">
                    <div class="card-body d-flex flex-row justify-content-between flex-nowrap">
                        <div class="d-flex flex-column justify-content-center">
                            <span class="fw-semibold fs-5 text-capitalize">favourite jobs</span>
                        </div>
                        <div class="d-flex flex-row justify-content-center align-items-center">
                            <h6 class="fs-4 fw-semibold mb-0">{{ $user->candidate?->savedJobs->count() ?? 0 }}</h6>
                        </div>
                    </div>
                </div>
                <div
                    class="card mx-md-3 {{ $user->candidate?->profileCompletion() == '100%' ? 'bg-secondary text-white rounded-start-2' : '' }}">
                    <div class="card-body d-flex flex-row justify-content-between flex-nowrap">
                        <div class="d-flex flex-column justify-content-center">
                            <span class="fw-semibold fs-5 text-capitalize">Profile Completion</span>
                        </div>
                        <div class="d-flex flex-row justify-content-center align-items-center">
                            <h6 class="fs-4 fw-semibold mb-0">{{ $user->candidate?->profileCompletion() ?? '0%' }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive my-4">
                <div class="d-flex justify-content-between">
                    <h5 class="h6 text-capitalize mb-0" style="line-height: normal;">
                        recently applied jobs
                    </h5>
                    <a href="{{ route('candidate.application.index') }}" class="text-capitalize">view all
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <table class="table align-middle">
                    <thead class="table-secondary">
                        <tr class="text-uppercase">
                            <th scope="col" class="py-1">job</th>
                            <th scope="col" class="py-1">date applied</th>
                            <th scope="col" class="py-1">status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($appliedJobs)
                            @forelse ($appliedJobs as $j)
                                <tr class="">
                                    <td scope="row">
                                        <div class="d-flex flex-wrap">
                                            <img src="{{ $j->job->company->image->logo_image ?? asset('icons/avatar-png.png') }}"
                                                width="55" height="55" alt="">
                                            <div class="d-flex flex-column ms-sm-3">
                                                <ul class="list-unstyled mb-0">
                                                    <li class="py-0 text-uppercase d-flex align-items-center">
                                                        <strong>
                                                            {{ $j->job->title }}
                                                        </strong>
                                                        <span
                                                            class="btn btn-secondary text-nowrap px-2 py-1 ms-2">{{ $j->job->type }}</span>
                                                    </li>
                                                    <li class="py-0 text-capitalize fw-semibold text-primary">
                                                        @ {{ $j->job->company->company_name }}
                                                        <i class="fas fa-map-marker-alt ms-1"></i>
                                                        {{ $j->job->company->company_location }}
                                                    </li>
                                                    <li class="py-0 text-truncate d-flex flex-row flex-wrap align-items-center">
                                                        <span class="text-capitalize me-2">GHS
                                                            {{ number_format($j->job->min_salary, 2) . ' - ' . number_format($j->job->max_salary, 2) }}
                                                            / {{ $j->job->salary->type }}
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ Carbon::parse($j->created_at)->format('l, M d, Y H:iA') }}
                                    </td>
                                    <td>
                                        @if ($j->approved == 0)
                                            <button class="btn btn-outline-secondary"
                                                title="Your application is sent, waiting for approval">pending</button>
                                        @else
                                            <button class="btn btn-outline-secondary"
                                                title="Your application is accepted and approved">approved</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
