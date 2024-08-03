@extends('candidate.layout')
@section('content')
    @php
        $user = auth('candidate')->user();
        $applied_jobs = $user->profile->job_applications;
    @endphp
    @use(Carbon\Carbon)
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
                        {{-- <div class="d-flex flex-column justify-content-center">
                            <h6 class="h6 fw-semibold mb-0">{{ $user->profile->job_applications->count() }}</h6>
                            <span>Applied jobs</span>
                        </div>
                        <div class="d-flex flex-row justify-content-center align-items-center">
                            <img src="{{ asset('icons/svgs/solid/suitcase.svg') }}" class="bg-body-secondary img-thumbnail"
                                style="color: var(--bs-primary)" width="50" alt="">
                        </div> --}}
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
                        @forelse ($applied_jobs as $j)
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
