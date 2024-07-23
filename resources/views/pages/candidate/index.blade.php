@extends('layout.app-layout')
@section('content')
    <!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
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
    <div class="row shadow-2 mb-4 rounded-0 bg-secondary body-picture-bg bg:transparent-dark">
        <form class="form-search">
            <div class="card-body p-1 py-3">
                <div class="row search-row">
                    <div class="col-sm-5 gy-2 gy-md-0">
                        <div class="form-group" data-mdb-input-init>
                            <span class="input-group-icon-left-align">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <input placeholder="Search by: role, position..." style="padding-left: 40px;" type="text"
                                name="position" class="form-control" id="position">
                        </div>
                    </div>
                    <div class="col-sm-5 gy-2 gy-md-0">
                        <div class="form-group" data-mdb-input-init>
                            <span class="input-group-icon-left-align">
                                <i class="fa-solid fa-location-crosshairs"></i>
                            </span>
                            <input placeholder="Capital city, town..." style="padding-left: 40px;" type="text"
                                name="location" class="form-control" id="location">
                        </div>
                    </div>
                    {{-- <div class="row justify-content-end"> --}}
                    <div class="col-sm-2 gy-2 gy-md-0">
                        <button type="submit" class="btn btn-info rounded-0">
                            <i class="me-2 fas fa-magnifying-glass"></i>
                            <span>search</span>
                        </button>
                    </div>
                    {{-- </div> --}}
                </div>
            </div>
        </form>
    </div>
    <div class="container mt-3">
        @forelse ($candidates as $candidate)
            {{-- {{ $candidate->profile->isProfileCompleted()}} --}}
            @if ($candidate->profile?->isProfileCompleted())
                <div class="row shadow-2 p-2 rounded-2 mt-2">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="d-flex flex-wrap">
                            <img src="{{ asset('icons/avatar-png.png') }}" width="55" height="55" alt="">
                            <div class="d-flex flex-column ms-sm-3">
                                <ul class="list-unstyled mb-0">
                                    <li class="py-0 text-capitalize" style="line-height: 1;">
                                        <strong>candidate name</strong>
                                    </li>
                                    <li class="py-0 text-capitalize" style="line-height: 1.2;">developer</li>
                                    <li class="py-0 text-truncate" style="line-height: 1;">
                                        <i class="fas fa-map-marker-alt"></i>
                                        location, experience
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap align-items-center justify-content-end">
                            <button type="button" {{ !auth('employer')->check() ? 'disabled' : '' }}
                                title="add to favorites" class="btn btn-secondary px-3">
                                <i class="far fa-bookmark"></i>
                            </button>
                            <a href="{{ route('candidate.profile-info', $candidate->username) }}" type="button"
                                class="btn btn-primary ms-2 px-3 text-truncate text-capitalize">
                                view profile
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="d-flex flex-row justify-content-center">
                NO DATA FOUND.
            </div>
        @endforelse
    </div>
    <div class="row">
        @if ($candidates->isNotEmpty())
            <div class="row my-4">
                <div class="col-12 text-center">
                    @if ($candidates->currentPage() > 1)
                        <a class="btn-floating btn btn-sm btn-secondary rounded"
                            href="{{ url('candidates?page=' . ($candidates->currentPage() - 1)) }}" title="previous page">
                            <i class="fas fa-angle-left"></i>
                        </a>
                    @endif
                    <span class="mx-2">Page <span class="px-2 py-1 text-bg-primary rounded-1">
                            {{ $candidates->currentPage() }}</span> of
                        {{ $candidates->lastPage() }}</span>
                    @if ($candidates->currentPage() < $candidates->lastPage())
                        <a class="btn-floating btn btn-sm btn-secondary rounded"
                            href="{{ url('candidates?page=' . ($candidates->currentPage() + 1)) }}" title="next page">
                            <i class="fas fa-angle-right"></i>
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </div>
@endsection
