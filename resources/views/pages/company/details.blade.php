@extends('layout.app-layout')
@section('content')
    <div>
        <!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
    </div>
    {{-- {{ $company }} --}}
    <style>
        .icon.fas {
            color: var(--bs-success) !important;
        }
    </style>
    @use(Carbon\Carbon)
    <div class="container">
        <div class="row shadow-1 my-3 pb-2">
            <div class="col-lg-6 col-sm-6 flex flex-row g-3">
                <div class="d-flex flex-row justify-content-start  mt-3">
                    <img src="{{ $company->image?->logo_image }}" height="65" width="65" alt="company-logo"
                        class="img-thumbnail flex-col me-2">
                    <div class="col-auto d-flex flex-column justify-content-end align-items-baseline">
                        <h6 class="h5 fw-semibold text-capitalize text-truncate text-success">
                            {{ $company->company_name }}
                        </h6>
                        <div class="col-auto d-flex flex-row align-items-center align-middle">
                            {{-- <i class="icon fas fa-map-marker-alt"></i> --}}
                            <h6 class="text-truncate fw-semibold text-capitalize mb-0">
                                {{ ucwords($company->company_location) }}
                            </h6>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row mb3">
        <div class="col-sm-7 col-lg-7 order-sm-1 order-2 mt-sm-0 mt-4">
            <h6 class="h6 fw-bold text-capitalize">
                about us
            </h6>
            <div id="job-description">
                {!! $company->company_description !!}
            </div>
            <h6 class="h6 fw-bold text-capitalize mt-3">
                company benefits
            </h6>
            {!! $company->benefits !!}
            <h6 class="h6 fw-bold text-capitalize mt-3">
                company vision
            </h6>
            {!! $company->company_vision !!}
        </div>
        <div class="col-sm-5 col-lg-5 order-sm-2 order-1">
            <div class="container">
                <div class="row shadow-1 p-3 mt-2">
                    <div class="col-6 col-sm-6 gy-3">
                        <i class="icon fas fa-suitcase"></i>
                        <div class="d-flex flex-column align-items-start align-middle">
                            <span class="fw-lighter text-uppercase" style="font-size: 12px;">
                                founded in:
                            </span>
                            <h6 class="h6 mb-0  text-black">
                                {{ Carbon::parse($company->company_founding_year)->format('d M Y') }}
                            </h6>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 gy-3">
                        <i class="icon fas fa-suitcase"></i>
                        <div class="d-flex flex-column align-items-start align-middle">
                            <span class="fw-lighter text-uppercase" style="font-size: 12px;">
                                team size:
                            </span>
                            <h6 class="h6 mb-0  text-black">
                                {{ $company->company_size }}
                            </h6>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 gy-3">
                        <i class="icon fas fa-suitcase"></i>
                        <div class="d-flex flex-column align-items-start align-middle">
                            <span class="fw-lighter text-uppercase" style="font-size: 12px;">
                                organization type:
                            </span>
                            <h6 class="h6 mb-0  text-black">
                                {{ $company->organization->name }}
                            </h6>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 gy-3">
                        <i class="icon fas fa-suitcase"></i>
                        <div class="d-flex flex-column align-items-start align-middle">
                            <span class="fw-lighter text-uppercase" style="font-size: 12px;">
                                industry type:
                            </span>
                            <h6 class="h6 mb-0  text-black">
                                {{ $company->industry->name }}
                            </h6>
                        </div>
                    </div>
                </div>

                <div class="row shadow-1 p-3 mt-3">
                    <div class="row">
                        <h6 class="h6 fw-bold text-capitalize">
                            company information
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
                                    <a href="{{ $company->company_website }}" class="nav-link" target="_blank"
                                        rel="noopener noreferrer">
                                        {{ $company->company_website }}
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
                                    @foreach ($company->phoneNumbers as $phone)
                                        <a href="tel:+233{{ $phone->number }}" class="nav-link" target="_blank"
                                            rel="noopener noreferrer">
                                            {{ $phone->number }}
                                        </a>
                                    @endforeach
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
                                    <a href="mailto:{{ $company->company_email }}" class="nav-link" target="_blank"
                                        rel="noopener noreferrer">
                                        {{ $company->company_email }}
                                    </a>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row shadow-1 p-3 mt-3">
                    <h6 class="h6 fw-bold">
                        Follow us on:
                    </h6>
                    <div class="col-12">
                        <ul class="list-unstyled d-flex">
                            <li>
                                <a href="#" class="btn btn-sm btn-secondary m-1 copy-url" title="facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-sm btn-secondary m-1 copy-url"
                                    title="join whatsapp channel">
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
        </div>
    </div>
@endsection
