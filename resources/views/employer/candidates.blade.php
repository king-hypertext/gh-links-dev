@extends('employer.layout')
@section('content')
    @php
        $user = auth('employer')->user();
    @endphp
    <!-- Life is available only in the present moment. - Thich Nhat Hanh -->
    <div class="container">
        <h6 class="h6 fw-semibold text-uppercase">my candidates ({{ $user->employer->savedCandidates->count() }})</h6>
        @use(App\Models\Candidate)
        <div class="overview-container">
            <div class="row">
                <div class="d-flex flex-wrap align-items-center justify-content-end">
                    <a href="{{ route('candidates.index') }}" target="_blank" rel="noopener noreferrer"
                        title="more candidates">More
                        Candidates
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @if ($user->employer)
                @forelse ($user->employer->savedCandidates as $candidate)
                    <div class="row shadow-2 p-2 rounded-2 mt-2">
                        <div class="d-flex flex-row justify-content-between">
                            <div class="d-flex flex-wrap align-items-center">
                                <img src="{{ url($candidate->candidate->dp) ?? asset('icons/avatar-png.png') }}"
                                    width="55" height="55" alt="" class="img-thumbnail">
                                <div class="d-flex flex-column ms-sm-3">
                                    <ul class="list-unstyled mb-0">
                                        <li class="py-0 text-capitalize" style="line-height: 1.2;">
                                            <strong>
                                                {{ $candidate->candidate->full_name }}
                                            </strong>
                                        </li>
                                        <li class="py-0 text-uppercase fw-semibold text-black-50" style="line-height: 1.2;">
                                            {{ $candidate->candidate->profession }}
                                        </li>
                                        <li class="py-0 text-truncate" style="line-height: 1.2;">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span class="text-capitalize">
                                                {{ $candidate->candidate->location }},
                                                {{ $candidate->candidate->experience == '0' ? 'No Experience' : $candidate->candidate->experience . ' years Experience' }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap align-items-center justify-content-end">
                                @auth('employer')
                                    <button type="button" data-candidate-id="{{ $candidate->id }}"
                                        title="{{ $candidate->candidate->isCandidateSaved() ? 'remove from favorites' : 'add to favorites' }}"
                                        class="btn btn-secondary px-3 bookmark-candidate">
                                        <i
                                            class="{{ $candidate->candidate->isCandidateSaved() ? 'fa' : 'far' }} fa-bookmark"></i>
                                    </button>
                                @endauth
                                <a href="{{ route('candidate.profile-info', $candidate->candidate->user->username) }}"
                                    type="button" class="btn btn-primary ms-2 px-3 text-truncate text-capitalize">
                                    view profile
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <h6 class="h6">
                            no data found. Your favourite candidates will be shown here
                        </h6>
                    </div>
                @endforelse
            @endif
        </div>
    </div>
@endsection
