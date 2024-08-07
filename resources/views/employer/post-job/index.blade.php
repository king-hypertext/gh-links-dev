@extends('employer.layout')
@section('content')
    @php
        $applications = \App\Models\CandidateApplication::all();
    @endphp
    <!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
    <div class="table-responsive">
        <table class="table table-hover">
            <div class="d-flex justify-content-between my-2">
                <div class="">
                    <h6 class="h6 text-capitalize">my jobs ({{ $employer?->profile?->jobs->count() }})</h6>
                </div>
                {{-- <div class="form-group d-flex" style="min-width: 250px!important;">
                    <label for="status" class="text-nowrap me-3">Job Status</label>
                    <select class="form-select form-select-sm" onchange="window.location.href = this.value">
                        <option {{ request()->status == 'all' ? 'selected' : '' }} value="?status=all">All jobs</option>
                        <option {{ request()->status == 'active' ? 'selected' : '' }} value="?status=active">active</option>
                        <option {{ request()->status == 'inactive' ? 'selected' : '' }} value="?status=inactive">Inactive
                        </option>
                    </select>
                </div> --}}
            </div>
            {{-- {{ dd(request()->has('status') ? '' : 'selected') }} --}}
            <thead class="table-secondary">
                <tr class="text-uppercase">
                    <th scope="col" class="py-1">jobs</th>
                    <th scope="col" class="py-1">status</th>
                    <th scope="col" class="py-1">applications</th>
                    <th scope="col" class="py-1"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($all_jobs as $job)
                    <tr class="">
                        <td scope="row">
                            <a href="{{ route('my-jobs.edit', $job->id) }}" target="_blank" title="Edit Job"
                                rel="noopener noreferrer">
                                {{ strtoupper($job->title) }}
                            </a>
                        </td>
                        <td>
                            @if ($job->status == 1)
                                <span class="text-success">
                                    ✅active
                                </span>
                            @else
                                🔕inactive
                            @endif
                            </span>
                        </td>
                        <td>
                            <div class="d-flex flex-row">
                                <i class="fa fa-user-group me-1"></i>
                                <span>
                                    {{ $job->applications->count() }}
                                </span>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('job-applications.show', $job->id) }}"
                                class="btn btn-sm btn-secondary">view applications</a>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
