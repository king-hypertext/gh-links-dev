@extends('employer.layout')
@section('content')
    <div class="overview-container">
        @use(Carbon\Carbon)

        <h6 class="h6 text-capitalize">Apllications ({{ $job->applications->count() }})</h6>
        <!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Marie Curie -->
        @forelse ($job->applications as $application)
            <div class="row">
                <div class="col-md-4">
                    <div class="card mx-0 mx-md-3">
                        <div class="card-body" style="font-size: 12px;">
                            <div class="d-flex flex-row align-items-center mb-2">
                                <img src="{{ $application->candidate->profile_picture }}" alt="" width="45"
                                    height="45" class="rounded-circle" />
                                <div class="d-flex flex-column justify-content-end ms-2" style="line-height: 1;">
                                    <h6 class="h6 text-capitalize fw-semibold">
                                        <a href="{{ route('candidate.profile-info', $application->candidate->candidate->username) }}"
                                            target="_blank" rel="noopener noreferrer" class="link-dark"
                                            title="View Candidate Profile">
                                            {{ $application->candidate->full_name }}
                                        </a>
                                    </h6>
                                    <span class="text-capitalize">{{ $application->candidate->job_role }}</span>
                                </div>
                            </div>
                            <hr class="hr">
                            <ul style="list-style-position:inside;" class="ps-0">
                                <li>
                                    {{ $application->candidate->experience . ' Years Experience' }}
                                </li>
                                <li>
                                    Applied: {{ Carbon::parse($application->created_at)->format('M d, Y') }}
                                </li>
                                <li>
                                    <a title="Downloand CV" href="{{ $application->candidate->resume->file }}"
                                        target="_blank" rel="noopener noreferrer">
                                        <i class="fa fa-download me-1"></i>Download CV
                                    </a>
                                </li>
                            </ul>
                            <hr class="hr">
                            <div class="d-flex">
                                <div class="form-check form-check-inline align-items-center d-flex">
                                    <input id="approved-letter" class="form-check-input" type="checkbox" id="check"
                                        value="{{ $application->id }}" />
                                    <label class="form-check-label" for="check">
                                        Recieved</label>
                                </div>
                                <a class="btn btn-secondary" href="mailto:{{ $application->candidate->candidate->email }}"
                                    target="_blank" rel="noopener noreferrer">Send Email</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        @endforelse
        <script>
            $('input#approved-letter').change(function() {
                var input = $(this).val();
                $.ajax('/employer/approve-application/' + input, {
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        </script>
    </div>
@endsection
