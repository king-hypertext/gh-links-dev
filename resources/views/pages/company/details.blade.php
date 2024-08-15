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
        <div class="row shadow-1 my-3 img-thumbnail {{ $company->image->banner ? 'py-2 py-sm-5' : 'py-2' }}"
            style="background: url({{ url($company->image->banner) }});background-size: cover;background-color: rgba(0, 0, 0, 0.43);background-blend-mode: multiply;">
            <div class="col-lg-6 col-sm-6 d-flex flex-row align-items-center justify-content-between">
                <div class="d-flex flex-row align-items-center justify-content-start">
                    <img src="{{ url($company->image?->logo) }}" height="65" width="65" alt="company-logo"
                        class="img-thumbnail flex-col me-2">
                    <div class="col-auto d-flex flex-column justify-content-end align-items-baseline">
                        <h6 class="h5 fw-semibold text-capitalize text-truncate text-white">
                            {{ $company->company_name }}
                        </h6>
                        <div class="col-auto d-flex flex-row align-items-center align-middle">
                            <i class="fas fa-map-marker-alt me-1"></i>
                            <h6 class="text-truncate fw-semibold text-capitalize mb-0">
                                {{ ucwords($company->company_location) }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="col-lg-6 col-sm-6 d-flex flex-row align-items-center justify-content-start justify-content-sm-end g-3 g-sm-0">
                <a href="{{ route('jobs.open-vacancy', $company->company_name) }}" type="button"
                    class="btn btn-primary rounded-0 me-2" title="view all open jobs by {{ $company->company_name }}">
                    <span>
                        view open positions
                    </span>
                    <i class="fas fa-arrow-right ms-2"></i>
                </a>
                {{-- </div> --}}
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
                                {{ Carbon::parse($company->company_founding_year)->format('Y') }} 
                                {{ '(' . Carbon::parse($company->company_founding_year)->longRelativeDiffForHumans() . ')' }}
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
                                    <a href="{{ $company->company_website }}"
                                        class="nav-link link-primary link-underline-primary" target="_blank"
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
                            @if ($company->socialMediaAccounts)
                                @foreach ($company->socialMediaAccounts as $link)
                                    @if ($link->fb)
                                        <li>
                                            <a href="{{ $link->fb }}" class="btn btn-sm btn-secondary m-1 copy-url"
                                                title="facebook">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($link->whatsapp)
                                        <li>
                                            <a href="#" class="btn btn-sm btn-secondary m-1 copy-url"
                                                title="whatsapp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($link->x)
                                        <li>
                                            <a href="{{ $link->x }}" class="btn btn-sm btn-secondary m-1 copy-url"
                                                title="X (twitter)">
                                                <i class="fab fa-x-twitter"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($link->linkedin)
                                        <li>
                                            <a href="{{ $link->linkedin }}" class="btn btn-sm btn-secondary m-1 copy-url"
                                                title="X (twitter)">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($link->instagram)
                                        <li>
                                            <a href="{{ $link->instagram }}"
                                                class="btn btn-sm btn-secondary m-1 copy-url" title="X (twitter)">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
