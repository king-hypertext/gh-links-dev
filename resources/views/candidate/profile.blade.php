@extends('candidate.layout')
@section('content')
    @php
        $user = auth('candidate')->user();
    @endphp
    <div class="container">
        <h5 class="h5 text-uppercase fw-semibold">
            my profile
        </h5>
        <div class="overview-container">
            @session('incomplete')
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Profile: </strong> {{ session('incomplete') }}
            </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger text-start" role="alert">
                    <ul class="list-unstyled mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div id="response" style="display: none;" class="alert alert-danger text-start" role="alert">
            </div>
            <form id="basic_info" autocomplete="off" action="{{ route('candidate.profile.store') }}"
                enctype="multipart/form-data" method="post">
                @csrf
                <input type="hidden" name="basic_info" value="basic_info" autocomplete="off" />
                <div class="row">
                    <h6 class="h6 text-capitalize fw-bold">basic information</h6>
                    <div class="col-sm-4">
                        <label for="first_name">First Name <span class="text-danger fw-bold">*</span></label>
                        <input required type="text" value="{{ $user->candidate?->first_name }}" class="form-control"
                            name="first_name" id="first_name" />
                    </div>
                    <div class="col-sm-4">
                        <label for="last_name">Last Name <span class="text-danger fw-bold">*</span></label>
                        <input required type="text" value="{{ $user->candidate?->last_name }}" class="form-control"
                            name="last_name" id="last_name" />
                    </div>
                    <div class="col-sm-4">
                        <label for="gender">Gender <span class="text-danger fw-bold">*</span></label>
                        <select required name="gender" id="gender" class="form-select">
                            <option value="">select gender</option>
                            <option {{ $user->candidate?->gender == 'male' ? 'selected' : '' }} value="male">Male
                            </option>
                            <option {{ $user->candidate?->gender == 'female' ? 'selected' : '' }} value="female">Female
                            </option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="marital_status">Marital Status <span class="text-danger fw-bold">*</span></label>
                        <select required name="marital_status" id="marital_status" class="form-select">
                            <option value="">select marital status</option>
                            <option {{ $user->candidate?->marital_status == 'single' ? 'selected' : '' }} value="single">
                                Single
                            </option>
                            <option {{ $user->candidate?->marital_status == 'married' ? 'selected' : '' }} value="married">
                                Married
                            </option>
                            <option {{ $user->candidate?->marital_status == 'divorced' ? 'selected' : '' }}
                                value="divorced">
                                Divorced</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="date_of_birth">Birth Date <span class="text-danger fw-bold">*</span></label>
                        <input required type="date" max="{{ Date('Y-m-d') }}"
                            value="{{ $user->candidate?->date_of_birth }}" class="form-control" name="date_of_birth"
                            id="date_of_birth" />
                    </div>
                    <div class="col-sm-4">
                        <label for="location">Location <span class="text-danger fw-bold">*</span></label>
                        <input required type="text" value="{{ $user->candidate?->location }}" class="form-control"
                            name="location" id="location" />
                    </div>
                    <div class="col-sm-4">
                        <label for="website_url">Personal Website</label>
                        <input type="url" value="{{ $user->candidate?->website_url }}" class="form-control"
                            name="website_url" id="website_url" />
                    </div>
                    <div class="col-sm-4">
                        <label for="profession">Your Profession <span class="text-danger fw-bold">*</span></label>
                        <input required type="text" class="form-control" name="profession"
                            placeholder="e.g. graphic designer" value="{{ $user->candidate?->profession }}"
                            id="profession" />
                    </div>
                    <div class="col-sm-4">
                        <label for="started_at">Work Experience <span class="text-danger fw-bold">*</span></label>
                        <input type="number" value="{{ $user->candidate?->experience }}" required name="experience"
                            id="experience" class="form-control" placeholder="years of working experience" />
                    </div>
                    <div class="col-sm-6">
                        <label for="dp">Upload your profile picture (max-size: 2MB)
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input {{ $user->candidate?->dp == null ? 'required' : '' }} type="file"
                            class="form-control form-file-input" name="dp" id="dp"
                            accept=".png,.jpeg,.jpg,.webp" />
                    </div>
                    <div class="col-sm-6">
                        <img src="{{ $user?->candidate ? url($user?->candidate->dp) : asset('app/plugins/icons/svgs/solid/user.svg') }}"
                            alt="dp" width="100" height="100" id="profile-picture"
                            class="img-thumbnail mt-3" />
                    </div>
                </div>
                <div class="form-group my-3">
                    <button type="submit" class="btn btn-primary">save</button>
                </div>
            </form>
            <form id="edu_info" action="{{ route('candidate.profile.store') }}" method="post">
                @csrf
                <input type="hidden" name="edu_info" value="edu_info" />
                <div class="row mt-3">
                    <h6 class="h6 text-capitalize fw-bold">education infomation</h6>
                    <div class="col-sm-4">
                        <label for="institution_name">Institution Name <span class="text-danger fw-bold">*</span></label>
                        <input required type="text" value="{{ $user->candidate?->education?->institution_name }}"
                            class="form-control" name="institution_name" id="institution_name" />
                    </div>
                    <div class="col-sm-4">
                        <label for="institution_location">Location <span class="text-danger fw-bold">*</span></label>
                        <input required type="text" class="form-control"
                            value="{{ $user->candidate?->education?->institution_location }}" name="institution_location"
                            id="institution_location" />
                    </div>
                    <div class="col-sm-4">
                        <label for="first_name">Institution Type <span class="text-danger fw-bold">*</span></label>
                        <select required name="level" id="level" class="form-select">
                            <option value="">select type</option>
                            <option {{ $user->candidate?->education?->level == 'university' ? 'selected' : '' }}
                                value="university">
                                University</option>
                            <option {{ $user->candidate?->education?->level == 'college' ? 'selected' : '' }}
                                value="college">
                                College</option>
                            <option {{ $user->candidate?->education?->level == 'high school' ? 'selected' : '' }}
                                value="high school">High School</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="started_at">Date Started <span class="text-danger fw-bold">*</span></label>
                        <input required type="date" max="{{ Date('Y-m-d') }}"
                            value="{{ $user->candidate?->education?->started_at }}" class="form-control"
                            name="started_at" id="started_at" />
                    </div>
                    <div class="col-sm-4">
                        <label for="ended_at">Date Completed <span class="text-danger fw-bold">*</span></label>
                        <input required type="date" max="{{ Date('Y-m-d') }}"
                            value="{{ $user->candidate?->education?->ended_at }}" class="form-control" name="ended_at"
                            id="ended_at" />
                    </div>
                </div>
                <div class="form-group my-3">
                    <button type="submit" class="btn btn-primary">save</button>
                </div>
            </form>
            <form id="job_exp" action="{{ route('candidate.profile.store') }}" method="post">
                @csrf
                <input type="hidden" name="job_exp" value="job_exp" />
                <div class="row mt-3">
                    <h6 class="h6 text-capitalize fw-bold">previous job experience (optional)</h6>
                    <div class="col-sm-4">
                        <label for="company_name">Company Name
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input required type="text" class="form-control"
                            value="{{ $user->candidate?->job_experience?->company_name }}" name="company_name"
                            id="company_name" />
                    </div>
                    <div class="col-sm-4">
                        <label for="location">Location
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input required type="text" class="form-control"
                            value="{{ $user->candidate?->job_experience?->location }}" name="job_location"
                            id="job_location" />
                    </div>
                    <div class="col-sm-4">
                        <label for="position">Your Role / Position
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input required type="text" class="form-control" name="position"
                            value="{{ $user->candidate?->job_experience?->position }}" id="position" />
                    </div>
                    <div class="col-sm-4">
                        <label for="job_description">Job Description
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input required type="text" class="form-control" name="job_description"
                            value="{{ $user->candidate?->job_experience?->job_description }}" id="job_description" />
                    </div>
                    <div class="col-sm-4">
                        <label for="started_at">Date Started
                            <span class="text-danger fw-bold">*</span>
                        </label>
                        <input required type="date" max="{{ Date('Y-m-d') }}" class="form-control"
                            name="job_started_at" value="{{ $user->candidate?->job_experience?->started_at }}"
                            id="started_at" />
                    </div>
                    <div class="col-sm-4">
                        <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input mt-2"
                                {{ $user->candidate?->job_experience?->is_current == 1 ? 'checked' : '' }} type="checkbox"
                                name="is_current" id="is_current" value="1" />
                            <label class="form-check-label" for="is_current">Your Current Job?</label>
                        </div>
                    </div>
                </div>
                <div class="form-group my-3">
                    <button type="submit" class="btn btn-primary">save</button>
                </div>
            </form>
            <form id="biography" action="{{ route('candidate.profile.store') }}" method="post">
                @csrf
                <input type="hidden" name="biography" value="biography" />
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <h6 class="h6 text-capitalize fw-bold">biography <span class="text-danger fw-bold">*</span></h6>
                        <textarea required name="biography" id="biography">
                        {{ $user->candidate?->biography }}
                    </textarea>
                    </div>
                </div>
                <div class="form-group my-3">
                    <button type="submit" class="btn btn-primary">save</button>
                </div>
            </form>
            <form id="cv_upload" action="{{ route('candidate.profile.store') }}" enctype="multipart/form-data"
                method="post">
                @csrf
                <input type="hidden" name="cv_upload" value="cv_upload">
                <div class="row my-5">
                    <div class="col-sm-4">
                        <label for="cv">Upload your cv/resume <span class="text-danger fw-bold">*</span></label>
                        <input required type="file" class="form-control form-file-input" name="cv"
                            id="cv" accept=".pdf" />
                    </div>
                    <div class="col-sm-4">
                        <label for="">Uploaded CV</label>
                        <br />
                        @if ($user->candidate?->resume)
                            <i class="fas fa-check-double"></i>
                            <a download="false" href="{{ $user->candidate?->resume->cv }}" target="_blank"
                                rel="noopener noreferrer">Download CV</a>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">upload</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            const $loader = '<span id="btn-icon" class="fas fa-spinner fa-spin me-2"></span>';
            const $response = $('#response');
            $('form#basic_info').on('submit', function(e) {
                e.preventDefault();
                $('#basic_info :submit').addClass('disabled').html(`${$loader} saving data...`);
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        console.log(response);
                        if (response.success) {
                            window.location.reload();
                            window.open(response.url, '_self');
                        }
                    },
                    error: function(error) {
                        console.log('Error:', error);
                        if (error.status === 422) {
                            const response = error.responseJSON.errors;
                            var ErrorList = '';
                            Object.keys(response).map(error => {
                                ErrorList += `<li>${response[error][0]}</li>`;
                            });
                            const errorMessage = `
                                        <ul class="list-unstyled mb-0">
                                            ${ErrorList}
                                        </ul>
                                    `;
                            $response.show().html(errorMessage);
                        } else if (error.status === 500) {
                            $response.show().text('An unexpected error occurred');
                        }
                        $('#basic_info :submit').text('save').removeClass('disabled');
                    }
                });
            });
            $('form#edu_info').on('submit', function(e) {
                $('form#edu_info :submit').addClass('disabled').html(`${$loader} saving data...`);
                return 1;
            });
            $('form#job_exp').on('submit', function(e) {
                $('form#job_exp :submit').addClass('disabled').html(`${$loader} saving data...`);
                return 1;
            });
            $('form#biography').on('submit', function(e) {
                $('form#biography :submit').addClass('disabled').html(`${$loader} saving data...`);
                return 1;
            });
            $('form#cv_upload').on('submit', function(e) {
                $('form#cv_upload :submit').addClass('disabled').html(`${$loader} saving data...`);
                return 1;
            });
            // $('form').on('submit',function(e){});
            tinymce.init({
                selector: 'textarea[name="biography"]',
                height: 300,
                menubar: false,
                toolbar: 'undo redo | blocks | insert |' +
                    'alignleft aligncenter alignright alignjustify | ' +
                    'bullist numlist'
            });
            $('#dp').change(function() {
                var file = this.files[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#profile-picture').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            })
        });
    </script>
@endsection
