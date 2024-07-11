@extends('layout.app-layout')
@section('content')
<style>
    .icon.fas{
        color: var(--bs-success) !important;
    }
</style>
    <!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
    <div class="row shadow-1 my-3 pb-2">
        <div class="col-lg-6 col-sm-6 flex flex-row g-3">
            <div class="d-flex flex-row justify-content-start  mt-3">
                <img src="{{ asset('company-logo.svg') }}" height="65" width="65" alt="company-logo"
                    class="img-thumbnail rounded-circle flex-col me-2">
                <div class="col-auto d-flex flex-column justify-content-end align-items-baseline">
                    <h6 class="h5 fw-semibold text-capitalize text-truncate text-success">
                        frontend developer / web designer
                    </h6>
                    <div class="col-auto d-flex flex-row align-items-center align-middle">
                        {{-- <i class="icon fas fa-map-marker-alt"></i> --}}
                        <h6 class="text-truncate fw-semibold text-capitalize mb-0">amali tech.</h6>
                        <span class="btn btn-success cursor-default shadow-0 text-nowrap px-2 py-1 ms-2">full time</span>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-6 col-sm-6 d-flex flex-row align-items-center justify-content-start justify-content-md-end g-3">
            <div class="d-grid gap-2">
                <button type="button" name="" id="" class="btn btn-primary rounded-0">
                    <span>
                        apply
                    </span>
                    <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="row mb3">
        <div class="col-sm-7">
            <h6 class="h6 fw-bold text-capitalize">
                job description
            </h6>
            <div id="job-description">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellat cum suscipit nihil corporis odit, numquam
                natus maiores illum quibusdam impedit voluptatum vel iusto veritatis esse enim. Repellendus accusamus animi
                sed.
            </div>
            <h6 class="h6 fw-bold text-capitalize mt-3">
                job requirements
            </h6>
            <ul>
                <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae adipisci suscipit eveniet,
                    architecto non nisi recusandae accusamus porro cupiditate sequi animi iste cum beatae reiciendis
                    distinctio eum at natus nostrum.</li>
                <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae adipisci suscipit eveniet,
                    architecto non nisi recusandae accusamus porro cupiditate sequi animi iste cum beatae reiciendis
                    distinctio eum at natus nostrum.</li>
                <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae adipisci suscipit eveniet,
                    architecto non nisi recusandae accusamus porro cupiditate sequi animi iste cum beatae reiciendis
                    distinctio eum at natus nostrum.</li>
                <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae adipisci suscipit eveniet,
                    architecto non nisi recusandae accusamus porro cupiditate sequi animi iste cum beatae reiciendis
                    distinctio eum at natus nostrum.</li>
                <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae adipisci suscipit eveniet,
                    architecto non nisi recusandae accusamus porro cupiditate sequi animi iste cum beatae reiciendis
                    distinctio eum at natus nostrum.</li>
                <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae adipisci suscipit eveniet,
                    architecto non nisi recusandae accusamus porro cupiditate sequi animi iste cum beatae reiciendis
                    distinctio eum at natus nostrum.</li>
            </ul>
            <h6 class="h6 fw-bold text-capitalize mt-3">
                job benefits
            </h6>
            <ul>
                <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae adipisci suscipit eveniet,
                    architecto non nisi recusandae accusamus porro cupiditate sequi animi iste cum beatae reiciendis
                    distinctio eum at natus nostrum.</li>
                <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae adipisci suscipit eveniet,
                    architecto non nisi recusandae accusamus porro cupiditate sequi animi iste cum beatae reiciendis
                    distinctio eum at natus nostrum.</li>
                <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae adipisci suscipit eveniet,
                    architecto non nisi recusandae accusamus porro cupiditate sequi animi iste cum beatae reiciendis
                    distinctio eum at natus nostrum.</li>

            </ul>
        </div>
        <div class="col-sm-5">
            <div class="row shadow-1 p-3">
                <div class="col-12">
                    <div class="d-flex flex-column align-items-center ">
                        <h6 class="fw-semibold">salary (GHS)</h6>
                        <h6>
                            <span class="btn btn-outline-success cursor-default shadow-0 text-nowrap px-2 py-1">
                                GHS 10, 000 - GHS 50, 000
                            </span>
                        </h6>
                        <h6 class="text-muted text-lead">monthly salary</h6>
                    </div>
                </div>
            </div>
            <div class="row shadow-1 p-3 mt-2">
                <div class="col-12">
                    <div class="row">
                        <h6 class="h6 fw-bold text-capitalize">
                            job overview
                        </h6>
                        <div class="col-sm-4 gy-3">
                            <div class="d-flex flex-column align-items-start align-middle">
                                <i class="icon fas fa-suitcase"></i>
                                <span class="fw-lighter text-capitalize" style="font-size: 12px;">
                                    date posted:
                                </span>
                                <h6 class="h6 mb-0  text-black">
                                    {{ Date('d M, Y') }}
                                </h6>
                            </div>
                        </div>
                        <div class="col-sm-4 gy-3">
                            <div class="d-flex flex-column align-items-start align-middle">
                                <i class="icon fas fa-layer-group"></i>
                                <span class="fw-lighter text-capitalize" style="font-size: 12px;">
                                    entry level:
                                </span>
                                <h6 class="h6 mb-0  text-black text-capitalize">
                                    beginner
                                </h6>
                            </div>
                        </div>
                        <div class="col-sm-4 gy-3">
                            <div class="d-flex flex-column align-items-start align-middle">
                                <i class="icon fas fa-gear"></i>
                                <span class="fw-lighter text-capitalize" style="font-size: 12px;">
                                    experience:
                                </span>
                                <h6 class="h6 mb-0  text-black text-capitalize">
                                    N/A
                                </h6>
                            </div>
                        </div>
                        <div class="col-sm-4 gy-3">
                            <div class="d-flex flex-column align-items-start align-middle">
                                <i class="icon fas fa-graduation-cap"></i>
                                <span class="fw-lighter text-capitalize" style="font-size: 12px;">
                                    education:
                                </span>
                                <h6 class="h6 mb-0  text-black text-capitalize">
                                    graduate
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row shadow-1 p-3">
                <h6 class="h6 fw-bold">
                    Share this Job:
                </h6>
                <div class="col-12">

                </div>
            </div>
        </div>
    </div>
@endsection
