@extends('candidate.layout')
@section('content')
    @php
        $user = auth('candidate')->user();
    @endphp
    @if (!$user->profile?->isProfileCompleted())
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Profile Setup!</strong> Your profile setup is not completed yet.
        </div>
    @endif
    {{ $user->profile->resume }}
@endsection
