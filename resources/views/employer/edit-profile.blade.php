@extends('employer.layout')
@section('content')
    @php
        $employer = auth('employer')->user();
    @endphp
    <!-- Tabs navs -->
    {{-- @dd($employer->profile->organization) --}}
    @session('success')
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Congratulations!</strong> {{ session('success') }}
    </div>
    @endif
    @session('incomplete')
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Profile: </strong> {{ session('incomplete') }}
    </div>
    @endif
    <div id="error" style="display: none;" class="alert alert-danger alert-dismissible fade show" role="alert">
    </div>

    <ul class="nav nav-tabs mb-3" id="account-setup" role="tablist">
        <li class="nav-item" role="presentation">
            <a data-mdb-tab-init class="nav-link active" id="account-setup-tab-1" href="#account-setup-tabs-1"
                role="tab" aria-controls="account-setup-tabs-1" aria-selected="true">
                <i class="fa-solid fa-address-card fa-fw me-2"></i> Company Info
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a data-mdb-tab-init class="nav-link" id="account-setup-tab-2" href="#account-image-upload" role="tab"
                aria-controls="account-image-upload" aria-selected="false"><i
                    class="fa-regular fa-circle-user fa-fw me-2"></i>Image uploads</a>
        </li>
    </ul>
    <!-- Tabs navs -->
    <style>
        .file-input {
            position: relative;
            display: inline-block;
            width: 100% !important;
        }

        .file-input input[type="file"] {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
        }

        .file-input label {
            display: flex;
            align-items: center;
            align-content: flex-start;
            justify-content: flex-start;
            flex-direction: column;
            /* margin: 0 auto; */
            width: fit-content;
            padding: 10px 5px 0 5px;
            background: #f9f9f9;
            border: 2px dashed #ababab;
            border-radius: 5px;
            cursor: pointer;
        }

        .file-icon {
            font-size: 24px;
            margin-right: 10px;
        }

        .file-label {
            font-size: 16px;
            color: #666;
        }

        .file-input:hover label {
            background: #f2f2f2;
        }

        .file-input:focus label {
            box-shadow: 0 0 0 2px #333;
        }
    </style>
    <!-- Tabs content -->
    <div class="tab-content" id="account-setup-content">
        <div class="tab-pane fade show active" id="account-setup-tabs-1" role="tabpanel"
            aria-labelledby="account-setup-tab-1">
            <form id="comp_info" method="POST">
                @csrf
                <input type="hidden" name="employer_id" value="{{ auth('employer')->id() }}">
                {{-- name, email adress, location --}}
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input required type="text" name="company_name"
                                value="{{ $employer->profile?->company_name }}" id="company_name" class="form-control"
                                placeholder="" aria-describedby="helpId" />
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="company_location" class="form-label">Location</label>
                            <input required type="text" name="company_location"
                                value="{{ $employer->profile?->company_location }}" id="company_location"
                                class="form-control" placeholder="" aria-describedby="helpId" />
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="company_email" class="form-label">Email address</label>
                            <input required type="email" value="{{ $employer->profile?->company_email }}"
                                name="company_email" id="company_email" class="form-control" placeholder="" />
                        </div>
                    </div>
                </div>
                {{--  --}}
                <div class="row my-2">
                    <h5 class="h5 text-capitalize">Company Founding Info</h5>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="organization_id" class="form-label">Organization Type</label>
                            <select required name="organization_id" id="organization_id" class="form-select select2">
                                <option
                                    value="{{ $employer->profile?->organization ? $employer->profile?->organization?->id : '' }}">
                                    {{ $employer->profile?->organization ? $employer->profile?->organization?->name : 'Select any' }}
                                </option>
                                @foreach ($organization_types as $ot)
                                    <option value="{{ $ot->id }}">{{ $ot->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="industry_id" class="form-label">Industry Type</label>
                            <select required name="industry_id" id="industry_id" class="form-select select2">
                                <option
                                    value="{{ $employer->profile?->industry ? $employer->profile?->industry?->id : '' }}">
                                    {{ $employer->profile?->industry ? $employer->profile?->industry?->name : 'Select any' }}
                                </option>
                                @foreach ($industry_types as $it)
                                    <option value="{{ $it->id }}">{{ $it->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="company_size" class="form-label">Company Size</label>
                            <input required type="number" value="{{ $employer->profile?->company_size }}"
                                name="company_size" id="company_size" class="form-control" placeholder=""
                                aria-describedby="helpId" />
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="company_founding_year" class="form-label">Year of Establishment</label>
                            <input required type="date" value="{{ $employer->profile?->company_founding_year }}"
                                name="company_founding_year" id="company_founding_year" class="form-control"
                                placeholder="" />
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="company_website" class="form-label">Company Website</label>
                            <input required type="url" value="{{ $employer->profile?->company_website }}"
                                name="company_website" id="company_website" class="form-control" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="about" class="form-label">About Us</label>
                        <textarea required class="form-control" name="company_description" id="about" rows="3">
                            {{ $employer->profile?->company_description ? $employer->profile?->company_description : '<p>Write down about your company, let the candidate know who you are...</p>' }}
                        </textarea>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="company_vision" class="form-label">Company Vision</label>
                        <textarea required class="form-control" name="company_vision" id="company_vision" rows="3">
                            {{ $employer->profile?->company_vision ? $employer->profile?->company_vision : '<p>Let people know your vision...</p>' }}
                        </textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    {{ $employer->profile ? 'update' : 'save' }}
                </button>
            </form>
        </div>
        <div class="tab-pane fade" id="account-image-upload" role="tabpanel" aria-labelledby="account-setup-tab-2">
            <div class="row mb-3">
                <div id="error" style="display: none;" class="alert alert-danger" role="alert">
                </div>

                <div class="col-sm-5">
                    <label for="logo" class="form-label">Upload Logo</label>
                    <div class="file-upload">
                        <div class="file-input">
                            <input required type="file" accept=".jpg,.jpeg,.png,.webp,.bmp" id="logo"
                                name="logo" />
                            <label for="logo">
                                <div class="file-icon">
                                    <i class="fa-solid fa-cloud-arrow-up fa-2xl"></i>
                                </div>
                                <div class="file-label">click to upload image</div>
                                <p style="font-size: 10px;" class="b-0 m-0">
                                    Supported format are PNG, JPEG, WEBP, JPG, and BMP.
                                </p>
                                <p style="font-size: 10px;" class="b-0 m-0"> Max size is 2MB.</p>
                            </label>
                        </div>
                        <div id="f-logo" class="progress mt-3" style="height: 12px;display: none;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100">0%</div>
                        </div>
                        <div style="display: none!important;"
                            class="uploaded-file f-logo d-flex flex-row align-items-center justify-content-center mt-2">
                            <img width="65" height="auto" src="#" alt="" id="img-logo"
                                class="img-thumbnail" />
                            <i class="fa fa-check"></i>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <label for="banner" class="form-label">Upload Banner Image</label>
                    <div class="file-upload">
                        <div class="file-input">
                            <input required type="file" accept=".jpg,.jpeg,.png,.webp,.bmp" id="banner"
                                name="banner">
                            <label for="banner">
                                <div class="file-icon">
                                    <i class="fa-solid fa-cloud-arrow-up fa-2xl"></i>
                                </div>
                                <div class="file-label">click to upload image</div>
                                <span style="font-size: 10px;" class="b-0 m-0">
                                    Supported format are PNG, JPEG, WEBP, JPG, and BMP.
                                    <p style="font-size: 10px;" class="b-0 m-0"> Max size is 4MB.</p>
                                </span>
                            </label>
                        </div>
                        <div id="banner" class="progress mt-3" style="height: 12px;display: none;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100">0%</div>
                        </div>
                        <div class="uploaded-file banner">
                            <div style="display: none!important;"
                                class="uploaded-file f-banner d-flex flex-row align-items-center justify-content-center mt-2">
                                <img width="65" height="auto" src="#" alt="" id="img-banner"
                                    class="img-thumbnail" />
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs content -->
        <script type="text/javascript">
            $(document).ready(function() {
                const $error = $('#error');
                const $success = $('#success');
                $('input[name="logo"]').change(function() {
                    // alert('file uploaded');
                    var file = this.files[0];
                    var formData = new FormData();
                    formData.append('logo', file);
                    console.log(formData, file);
                    formData.append('_token', '{{ csrf_token() }}');
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('employer.profile.upload-images') }}',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        xhr: function() {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener('progress', function(event) {
                                var percent = (event.loaded / event.total * 100).toFixed(2);
                                $('.progress#f-logo').show();
                                $('.progress-bar').css('width', percent + '%').html(
                                    percent + '%');
                            }, false);
                            return xhr;
                        },
                        success: function(data) {
                            $('.uploaded-file.f-logo').show();
                            $('#img-logo').attr('src', data.file);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                });
                $('input[name="banner"]').change(function() {
                    // alert('file uploaded');
                    var file = this.files[0];
                    var formData = new FormData();
                    formData.append('banner', file);
                    formData.append('_token', '{{ csrf_token() }}');
                    console.log(formData, file);
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('employer.profile.upload-images') }}',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        xhr: function() {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener('progress', function(event) {
                                var percent = (event.loaded / event.total * 100).toFixed(2);
                                $('.progress#banner').show();
                                $('.progress-bar').show().css('width', percent + '%').html(
                                    percent + '%');
                            }, false);
                            return xhr;
                        },
                        success: function(data) {
                            $('.uploaded-file.banner').append('<p>File uploaded successfully</p>');
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                });
                // Submit form
                const $loader = '<span id="btn-icon" class="fas fa-spinner fa-spin me-2"></span>';

                $('form#comp_info').on('submit', function(e) {
                    // alert('form data loaded');
                    $('form#comp_info :submit').addClass('disabled').html($loader + 'processing...');
                    e.preventDefault();
                    var formData = $(this).serialize();
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('employer.company-profile.save') }}',
                        data: formData,
                        // cache: false,
                        // contentType: false,
                        // processData: false,
                        success: function(data) {
                            if (data.success) {
                                window.location.href = data.next_tab;
                            }
                        },
                        error: function(error) {
                            $("html, body").animate({
                                scrollTop: 0
                            }, 10);
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
                                </ul>`;
                                $error.show().html(errorMessage);
                            } else if (error.status === 403) {
                                $error.show().text(error.responseText);
                            } else if (error.status === 500) {
                                $error.show().text(error.statusText);
                            }
                            $('form#comp_info :submit').removeClass('disabled').text('Save');
                        }
                    });
                });
            });
        </script>
    @endsection
