@extends('layout.app-layout')
@section('content')
    <div class="container mt-4">
        <div class="row">
            @forelse ($companies as $i => $item)
                <div class="col-sm-4">
                    <div class="card shadow-2 my-2 mx-md-0 user-select-none">
                        <div class="card-body">
                            <div class="d-flex flex-row justify-center align-items-center mt-3">
                                <div class="col-3">
                                    <img src="{{ $item->image?->logo }}" height="55" width="55" alt="logo"
                                        class="img-thumbnail img-circle">
                                </div>
                                <div class="d-flex flex-column align-items-start justify-content-start ms-2">
                                    <a href="{{ route('company.profile-info', $item->company_name) }}"
                                        class="h6 fw-semibold text-capitalize text-truncate mb-0 link-primary">
                                        {{ $item->company_name }}
                                    </a>
                                    <div class="d-flex justify-content-start align-items-center">
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        <span class="flex-nowrap text-nowrap text-truncate text-capitalize">
                                            {{ $item->company_location }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2 mt-2">
                                <button type="button" onclick="window.open(this.id, '_self')"
                                    id="{{ route('jobs.open-vacancy', [$item->company_name]) }}"
                                    class="btn btn-secondary text-capitalize">
                                    open positions {{ '(' . $item->jobs->count() . ')' ?? '(' . 0 . ')' }}
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-sm-12 text-center">
                    <h5 class="h5 text-uppercase fw-bold fs-3 text-info">No companies found.</h5>
                </div>
            @endforelse
        </div>
        <!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
        <div class="row">
            @if ($companies->isNotEmpty())
                <div class="row my-4">
                    <div class="col-12 text-center">
                        @if ($companies->currentPage() > 1)
                            <a class="btn-floating btn btn-sm btn-secondary rounded"
                                href="{{ url('companies?page=' . ($companies->currentPage() - 1)) }}" title="previous page">
                                <i class="fas fa-angle-left"></i>
                            </a>
                        @endif
                        <span class="mx-2">Page <span
                                class="px-2 py-1 text-bg-primary rounded-1">{{ $companies->currentPage() }}</span> of
                            {{ $companies->lastPage() }}</span>
                        @if ($companies->currentPage() < $companies->lastPage())
                            <a class="btn-floating btn btn-sm btn-secondary rounded"
                                href="{{ url('companies?page=' . ($companies->currentPage() + 1)) }}" title="next page">
                                <i class="fas fa-angle-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
