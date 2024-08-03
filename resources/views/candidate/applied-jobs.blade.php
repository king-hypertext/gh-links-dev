@extends('candidate.layout')
@section('content')
    <!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Marie Curie -->
    @php
        $user = auth('candidate')->user();
    @endphp
    @if (!$user->profile?->isProfileCompleted())
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Profile Setup!</strong> Your profile setup is not completed yet.
        </div>
    @endif
    @use(Carbon\Carbon)
    <div class="container">
        <h5 class="h5 text-uppercase fw-semibold">
            applied jobs <span class="fw-normal">({{ $applied_jobs->count() }})</span>
        </h5>
    </div>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-secondary">
                <tr class="text-uppercase">
                    <th scope="col" class="py-1">jobs</th>
                    <th scope="col" class="py-1">date applied</th>
                    <th scope="col" class="py-1">status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($applied_jobs as $j)
                    <tr class="">
                        <td scope="row">
                            <div class="d-flex flex-wrap">
                                <img src="{{ $j->job->company->image->logo_image ?? asset('icons/avatar-png.png') }}"
                                    width="55" height="55" alt="">
                                <div class="d-flex flex-column ms-sm-3">
                                    <ul class="list-unstyled mb-0">
                                        <li class="py-0 text-uppercase d-flex align-items-center">
                                            <strong>
                                                {{ $j->job->title }}
                                            </strong>
                                            <span
                                                class="btn btn-secondary text-nowrap px-2 py-1 ms-2">{{ $j->job->type }}</span>
                                        </li>
                                        <li class="py-0 text-capitalize fw-semibold text-primary">
                                            @ {{ $j->job->company->company_name }}
                                            <i class="fas fa-map-marker-alt ms-1"></i>
                                            {{ $j->job->company->company_location }}
                                        </li>
                                        <li class="py-0 text-truncate d-flex flex-row flex-wrap align-items-center">
                                            <span class="text-capitalize me-2">GHS
                                                {{ number_format($j->job->min_salary, 2) . ' - ' . number_format($j->job->max_salary, 2) }}
                                                / {{ $j->job->salary->type }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                        <td>
                            {{ Carbon::parse($j->created_at)->format('l, M d, Y H:iA') }}
                        </td>
                        <td>
                            @if ($j->approved == 0)
                                <button class="btn btn-outline-secondary"
                                    title="Your application is sent, waiting for approval">pending</button>
                            @else
                                <button class="btn btn-outline-secondary"
                                    title="Your application is accepted and approved">approved</button>
                            @endif
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
</div>
