@extends('employer.layout')
@section('content')
    @php
        $employer = auth('employer')->user();
    @endphp
    @session('success')
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Congratulations!</strong> {{ session('success') }}
    </div>
    @endif
    <div id="error" style="display: none;" class="alert alert-danger alert-dismissible fade show" role="alert">
    </div>
    @if ($errors->any())
        <div class="alert alert-danger text-center" role="alert">
            <ul class="list-unstyled mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form id="post-job" method="POST" action="{{ route('my-jobs.store') }}">
        @csrf
        <input type="hidden" name="company_id" value="{{ $company_id }}">
        {{-- name, email adress, location --}}
        <div class="row">
            <div class="col-sm-8">
                <div class="mb-3">
                    <label for="title" class="form-label">Job Title</label>
                    <input required type="text" name="title" value="{{ @old('title') }}"
                        id="title" class="form-control" placeholder="" aria-describedby="helpId" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label for="type" class="form-label">Job Type</label>
                    <select required name="type" id="type" class="form-select select2">
                        <option value="">Select any </option>
                        <option value="full-time">Full Time</option>
                        <option value="part-time">Part Time</option>
                        <option value="contract">Contract</option>
                    </select>
                </div>
            </div>
        </div>
        {{-- salary info --}}
        <div class="row my-2">
            <h5 class="h3 fs-5 text-capitalize fw-bold">Salary Info</h5>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label for="min_salary" class="form-label">Minimum Salary</label>
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">GHS</span>
                        <input required type="number" min="10" value="{{ @old('min_salary') }}" name="min_salary" id="min_salary"
                            class="form-control" />
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label for="max_salary" class="form-label">Maximum Salary</label>
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">GHS</span>
                        <input required type="number" name="max_salary" value="{{ @old('max_salary') }}" id="max_salary" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label for="salary_id" class="form-label">Salary Type</label>
                    <select required name="salary_id" id="salary_id" class="form-select select2">
                        <option value="">Select any </option>
                        @foreach ($salaries as $s)
                            <option value="{{ $s->id }}">{{ $s->type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        {{-- advance info --}}
        <div class="row my-2">
            <h5 class="h3 fs-5 text-capitalize fw-bold">advanced job information</h5>
            <div class="col-sm-4">
                <label for="education_id">Education Level</label>
                <select name="education_id" id="education_id" class="form-select select2">
                    <option value="">Select any</option>
                    @foreach ($education as $e)
                        <option value="{{ $e->id }}">{{ $e->level }}</option>
                    @endforeach
                    {{-- to be implemented: high certificate,diploma,hnd,degree,masters --}}
                </select>
            </div>
            <div class="col-sm-4">
                <label for="min_experience">Minimum Experience</label>
                <select name="min_experience" id="min_experience" class="form-select select2">
                    <option value="">Select any</option>
                    <option value="1-3">0 years</option>
                    <option value="1-3">1-2 years</option>
                    <option value="1-3">3-5 years</option>
                    <option value="1-3">5-10 years</option>
                    {{-- to be implemented: 1-5 years, 6-10 years, 11-15 years, 16+ years --}}
                </select>
            </div>
            <div class="col-sm-4">
                <label for="open_vacancies">Open Vacancies</label>
                <input required class="form-control" type="number" value="1" name="open_vacancies" />
            </div>
            <div class="col-sm-4">
                <div class="form-group mt-3">
                    <label for="entry_id">Job Level</label>
                    <select name="entry_id" id="entry_id" class="form-select select2">
                        <option value="">Select any</option>
                        @foreach ($job_experiences as $je)
                            <option value="{{ $je->id }}">{{ $je->level }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row my-4">
            <h5 class="h3 fs-5 text-capitalize fw-bold">job location</h5>
            <div class="col-sm-4">
                <label for="">City / Region</label>
                <select required name="city_id" id="city" class="form-select select2">
                    <option value="">Select any</option>
                    @foreach ($cities as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                    {{-- to be implemented: cities from your database --}}
                </select>
            </div>
            <div class="col-sm-4">
                <label for="district">District</label>
                <select required name="district_id" id="district" class="form-select select2">
                </select>
            </div>
            <div class="col-sm-4">

            </div>
            <div class="row my-4">
                <div class="mb-3">
                    <label for="about" class="form-label">Job Description</label>
                    <textarea required class="form-control" name="description" id="about" rows="3">
                    <p>Write down about the job position, let the candidate know what is expected of them</p>
                </textarea>
                </div>
            </div>
            <div class="row">
                <div class="mb-3">
                    <label for="req" class="form-label">Job Requirements</label>
                    <textarea required class="form-control" name="requirements" id="about" rows="3">
                    <p>Let people know the job requirements </p>
                </textarea>
                </div>
            </div>
            <div class="row">
                <div class="mb-3">
                    <label for="benefits" class="form-label">Job Benefits</label>
                    <textarea required class="form-control" name="benefits" id="about" rows="3">
                    <p>Let people know the benefits for this job position</p>
                </textarea>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    post job
                </button>
            </div>
    </form>
    <script>
        $('#city').on('change', function() {
            var cityId = $(this).val();
            $.ajax('/get-districts', {
                data: {
                    // _token: '{{ csrf_token() }}',
                    city_id: cityId
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#district').empty();
                    $.each(data, function(index, district) {
                        $('#district').append('<option value="' + district.id + '">' +
                            district.name + '</option>');
                    });
                }
            });
        });
    </script>
@endsection
