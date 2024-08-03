@extends('employer.layout')
<!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
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
    <form id="post-job" method="POST" action="{{ route('my-jobs.update', $job->id) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="company_id" value="{{ $job->company_id }}">
        {{-- name, email adress, location --}}
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="title" class="form-label">Job Title</label>
                    <input required type="text" name="title" value="{{ $job->title }}" id="title"
                        class="form-control" placeholder="" aria-describedby="helpId" />
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="type" class="form-label">Job Type</label>
                    <select required name="type" id="type" class="form-select select2">
                        <option value="">Select any </option>
                        <option value="full-time">Full Time</option>
                        <option value="part-time">Part Time</option>
                        <option value="contract">Contract</option>
                        <option value="intenship">Intenship</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <label for="entry_id" class="form-label">Job Skill Level</label>
                    <select name="entry_id" id="entry_id" class="form-select select2">
                        <option value="">Select any</option>
                        @foreach ($job_experiences as $je)
                            <option value="{{ $je->id }}">{{ $je->level }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        {{-- salary info --}}
        <div class="row my-2">
            {{-- <h5 class="h3 fs-5 text-capitalize fw-bold">Salary Info</h5> --}}
            <div class="col-sm-4">
                <div class="mb-3">
                    <label for="min_salary" class="form-label">Minimum Salary</label>
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">GHS</span>
                        <input required type="number" min="10" value="{{ $job->min_salary }}" name="min_salary"
                            id="min_salary" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label for="max_salary" class="form-label">Maximum Salary</label>
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">GHS</span>
                        <input required type="number" name="max_salary" value="{{ $job->max_salary }}" id="max_salary"
                            class="form-control" />
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
            {{-- <h5 class="h3 fs-5 text-capitalize fw-bold">advanced job information</h5> --}}
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
                    <option value="N/A">None</option>
                    <option value="1+">1+ years</option>
                    <option value="3+">3+ years</option>
                    <option value="5+">5+ years</option>
                </select>
            </div>
            <div class="col-sm-4">
                <label for="open_vacancies">Open Vacancies</label>
                <input required class="form-control" type="number" value="1" name="open_vacancies" />
            </div>
        </div>
        <div class="row my-4">
            {{-- <h5 class="h3 fs-5 text-capitalize fw-bold">job location</h5> --}}
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
            {{-- <div class="col-sm-4">
                <label for="district">District</label>
                <select required name="district_id" id="district" class="form-select select2">
                </select>
            </div> --}}
        </div>
        <div class="row my-4">
            <label for="">Skill Sets</label>
            <div class="d-flex flex-wrap">
                @forelse ($tags as $tag)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="tag_id[]" type="checkbox" id="{{ $tag->name }}"
                            value="{{ $tag->id }}" {{ in_array($tag->id, $job_tag_ids) ? 'checked' : '' }} />
                        <label class="form-check-label" for="{{ $tag->name }}">{{ ucwords($tag->name) }}</label>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
        <div class="row my-4">
            <div class="mb-3">
                <label for="about" class="form-label">Job Description</label>
                <textarea required class="form-control" name="description" id="about" rows="3">                   
                    {!! $job->description !!}
                </textarea>
            </div>
        </div>
        <div class="row">
            <div class="mb-3">
                <label for="req" class="form-label">Job Requirements</label>
                <textarea required class="form-control" name="requirements" id="about" rows="3">
                    {!! $job->requirements !!}
                </textarea>
            </div>
        </div>
        <div class="row">
            <div class="mb-3">
                <label for="benefits" class="form-label">Job Benefits</label>
                <textarea required class="form-control" name="benefits" id="about" rows="3">
                    {!! $job->benefits !!}
                </textarea>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                update job
            </button>
        </div>
    </form>
    <script>
        $('select[name="type"]').val('{{ $job->type }}');
        $('select[name="entry_id"]').val('{{ $job->entry_id }}');
        $('select[name="salary_id"]').val('{{ $job->salary_id }}');
        $('select[name="education_id"]').val('{{ $job->education_id }}');
        $('select[name="min_experience"]').val('{{ $job->min_experience }}');
        $('select[name="city_id"]').val('{{ $job->city_id }}');
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
