@extends('layout.app-layout')
@section('content')
    <style>
        .icon.fas {
            color: var(--bs-success) !important;
        }
    </style>
    @use(Carbon\Carbon)
    <!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
    <div class="container">
        <div class="row shadow-1 my-3 pb-2">
            <div class="col-lg-6 col-sm-6 d-flex flex-row g-3">
                <div class="d-flex flex-row justify-content-start  mt-3">
                    <img src="{{ $job->company->image->logo_image }}" height="65" width="65" alt="company-logo"
                        class="img-thumbnail flex-col me-2">
                    <div class="col-auto d-flex flex-column justify-content-end align-items-baseline">
                        <h6 class="h5 fw-semibold text-capitalize text-truncate text-success">
                            {{ strtoupper($job->title) }}
                        </h6>
                        <div class="col-auto d-flex flex-row align-items-center align-middle">
                            {{-- <i class="icon fas fa-map-marker-alt"></i> --}}
                            <h6 class="text-truncate fw-semibold text-capitalize mb-0">
                                <a href="{{ route('company.show', $job->company->id) }}" class="link-dark nav-link">
                                    {{ $job->company->company_name }}
                                </a>
                            </h6>
                            <span
                                class="btn btn-success cursor-default shadow-0 text-nowrap px-2 py-1 ms-2">{{ $job->type }}</span>
                        </div>
                    </div>

                </div>
            </div>
            <div
                class="col-lg-6 col-sm-6 d-flex flex-row align-items-center justify-content-start justify-content-sm-end g-3">
                @auth('candidate')
                    <button class="btn btn-secondary px-3 py-2 me-2 rounded-1 btn-lg bookmark user-select-none"
                        data-job-id="{{ $job->id }}"
                        title="{{ $job->isSavedByUser() ? 'Remove from favourites' : 'Add to favourites' }}">
                        <i class="{{ $job->isSavedByUser() ? 'fas' : 'far' }} fa-heart user-select-none"></i>
                    </button>
                    @if ($job->isAppliedByUser())
                        <button type="button" disabled class="btn btn-primary rounded-0" title="click to apply for this job">
                            <span>
                                applied
                            </span>
                            <i class="fas fa-check-double ms-2"></i>
                        </button>
                    @else
                        <button type="button" data-is_login="{{ auth('candidate')->check() ? 1 : 0 }}" id="apply-job"
                            class="btn btn-primary rounded-0 apply-job" title="click to apply for this job"
                            data-job-id="{{ $job->id }}">
                            <span>
                                apply
                            </span>
                            <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    @endif
                @endauth
            </div>
            <div class="container my-2">
                <div class="d-flex flex-row align-items-center flex-wrap">
                    @forelse ($job->tags as $tag)
                        <span class="btn btn-sm btn-secondary px-2 py-0 mx-1 my-1">
                            {{ $tag->name }}
                        </span>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-7 col-lg-7 order-sm-1 order-2 mt-sm-0 mt-4">
            <h6 class="h6 fw-bold text-capitalize">
                job description
            </h6>
            <div id="job-description">
                {!! $job->description !!}
            </div>
            <h6 class="h6 fw-bold text-capitalize mt-3">
                job requirements
            </h6>
            {!! $job->requirements !!}
            <h6 class="h6 fw-bold text-capitalize mt-3">
                job benefits
            </h6>
            {!! $job->benefits !!}
        </div>
        <div class="col-sm-5 col-lg-5 order-sm-2 order-1">
            <div class="container">
                <div class="row  shadow-2 p-3 border-primary">
                    <div class="col-12">
                        <div class="d-flex flex-column align-items-center ">
                            <h6 class="fw-semibold">Salary (GHS)</h6>
                            <h6>
                                <span class="btn btn-outline-success cursor-default shadow-0 text-nowrap px-2 py-1">
                                    {{ 'GHS ' . number_format($job->min_salary, 2, '.', ',') }} -
                                    {{ number_format($job->max_salary, 2, '.', ',') }}
                                </span>
                            </h6>
                            <h6 class="text-muted text-lead">{{ $job->salary->type }} salary</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid  shadow-2 p-3 mt-4">
                <div class="col-12">
                    <div class="row">
                        <h6 class="h6 fw-bold text-capitalize">
                            job overview
                        </h6>
                        <div class="col-6 col-sm-6 gy-3">
                            <div class="d-flex flex-column align-items-start align-middle">
                                <i class="icon fas fa-calendar-alt"></i>
                                <span class="fw-lighter text-capitalize" style="font-size: 12px;">
                                    date posted:
                                </span>
                                <h6 class="h6 mb-0  text-black">
                                    {{ Carbon::parse($job->created_at)->format('d M Y') }}
                                </h6>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 gy-3">
                            <div class="d-flex flex-column align-items-start align-middle">
                                <i class="icon fas fa-layer-group"></i>
                                <span class="fw-lighter text-capitalize" style="font-size: 12px;">
                                    entry level:
                                </span>
                                <h6 class="h6 mb-0  text-black text-capitalize">
                                    {{ $job->job_experience->level }}
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-sm-6 gy-3">
                            <div class="d-flex flex-column align-items-start align-middle">
                                <i class="icon fas fa-gear"></i>
                                <span class="fw-lighter text-capitalize" style="font-size: 12px;">
                                    experience:
                                </span>
                                <h6 class="h6 mb-0  text-black text-capitalize">
                                    {{ $job->job_experience->level }}
                                </h6>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 gy-3">
                            <div class="d-flex flex-column align-items-start align-middle">
                                <i class="icon fas fa-graduation-cap"></i>
                                <span class="fw-lighter text-capitalize" style="font-size: 12px;">
                                    education:
                                </span>
                                <h6 class="h6 mb-0  text-black text-capitalize">
                                    {{ $job->education->level }}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row shadow-2 p-3 mt-4">
                    <h6 class="h6 fw-bold">
                        Share this Job:
                    </h6>
                    <div class="col-12">
                        <ul class="list-unstyled d-flex">
                            <li>
                                <button class="btn btn-sm btn-secondary m-1 copy-url" title="copy url"
                                    data-url="{{ request()->fullUrl() }}">
                                    <i class="fa-regular fa-copy"></i> Copy Link
                                </button>
                            </li>
                            <li>
                                <button class="btn btn-sm btn-secondary m-1 share-to-whatsapp" title="share on whatsapp"
                                    data-url="{{ request()->fullUrl() }}">
                                    <i class="fab fa-whatsapp"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modals.apply-job')
@endsection
