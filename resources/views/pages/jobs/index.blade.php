@extends('layout.app-layout')
@section('content')
    <div>
        <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
    </div>
    <style>
        .form-group .input-group-icon-left-align i {
            color: var(--mdb-info);
        }

        .form-group .form-control {
            border-radius: 0 !important;
        }

        .form-group .form-control:focus,
        .form-group .form-control:active {
            border: 0 !important;
            outline: 0 !important;
        }
    </style>
    @use(Carbon\Carbon)
    <div class="row shadow-2 mb-4 rounded-0 bg-secondary body-picture-bg bg:transparent-dark">
        <form class="form-search">
            <div class="card-body p-1">
                <div class="row  search-row">
                    <div class="col-sm-3 gy-2 gy-md-0 col-lg-3">
                        <div class="form-group" data-mdb-input-init>
                            <span class="input-group-icon-left-align">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                            <input placeholder="Search by: job title, position..." style="padding-left: 40px;" type="text"
                                name="job_title" class="form-control" id="job_title">
                        </div>
                    </div>
                    <div class="col-sm-3 gy-2 gy-md-0 col-lg-3">
                        <div class="form-group" data-mdb-input-init>
                            <span class="input-group-icon-left-align">
                                <i class="fa-solid fa-location-crosshairs"></i>
                            </span>
                            <input placeholder="Capital, district, town..." style="padding-left: 40px;" type="text"
                                name="location" class="form-control" id="location">
                        </div>
                    </div>
                    <div class="col-sm-3 gy-2 gy-md-0 col-lg-3">
                        <div class="form-group" data-mdb-input-init>
                            <span class="input-group-icon-left-align">
                                <i class="fa-solid fa-business-time"></i>
                            </span>
                            <input placeholder="Select job type" style="padding-left: 40px;" type="text" name="job_type"
                                class="form-control" id="job_type">
                        </div>
                    </div>
                    <div class="col-sm-3 gy-2 gy-md-0 col-lg-3">
                        <div class="form-group" data-mdb-input-init>
                            <span class="input-group-icon-left-align">
                                <i class="fw-light fst-normal fa-sm">GHS</i>
                            </span>
                            <input placeholder="Minimun salary" style="padding-left: 45px;" type="number" min="1"
                                max="500000" maxlength="6" name="min_salary" class="form-control" id="min-salary">
                        </div>
                    </div>
                </div>
                <div class="row flex-row justify-content-end">
                    <div class="col-sm-12 gy-2 col-lg-2">
                        <button type="submit" class="btn btn-info rounded-0">
                            <i class="me-2 fas fa-magnifying-glass"></i>
                            <span>search job</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row my-4 px-0">
        @if ($search)
            <h6 class="h6 fw-bold text-capitalize">
                Search results <span class="text-lowercase fw-normal">(found {{ $jobs->count() }}
                    job{{ $jobs->count() > 1 ? 's' : '' }} )</span>
            </h6>
        @endif
        @forelse ($jobs as $i => $job)
            <div class="col-sm-6 col-lg-4">
                <div class="card my-2 mx-md-0 user-select-none cursor-pointer job-card"
                    data-target-url="{{ route('jobs.show', [$job->id]) }}">
                    <div class="card-body">
                        <div class="d-flex flex-row align-items-center">
                            <div class="col-10 flex flex-row justify-start align-items-center">
                                <h5 class="card-title h6 fw-bold text-uppercase text-truncate">
                                    {{ $job->title }}
                                </h5>
                            </div>
                            <div class="col-2 d-flex flex-row justify-content-center align-items-center">
                                @auth('candidate')
                                    <button class="btn btn-secondary px-2 py-1 rounded-1 btn-lg bookmark user-select-none"
                                        data-job-id="{{ $job->id }}" title="bookmark">
                                        <i class="{{ $job->isSavedByUser() ? 'fas' : 'far' }} fa-heart user-select-none"></i>
                                    </button>
                                @endauth
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-start align-items-center ">
                            <div class="col-4">
                                <span class="btn btn-outline-success text-nowrap px-2 py-0">{{ $job->type }}</span>
                            </div>
                            <span class="fw-normal text-truncate">
                                {{ 'GHS ' . number_format($job->min_salary, 2) }} / {{ $job->salary->type }}
                            </span>
                        </div>
                        <div class="d-flex flex-row justify-center align-items-center flex-wrap">
                            <div class="col-auto d-flex justify-content-start align-items-center">
                                <h6 class="h6 fw-semibold text-capitalize text-truncate mb-0">
                                    @ {{ $job->company?->company_name }}
                                </h6>
                                <span class="flex-nowrap text-nowrap text-truncate text-capitalize ms-2">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $job->city?->name }}
                                </span>
                            </div>
                        </div>
                        <div class="tag-container pb-2">
                            <div class="d-flex flex-row align-items-center flex-wrap overflow-hidden">
                                @forelse ($job->tags as $tag)
                                    <span class="btn btn-sm btn-secondary px-2 py-0 mx-1 my-1">
                                        {{ $tag->name }}
                                    </span>
                                @empty
                                @endforelse
                            </div>
                            <span class="btn btn-sm btn-secondary px-2 py-0 mx-1 my-1">
                                {{ $job->job_experience->level }}
                            </span>
                        </div>
                        <div class="d-flex flex-row align-items-center justify-content-between" style="font-size: 12px;">
                            <div class="col-auto">
                                <i class="far fa-calendar-alt me-2"></i>
                                {{ Carbon::parse($job->created_at)->longRelativeDiffForHuman() }}
                            </div>
                            <div class="col-auto">
                                Applications:
                                {{ $job->applications->count() ?? 0 }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <h4>No job found.</h4>
            </div>
        @endforelse
    </div>
    @if ($jobs->isNotEmpty())
        <div class="row my-4">
            <div class="col-12 text-center">
                @if ($jobs->currentPage() > 1)
                    <a class="btn-floating btn btn-sm btn-secondary rounded"
                        href="{{ url('jobs?page=' . ($jobs->currentPage() - 1)) }}" title="previous page">
                        <i class="fas fa-angle-left"></i>
                    </a>
                @endif
                <span class="mx-2">Page <span
                        class="px-2 py-1 text-bg-primary rounded-1">{{ $jobs->currentPage() }}</span> of
                    {{ $jobs->lastPage() }}</span>
                @if ($jobs->currentPage() < $jobs->lastPage())
                    <a class="btn-floating btn btn-sm btn-secondary rounded"
                        href="{{ url('jobs?page=' . ($jobs->currentPage() + 1)) }}" title="next page">
                        <i class="fas fa-angle-right"></i>
                    </a>
                @endif
            </div>
        </div>
    @endif
    @if ($search)
        <div class="row my-4">
            <h6 class="h4 fw-bold text-capitalize">
                related jobs
            </h6>
            @foreach ($related_jobs as $job)
                <div class="col-sm-6 col-lg-4">
                    <div class="card my-2 mx-md-0 user-select-none cursor-pointer job-card"
                        data-target-url="{{ route('jobs.show', [$job->id]) }}">
                        <div class="card-body">
                            <div class="d-flex flex-row align-items-center">
                                <div class="col-10 flex flex-row justify-start align-items-center">
                                    <h5 class="card-title h6 fw-bold text-uppercase text-truncate">
                                        {{ $job->title }}
                                    </h5>
                                </div>
                                <div class="col-2 d-flex flex-row justify-content-center align-items-center">
                                    @auth('candidate')
                                        <button class="btn btn-secondary px-2 py-1 rounded-1 btn-lg bookmark user-select-none"
                                            data-job-id="{{ $job->id }}" title="bookmark">
                                            <i
                                                class="{{ $job->isSavedByUser() ? 'fas' : 'far' }} fa-heart user-select-none"></i>
                                        </button>
                                    @endauth
                                </div>
                            </div>
                            <div class="d-flex flex-row justify-start align-items-center">
                                <div class="col-4">
                                    <span class="btn btn-outline-success text-nowrap px-2 py-0">{{ $job->type }}</span>
                                </div>
                                <div class="col-8">
                                    {{ 'GHS ' . number_format($job->min_salary, 2) }} / {{ $job->salary->type }}
                                    <span class="fw-bold text-capitalize"></span>
                                </div>
                            </div>
                            <div class="d-flex flex-row justify-center align-items-center ">
                                <div class="col-auto d-flex justify-content-start align-items-center">
                                    <h6 class="h6 fw-semibold text-capitalize text-truncate mb-0">
                                        @ {{ $job->company?->company_name }}
                                    </h6>
                                    <span class="flex-nowrap text-nowrap text-truncate text-capitalize ms-2">
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        {{ $job->city?->name }}
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center flex-wrap">
                                @forelse ($job->tags as $tag)
                                    <span class="btn btn-sm btn-secondary px-2 py-0 mx-1 my-1">
                                        {{ $tag->name }}
                                    </span>
                                @empty
                                @endforelse
                            </div>
                            <span class="btn btn-sm btn-secondary px-2 py-0 mx-1 my-1">
                                {{ $job->job_experience->level }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
