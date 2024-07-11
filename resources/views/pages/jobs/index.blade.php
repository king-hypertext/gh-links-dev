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
    <div class="row shadow-2 my-4 rounded-0 bg-secondary">
        <form class="form-horizontal">
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
                        <input placeholder="Select job type" style="padding-left: 40px;" type="text"
                            name="job_type" class="form-control" id="job_type">
                    </div>
                </div>
                <div class="col-sm-3 gy-2 gy-md-0 col-lg-3">
                    <div class="form-group" data-mdb-input-init>
                        <span class="input-group-icon-left-align">
                            <i class="fw-light fst-normal fa-sm">GHS</i>
                        </span>
                        <input placeholder="Minimun salary" style="padding-left: 45px;" type="number" min="1" max="500000" maxlength="6"
                            name="min-salary" class="form-control" id="min-salary">
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
                            <span>salary:</span> $100,000
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
                            <button class="btn btn-secondary px-2 py-1 rounded-1 btn-lg bookmark" title="bookmark">
                                <i class="far fa-bookmark"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
