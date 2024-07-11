@extends('layout.app-layout')
@section('content')
    <div class="row body-picture-bg bg:transparent-dark p-2 p-md-5 text-white">
        <h1 class="fw-bold my-3 text-capitalize fs-2">your easiest way to get your new job</h1>
        <h2 class="h6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, magni odit repellendus
            molestias
            ipsam aliquid quasi pariatur? Voluptate, incidunt porro veritatis obcaecati enim officia tenetur nam similique
            veniam modi vel?
        </h2>
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
        <div class="card shadow-2 my-4 rounded-0">
            {{-- <form id="search-job" action="/jobs"> --}}
                <div class="card-body p-1">
                    <div class="row flex-row justify-content-center justify-content-lg-between search-row">
                        <div class="col-sm-6 gy-2 gy-md-0 col-lg-5">
                            <div class="form-group" data-mdb-input-init>
                                <span class="input-group-icon-left-align">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <input placeholder="Search by: job title, position..." style="padding-left: 40px;"
                                    type="text" name="job_title" class="form-control" id="search-job-job_title">
                            </div>
                        </div>
                        <div class="col-sm-6 gy-2 gy-md-0 col-lg-5">
                            <div class="form-group" data-mdb-input-init>
                                <span class="input-group-icon-left-align">
                                    <i class="fa-solid fa-location-crosshairs"></i>
                                </span>
                                <input placeholder="Capital, district, town..." style="padding-left: 40px;" type="text"
                                    name="location" class="form-control" id="search-job-location">
                            </div>
                        </div>
                        <div class="col-sm-12 gy-2 gy-md-0 col-lg-2">
                            <button type="button" id="search-job" class="btn btn-info rounded-0 text-nowrap float-end">
                                <i class="me-2 fas fa-magnifying-glass"></i>
                                <span>search</span>
                            </button>
                        </div>
                    </div>
                </div>
            {{-- </form> --}}
        </div>
    </div>
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col-sm-4 gy-4 gx-md-0">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 d-flex align-items-center">
                                <i class="fa-solid fa-briefcase fa-2xl"></i>
                            </div>
                            <div class="col-8">
                                <h3 class="card-title">2,367</h3>
                                <p class="card-text">Live Jobs</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 gy-4 gx-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 d-flex align-items-center">
                                <i class="fa-solid fa-arrow-right-to-city fa-2xl"></i>
                            </div>
                            <div class="col-8">
                                <h3 class="card-title">1,394</h3>
                                <p class="card-text text-capitalize">companies</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 gy-4 gx-md-0">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 d-flex align-items-center">
                                <i class="fas fa-user-group fa-2xl"></i>
                            </div>
                            <div class="col-8">
                                <h3 class="card-title">12,833</h3>
                                <p class="card-text text-capitalize">candidates</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- how gh-links work --}}
    <div class="d-flex justify-content-center justify-content-sm-start">
        <h5 class="h5 text-uppercase fw-bold fs-3 text-info">how gh-links work</h5>
    </div>
    <div class="row bg-secondary">
        <div class="col-sm-3 gy-3">
            <div class="card shadow-2">
                <div style="height: 225px;!important" class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mt-4 justify-content-center">
                        <i class="fas text-primary fa-user-plus bg-body-secondary py-4 px-3 rounded-circle fa-lg"></i>
                    </div>
                    <div class="pt-3 text-center">
                        <h4 class="card-title fw-bold fs-6">Create an Account</h4>
                    </div>
                    <p class="card-text text-monospace" title="">
                        Firstly, you need to create a new account.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-3 gy-3">
            <div class="card shadow-2">
                <div style="height: 225px;!important" class="card-body">
                    <div class="d-flex align-items-center mt-4 justify-content-center">
                        <i class="fas fa-cloud-upload bg-body-secondary py-4 px-3 rounded-circle fa-lg"></i>
                    </div>
                    <div class="pt-3 text-center">
                        <h4 class="card-title fw-bold fs-6">Upload CV/Resume</h4>
                    </div>
                    <p class="card-text text-monospace" title="">
                        Then, prepare your CV or Resume and upload it
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-3 gy-3">
            <div class="card shadow-2">
                <div style="height: 225px;!important" class="card-body">
                    <div class="d-flex align-items-center mt-4 justify-content-center">
                        <i class="fas fa-search-plus bg-body-secondary py-4 px-3 rounded-circle fa-lg"></i>
                    </div>
                    <div class="pt-3 text-center">
                        <h4 class="card-title fw-bold fs-6 text-primary-emphasis">Find Suitable Job</h4>
                    </div>
                    <p class="card-text text-monospace" title="">
                        Search for your preferred job
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-3 gy-3">
            <div class="card shadow-2">
                <div style="height: 225px;!important" class="card-body">
                    <div class="d-flex align-items-center mt-4 justify-content-center">
                        <i class="fa-regular fa-circle-check bg-body-secondary py-4 px-3 rounded-circle fa-lg"></i>
                    </div>
                    <div class="pt-3 text-center">
                        <h4 class="card-title fw-bold fs-6">Apply for Job</h4>
                    </div>
                    <p class="card-text">
                        Gotten your prefferred job? Apply for it.
                    </p>
                </div>
            </div>
        </div>
        <div class="gy-3"></div>
    </div>
    {{-- featured jobs --}}
    <div class="row my-4">
        <div class="d-flex justify-content-center justify-content-sm-start">
            <h5 class="h5 text-uppercase fw-bold fs-3 text-info">featured jobs</h5>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card my-2 mx-md-0 user-select-none cursor-pointer job-card" data-target-id="1"
                data-target-url="{{ route('jobs.show', [1]) }}">
                <div class="card-body">
                    <div class="flex justify-start align-items-center">
                        <h5 class="card-title fw-bold text-capitalize text-truncate">
                            google inc. job title
                        </h5>
                    </div>
                    <div class="d-flex flex-row justify-start align-items-center">
                        <div class="col-4">
                            <span class="btn btn-outline-success text-nowrap px-2 py-1">full time</span>
                        </div>
                        <div class="col-8">
                            <span class="fw-bold">salary:</span> GHS 100,000
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-center align-items-center mt-3">
                        <div class="col-3">
                            <img src="{{ asset('company-logo.svg') }}" height="55" width="55" alt="company-logo"
                                class="img-thumbnail img-circle">
                        </div>
                        <div class="col-8  flex-column align-items-center justify-center">
                            <div class="col-auto">
                                <h6 class="h6 fw-semibold text-capitalize text-truncate">
                                    Amali-Tech.
                                </h6>
                            </div>
                            <div class="col-auto d-flex justify-content-start align-items-center">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <span class="flex-nowrap text-nowrap text-truncate text-capitalize">accra, ghana</span>
                            </div>
                        </div>
                        <div class="col-1 d-flex flex-row justify-content-center align-items-center">
                            <button {{ auth('candidate')->check() ? '' : 'disabled' }}
                                class="btn btn-secondary px-2 py-1 rounded-1 btn-lg bookmark" title="bookmark">
                                <i class="far fa-bookmark"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card my-2 mx-md-0 user-select-none cursor-pointer job-card" data-job-id="1"
                data-job-url="{{ route('jobs.show', [1]) }}">
                <div class="card-body">
                    <div class="flex justify-start align-items-center">
                        <h5 class="card-title fw-bold text-capitalize text-truncate">
                            google inc. job title
                        </h5>
                    </div>
                    <div class="d-flex flex-row justify-start align-items-center">
                        <div class="col-4">
                            <span class="btn btn-outline-success text-nowrap px-2 py-1">full time</span>
                        </div>
                        <div class="col-8">
                            <span class="fw-bold">salary:</span> GHS 100,000
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-center align-items-center mt-3">
                        <div class="col-3">
                            <img src="{{ asset('company-logo.svg') }}" height="55" width="55" alt="company-logo"
                                class="img-thumbnail img-circle">
                        </div>
                        <div class="col-8  flex-column align-items-center justify-center">
                            <div class="col-auto">
                                <h6 class="h6 fw-semibold text-capitalize text-truncate">
                                    Amali-Tech.
                                </h6>
                            </div>
                            <div class="col-auto d-flex justify-content-start align-items-center">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <span class="flex-nowrap text-nowrap text-truncate text-capitalize">accra, ghana</span>
                            </div>
                        </div>
                        <div class="col-1 d-flex flex-row justify-content-center align-items-center">
                            <button {{ auth('candidate')->check() ? '' : 'disabled' }}
                                class="btn btn-secondary px-2 py-1 rounded-1 btn-lg bookmark" title="bookmark">
                                <i class="far fa-bookmark"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card my-2 mx-md-0 user-select-none cursor-pointer job-card" data-target-id="1"
                data-target-url="{{ route('jobs.show', [1]) }}">
                <div class="card-body">
                    <div class="flex justify-start align-items-center">
                        <h5 class="card-title fw-bold text-capitalize text-truncate">
                            google inc. job title
                        </h5>
                    </div>
                    <div class="d-flex flex-row justify-start align-items-center">
                        <div class="col-4">
                            <span class="btn btn-outline-success text-nowrap px-2 py-1">full time</span>
                        </div>
                        <div class="col-8">
                            <span class="fw-bold">salary:</span> GHS 100,000
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-center align-items-center mt-3">
                        <div class="col-3">
                            <img src="{{ asset('company-logo.svg') }}" height="55" width="55" alt="company-logo"
                                class="img-thumbnail img-circle">
                        </div>
                        <div class="col-8  flex-column align-items-center justify-center">
                            <div class="col-auto">
                                <h6 class="h6 fw-semibold text-capitalize text-truncate">
                                    Amali-Tech.
                                </h6>
                            </div>
                            <div class="col-auto d-flex justify-content-start align-items-center">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <span class="flex-nowrap text-nowrap text-truncate text-capitalize">accra, ghana</span>
                            </div>
                        </div>
                        <div class="col-1 d-flex flex-row justify-content-center align-items-center">
                            <button {{ auth('candidate')->check() ? '' : 'disabled' }}
                                class="btn btn-secondary px-2 py-1 rounded-1 btn-lg bookmark" title="bookmark">
                                <i class="far fa-bookmark"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-4">
        <div class="d-flex justify-content-center justify-content-sm-start">
            <h5 class="h5 text-uppercase fw-bold fs-3 text-info">Top Companies</h5>
        </div>
        <div class="col-sm-4">
            <div class="card shadow-2 my-2 mx-md-0 user-select-none job-card">
                <div class="card-body">
                    <div class="d-flex flex-row justify-center align-items-center mt-3">
                        <div class="col-3">
                            <img src="{{ asset('company-logo.svg') }}" height="55" width="55" alt="company-logo"
                                class="img-thumbnail img-circle">
                        </div>
                        <div class="col-8  flex-column align-items-center justify-center">
                            <div class="col-auto">
                                <h6 class="h6 fw-semibold text-capitalize text-truncate">
                                    Amali-Tech.
                                </h6>
                            </div>
                            <div class="col-auto d-flex justify-content-start align-items-center">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <span class="flex-nowrap text-nowrap text-truncate text-capitalize">accra, ghana</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-2">
                        <button type="button" onclick="window.open(this.id, '_blank')"
                            id="{{ route('company.show', [1]) }}" class="btn btn-secondary text-capitalize">
                            open positions (2)
                        </button>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card shadow-2 my-2 mx-md-0 user-select-none job-card">
                <div class="card-body">
                    <div class="d-flex flex-row justify-center align-items-center mt-3">
                        <div class="col-3">
                            <img src="{{ asset('company-logo.svg') }}" height="55" width="55" alt="company-logo"
                                class="img-thumbnail img-circle">
                        </div>
                        <div class="col-8  flex-column align-items-center justify-center">
                            <div class="col-auto">
                                <h6 class="h6 fw-semibold text-capitalize text-truncate">
                                    Amali-Tech.
                                </h6>
                            </div>
                            <div class="col-auto d-flex justify-content-start align-items-center">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <span class="flex-nowrap text-nowrap text-truncate text-capitalize">accra, ghana</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-2">
                        <button type="button" onclick="window.open(this.id, '_blank')"
                            id="{{ route('company.show', [1]) }}" class="btn btn-secondary text-capitalize">
                            open positions (2)
                        </button>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card shadow-2 my-2 mx-md-0 user-select-none job-card">
                <div class="card-body">
                    <div class="d-flex flex-row justify-center align-items-center mt-3">
                        <div class="col-3">
                            <img src="{{ asset('company-logo.svg') }}" height="55" width="55" alt="company-logo"
                                class="img-thumbnail img-circle">
                        </div>
                        <div class="col-8  flex-column align-items-center justify-center">
                            <div class="col-auto">
                                <h6 class="h6 fw-semibold text-capitalize text-truncate">
                                    Amali-Tech.
                                </h6>
                            </div>
                            <div class="col-auto d-flex justify-content-start align-items-center">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <span class="flex-nowrap text-nowrap text-truncate text-capitalize">accra, ghana</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-2">
                        <button type="button" onclick="window.open(this.id, '_blank')"
                            id="{{ route('company.show', [1]) }}" class="btn btn-secondary text-capitalize">
                            open positions (2)
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
