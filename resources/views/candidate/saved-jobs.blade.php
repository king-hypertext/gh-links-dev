@extends('candidate.layout')
@section('content')
    <div class="container">
        <h5 class="h5 text-uppercase fw-semibold">
            saved jobs
        </h5>
        <h6 class="h6 text-capitalize">My Jobs ({{ $saved_jobs->count() }})</h6>
        <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
        @foreach ($saved_jobs as $saved_job)
            <div class="row shadow-2 p-2 rounded-2 mt-2">
                <div class="d-flex flex-row justify-content-between">
                    <div class="d-flex flex-wrap">
                        <img src="{{ $saved_job->job->company->image->logo_image ?? asset('icons/avatar-png.png') }}"
                            width="55" height="55" alt="">
                        <div class="d-flex flex-column ms-sm-3">
                            <ul class="list-unstyled mb-0">
                                <li class="py-0 text-capitalize d-flex align-items-center" style="line-height: 0.8;">
                                    <strong>
                                        {{ $saved_job->job->title }}
                                    </strong>
                                    <span
                                        class="btn btn-secondary text-nowrap px-2 py-1 ms-2">{{ $saved_job->job->type }}</span>
                                </li>
                                <li class="py-0 text-capitalize fw-semibold" style="line-height: 0.8;">
                                    @ {{ $saved_job->job->company->company_name }}
                                    <i class="fas fa-map-marker-alt ms-1"></i>
                                    {{ $saved_job->job->company->company_location }}
                                </li>
                                <li class="py-0 text-truncate d-flex flex-row flex-wrap align-items-center">
                                    <span class="text-capitalize me-2">
                                        salary range GHS
                                        {{ number_format($saved_job->job->min_salary, 2) . ' - ' . number_format($saved_job->job->max_salary, 2) }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap align-items-center justify-content-end">
                        <button type="button" {{ !auth('employer')->check() ? 'disabled' : '' }} title="add to favorites"
                            class="btn btn-secondary px-3">
                            <i class="far fa-bookmark"></i>
                        </button>
                        <a href="{{ route('jobs.show', $saved_job->job->id) }}" type="button"
                            class="btn btn-primary ms-2 px-3 text-truncate text-capitalize">
                            view job
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
