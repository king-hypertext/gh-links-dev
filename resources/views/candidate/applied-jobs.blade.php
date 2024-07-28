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
    <div class="container">
        <h5 class="h5 text-uppercase fw-semibold">
            applied jobs
        </h5>
    </div>
@endsection
</div>
