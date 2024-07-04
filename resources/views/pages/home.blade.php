@extends('layout.app-layout')
@section('content')
    <div class="container-flui body-picture-bg p-2 p-md-5 text-white">
        <h1 class="fw-bold my-3 text-capitalize fs-2">your easiest way to get your new job</h1>
        <h6 class="h6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, magni odit repellendus
            molestias
            ipsam aliquid quasi pariatur? Voluptate, incidunt porro veritatis obcaecati enim officia tenetur nam similique
            veniam modi vel?</h6>
        <div class="row my-5">
            <div class="col-sm-8">
                <div class="card shadow-1-primary" style="">
                    <form action="/jobs" method="GET">
                        <div class="card-body my-1">
                            <div class="row">
                                <div class="col-sm-4 g-3">
                                    <div class="form-outline" data-mdb-input-init>
                                        <input required type="text" class="form-control" name="job_title"
                                            id="job_title" />
                                        <label class="form-label" for="job_title">Job Title</label>
                                    </div>
                                </div>
                                <div class="col-sm-4 g-3">
                                    <div class="form-outline" data-mdb-input-init>
                                        <input required type="text" class="form-control" name="job_location"
                                            id="job_location" />
                                        <label class="form-label" for="job_location">Job Location</label>
                                    </div>
                                </div>
                                <div class="col-sm-4 g-3">
                                    <div class="d-sm-flex">
                                        <button type="submit" class="btn btn-primary text-capitalize">
                                            <span class="fas fa-search me-2"></span>
                                            find job
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row my-5">
            <div class="col-sm-4 g-3">
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
            <div class="col-sm-4 g-3">
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
            <div class="col-sm-4 g-3">
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

        <div class="row my-5">
            <div class="d-flex justify-content-center justify-content-sm-start">
                <h5 class="h5 text-uppercase fw-bold fs-3">how gh-links work</h5>
            </div>
            <div class="col-sm-3 g-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex align-items-center mt-4 justify-content-center">
                                <i
                                    class="fas text-primary fa-user-plus bg-body-secondary py-4 px-3 rounded-circle fa-lg"></i>
                            </div>
                            <div class="card-body text-center">
                                <h4 class="card-title fw-bold fs-6">Create an Account</h4>
                                <p class="card-text">Text</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 g-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex align-items-center mt-4 justify-content-center">
                                <i class="fas fa-cloud-upload bg-body-secondary py-4 px-3 rounded-circle fa-lg"></i>
                            </div>
                            <div class="card-body text-center">
                                <h4 class="card-title fw-bold fs-6">Upload CV/Resume</h4>
                                <p class="card-text">Text</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 g-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex align-items-center mt-4 justify-content-center">
                                <i class="fas fa-search-plus bg-body-secondary py-4 px-3 rounded-circle fa-lg"></i>
                            </div>
                            <div class="card-body text-center">
                                <h4 class="card-title fw-bold fs-6">Find Suitable Job</h4>
                                <p class="card-text">Text</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 g-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex align-items-center mt-4 justify-content-center">
                                <i class="fas fa-bookmark bg-body-secondary py-4 px-3 rounded-circle fa-lg"></i>
                            </div>
                            <div class="card-body text-center">
                                <h4 class="card-title fw-bold fs-6">Apply for Job</h4>
                                <p class="card-text">Text</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        welcome <span class="h6">{{ auth()?->user()?->username }}</span>
        <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    </div>
@endsection
