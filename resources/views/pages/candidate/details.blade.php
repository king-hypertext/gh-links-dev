@extends('layout.app-layout')
@section('content')
    <div>
        <!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
        {{-- {{ $candidate }} --}}
        <style>
            .icon.fas {
                color: var(--bs-success) !important;
            }
        </style>
        @use(Carbon\Carbon)
        <div class="container">
            <div class="row shadow-1 my-3 pb-2">
                <div class="col-lg-6 col-sm-6 flex flex-row g-3">
                    <div class="d-flex flex-row justify-content-start align-items-center mt-3">
                        <img src="{{ $candidate->dp }}" height="65" width="65" alt="company-logo"
                            class="img-thumbnail flex-col me-2">
                        <div class="col-auto d-flex flex-column justify-content-end">
                            <h6 class="h5 fw-semibold text-capitalize text-truncate text-primary mb-0">
                                {{ $candidate->full_name }}
                            </h6>
                            <span class="text-uppercase">{{ $candidate->profession }}</span>
                            <div class="col-auto d-flex flex-row align-items-center align-middle">
                                <i class="fas fa-map-marker-alt"></i>
                                <h6 class="text-truncate fw-semibold text-capitalize mb-0 ms-1">
                                    {{ ucwords($candidate->location) }}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="col-lg-6 col-sm-6 d-flex flex-row align-items-center justify-content-start justify-content-sm-end g-3">
                    @auth('employer')
                        <button type="button" data-candidate-id="{{ $candidate->id }}"
                            title="{{ $candidate->isCandidateSaved() ? 'remove from favorites' : 'add to favorites' }}"
                            class="btn btn-secondary bookmark-candidate" title="add to saved candidates">
                            <i class="{{ $candidate->isCandidateSaved() ? 'fa' : 'far' }} fa-bookmark"></i>
                        </button>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    <div class="row mb3">
        <div class="col-sm-7 col-lg-7 order-sm-1 order-2 mt-sm-0 mt-4">
            <h6 class="h6 fw-bold text-capitalize">
                biography
            </h6>
            <div id="job-description">
                {!! $candidate->biography !!}
            </div>
            <div class="row shadow-1 p-3 mt-3">
                <h6 class="h6 fw-bold">
                    Follow me on:
                </h6>
                <div class="col-12">
                    <ul class="list-unstyled d-flex">
                        <li>
                            <a href="#" class="btn btn-sm btn-secondary m-1 copy-url" title="facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-sm btn-secondary m-1 copy-url" title="join whatsapp channel">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-sm btn-secondary m-1 copy-url" title="X (twitter)">
                                <i class="fab fa-x-twitter"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-5 col-lg-5 order-sm-2 order-1">
            <div class="container">
                <div class="row shadow-1 p-3 mt-2">
                    <h6 class="h6 fw-bold text-capitalize">
                        basic information
                    </h6>
                    <div class="col-6 col-sm-6 gy-3">
                        <i class="icon fas fa-suitcase"></i>
                        <div class="d-flex flex-column align-items-start align-middle">
                            <span class="fw-lighter text-uppercase" style="font-size: 12px;">
                                gender:
                            </span>
                            <h6 class="h6 mb-0  text-black">
                                {{ $candidate->gender }}
                            </h6>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 gy-3">
                        <i class="icon fas fa-suitcase"></i>
                        <div class="d-flex flex-column align-items-start align-middle">
                            <span class="fw-lighter text-uppercase" style="font-size: 12px;">
                                marital status:
                            </span>
                            <h6 class="h6 mb-0  text-black">
                                {{ $candidate->marital_status }}
                            </h6>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 gy-3">
                        <i class="icon fas fa-suitcase"></i>
                        <div class="d-flex flex-column align-items-start align-middle">
                            <span class="fw-lighter text-uppercase" style="font-size: 12px;">
                                work experience:
                            </span>
                            <h6 class="h6 mb-0  text-black">
                                {{ $candidate->experience.'+ Years' }}
                            </h6>
                        </div>
                    </div>
                    {{-- <div class="col-6 col-sm-6 gy-3">
                        <i class="icon fas fa-suitcase"></i>
                        <div class="d-flex flex-column align-items-start align-middle">
                            <span class="fw-lighter text-uppercase" style="font-size: 12px;">
                                qualification:
                            </span>
                            <h6 class="h6 mb-0  text-black">
                                {{ $candidate->education->q '('.$candidate->education?->institution_name.')' }}
                            </h6>
                        </div>
                    </div> --}}
                </div>
                <div class="row shadow-1 p-3 mt-3">
                    <h6 class="h6 fw-bold text-capitalize">
                        download my CV
                    </h6>
                    {{-- {{dd($candidate)}} --}}
                    <div class="col-12 d-flex align-items-center">
                        <img class="me-2 text-secondary" src="{{ asset('app/plugins/icons/svgs/solid/file-pdf.svg') }}"
                            width="40" height="55" alt="" />
                        {{-- @foreach ($candidate->resume as $cv) --}}
                        <div class="rounded-0 text-capitalize">
                            {{ $candidate->full_name }}
                            <br />
                            <h6 class="h6 fw-bold">PDF</h6>
                        </div>
                        <a download="{{ $candidate->full_name }}" href="{{ url($candidate->resume?->cv) }}"
                            class="btn btn-secondary ms-2 px-3" title="Click to download CV" target="_blank"
                            rel="noopener noreferrer">
                            <i class="fa fa-cloud-download-alt"></i>
                        </a>
                        {{-- @endforeach --}}
                    </div>
                </div>
                <div class="row shadow-1 p-3 mt-3">
                    <div class="row">
                        <h6 class="h6 fw-bold text-capitalize">
                            contact information
                        </h6>
                        <div class="col-sm-12 d-flex flex-row gy-3">
                            <div class="p-3 flex-col">
                                <i class="icon fa fa-globe"></i>
                            </div>
                            <div class="d-flex flex-column align-items-start align-middle">
                                <span class="fw-lighter text-uppercase" style="font-size: 12px;">
                                    website:
                                </span>
                                <h6 class="h6 mb-0 text-black">
                                    <a href="{{ $candidate->website_url }}"
                                        class="nav-link link-primary link-underline-primary" target="_blank"
                                        rel="noopener noreferrer">
                                        {{ $candidate->website_url }}
                                    </a>
                                </h6>
                            </div>
                        </div>
                        <hr class="hr-blurry">
                        <div class="col-sm-12 d-flex flex-row gy-3">
                            <div class="p-3 flex-col">
                                <i class="icon fa fa-phone"></i>
                            </div>
                            <div class="d-flex flex-column align-items-start align-middle">
                                <span class="fw-lighter text-uppercase" style="font-size: 12px;">
                                    phone:
                                </span>
                                <h6 class="h6 text-black">
                                    {{-- @foreach ($candidate->phoneNumbers as $phone) --}}
                                    <a href="tel:+233{{ $candidate->user?->phone_number }}"
                                        class="nav-link link-primary link-underline-primary" target="_blank"
                                        rel="noopener noreferrer">
                                        {{ $candidate->user?->phone_number }}
                                    </a>
                                    {{-- @endforeach --}}
                                </h6>
                            </div>
                        </div>
                        <hr class="hr-blurry">
                        <div class="col-sm-12 d-flex flex-row gy-3">
                            <div class="p-3 flex-col">
                                <i class="icon far fa-envelope"></i>
                            </div>
                            <div class="d-flex flex-column align-items-start align-middle">
                                <span class="fw-lighter text-uppercase" style="font-size: 12px;">
                                    email:
                                </span>
                                <h6 class="h6 mb-0 text-black">
                                    <a href="mailto:{{ $candidate->user?->email }}"
                                        class="nav-link link-primary link-underline-primary" target="_blank"
                                        rel="noopener noreferrer">
                                        {{ $candidate->user?->email }}
                                    </a>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
