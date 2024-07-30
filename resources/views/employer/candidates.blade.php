@extends('employer.layout')
@section('content')
    @php
        $employer = auth('employer')->user();
    @endphp
    <!-- Life is available only in the present moment. - Thich Nhat Hanh -->
    <div class="container">
        <h6 class="h6 fw-semibold text-uppercase">my candidates ({{ $employer?->profile->saved_candidates->count() }})</h6>
    </div>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col">candidates</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employer->profile->saved_candidates as $candidate)
                    <tr class="">
                        <td scope="row">
                            <div class="d-flex flex-wrap align-items-center">
                                <img src="{{ $candidate->candidate->profile_picture ?? asset('icons/avatar-png.png') }}"
                                    width="55" height="55" alt="" class="img-thumbnail">
                                <div class="d-flex flex-column ms-sm-3">
                                    <ul class="list-unstyled mb-0">
                                        <li class="py-0 text-capitalize" style="line-height: 1;">
                                            <strong>
                                                {{ $candidate->candidate->full_name }}
                                            </strong>
                                        </li>
                                        <li class="py-0 text-capitalize" style="line-height: 1.2;">
                                            {{ $candidate->candidate->job_role }}
                                        </li>
                                        <li class="py-0 text-truncate">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span class="text-capitalize">
                                                {{ $candidate->candidate->location }},
                                                {{ $candidate->candidate->experience == '0' ? 'No Experience' : $candidate->candidate->experience . ' years Experience' }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-row flex-wrap align-items-center justify-content-end">
                                <button data-candidate-id="{{ $candidate->candidate->id }}" type="button"
                                    title="Remove from favorites" class="btn btn-secondary px-3 unsave-candidate me-0 me-md-2">
                                    <i class="fas fa-bookmark user-select-none"></i>
                                </button>
                                <a href="{{ route('candidate.profile-info', $candidate->candidate->id) }}"
                                    class="btn btn-primary">
                                    view profile
                                </a>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
