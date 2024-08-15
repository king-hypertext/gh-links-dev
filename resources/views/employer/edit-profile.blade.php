@extends('employer.layout')
@section('content')
    @php
        $user = auth('employer')->user();
    @endphp
    <div class="container">
        <div class="overview-container">
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
            <div id="error" style="display: none;" class="alert alert-danger alert-dismissible fade show"
                role="alert">
            </div>
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
            <div class="row  my-3 shadow-3 py-2">
                <form id="comp_info" method="POST">
                    @csrf
                    <input type="hidden" name="employer_id" value="{{ auth('employer')->id() }}">
                    {{-- name, email adress, location --}}
                    <h6 class="h4 text-capitalize fw-bold">profile setup</h6>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="company_name" class="form-label">Company Name
                                    <span class="fw-bold text-danger">*</span>
                                </label>
                                <input required type="text" name="company_name"
                                    value="{{ $user->employer?->company_name }}" id="company_name" class="form-control"
                                    placeholder="" aria-describedby="helpId" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="company_location" class="form-label">Location
                                    <span class="fw-bold text-danger">*</span>
                                </label>
                                <input required type="text" name="company_location"
                                    value="{{ $user->employer?->company_location }}" id="company_location"
                                    class="form-control" placeholder="" aria-describedby="helpId" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="company_email" class="form-label">Company Email Address
                                    <span class="fw-bold text-danger">*</span>
                                </label>
                                <input required type="email" value="{{ $user->employer?->company_email }}"
                                    name="company_email" id="company_email" class="form-control" placeholder="" />
                            </div>
                        </div>
                    </div>
                    {{--  --}}
                    <div class="row my-2">
                        {{-- <h5 class="h5 text-capitalize">Company Founding Info</h5> --}}
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="organization_id" class="form-label">Organization Type</label>
                                <select required name="organization_id" id="organization_id" class="form-select select2">
                                    <option
                                        value="{{ $user->employer?->organization ? $user->employer?->organization?->id : '' }}">
                                        {{ $user->employer?->organization ? $user->employer?->organization?->name : 'Select any' }}
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
                                        value="{{ $user->employer?->industry ? $user->employer?->industry?->id : '' }}">
                                        {{ $user->employer?->industry ? $user->employer?->industry?->name : 'Select any' }}
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
                                <input required type="number" value="{{ $user->employer?->company_size }}"
                                    name="company_size" id="company_size" class="form-control" placeholder=""
                                    aria-describedby="helpId" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="company_founding_year" class="form-label">Year of Establishment</label>
                                <input required type="date" value="{{ $user->employer?->company_founding_year }}"
                                    name="company_founding_year" id="company_founding_year" class="form-control"
                                    placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="company_website" class="form-label">Company Website</label>
                                <input type="text" value="{{ $user->employer?->company_website }}"
                                    name="company_website" id="company_website" class="form-control" placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="about" class="form-label">About Us</label>
                            <textarea required class="form-control" name="company_description" id="about" rows="3">
                            {{ $user->employer?->company_description ? $user->employer?->company_description : '<p>Write down about your company, let the candidate know who you are...</p>' }}
                        </textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="company_vision" class="form-label">Company Vision</label>
                            <textarea required class="form-control" name="company_vision" id="company_vision" rows="3">
                            {{ $user->employer?->company_vision ? $user->employer?->company_vision : '<p>Let people know your vision...</p>' }}
                        </textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary my-3">
                        {{ $user->employer ? 'update' : 'save & next' }}
                    </button>
                </form>
            </div>
            @if ($user->employer)
                <div class="row my-3 shadow-3 py-2">
                    <h6 class="h4 text-capitalize fw-bold" id="verify-business">business registration credentials</h6>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="reg_certificate_number" class="form-label">Registeration Certificate
                                Number</label>
                            <input type="text" value="{{ $user->employer?->reg_certificate_number }}"
                                name="reg_certificate_number" id="reg_certificate_number" class="form-control"
                                placeholder="" />
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Document (pdf)</label>
                            <input type="file" class="form-control" name="" id="" placeholder=""
                                aria-describedby="fileHelpId" />
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="reg_certificate_number" class="form-label">Registeration Certificate
                                Number</label>
                            <input type="text" value="{{ $user->employer?->reg_certificate_number }}"
                                name="reg_certificate_number" id="reg_certificate_number" class="form-control"
                                placeholder="" />
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Document (pdf)</label>
                            <input type="file" class="form-control" name="" id="" placeholder=""
                                aria-describedby="fileHelpId" />
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="reg_certificate_number" class="form-label">Registeration Certificate
                                Number</label>
                            <input type="text" value="{{ $user->employer?->reg_certificate_number }}"
                                name="reg_certificate_number" id="reg_certificate_number" class="form-control"
                                placeholder="" />
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Document (pdf)</label>
                            <input type="file" class="form-control" name="" id="" placeholder=""
                                aria-describedby="fileHelpId" />
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <button type="button" class="btn btn-primary">
                            save
                        </button>
                    </div>
                </div>

                <div class="row my-3 shadow-3 py-2">
                    <h6 class="h4 text-capitalize fw-bold" id="social-media-links">social media links</h6>
                    <form id="social-media">
                        <div id="alert-4" style="display: " class="alert " role="alert">
                        </div>
                        @csrf
                        <div class="row">
                            @if ($user->employer->socialMediaAccounts->isNotEmpty())
                                @foreach ($user->employer->socialMediaAccounts as $link)
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="fb" class="form-label text-capitalize">
                                                facebook
                                            </label>
                                            {{-- <input type="hidden" name="name[]" value="fb" /> --}}
                                            <input type="url" name="fb" id="fb"
                                                value="{{ $link->fb !== null ? $link->fb : '' }}"
                                                placeholder="https://url" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="linkedin" class="form-label text-capitalize">
                                                linkedIn
                                            </label>
                                            {{-- <input type="hidden" name="name[]" value="linkedin"> --}}
                                            <input type="url" name="linkedin" id="linkedin"
                                                value="{{ $link->linkedin !== null ? $link->linkedin : '' }}"
                                                placeholder="https://url" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="instagram" class="form-label text-capitalize">
                                                instagram
                                            </label>
                                            {{-- <input type="hidden" name="name[]" value="instagram"> --}}
                                            <input type="url" name="instagram" id="instagram"
                                                value="{{ $link->instragram !== null ? $link->instragram : '' }}"
                                                placeholder="https://url" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="x" class="form-label text-capitalize">
                                                x(twitter)
                                            </label>
                                            {{-- <input type="hidden" name="name[]" value="x"> --}}
                                            <input type="url" name="x" id="x"
                                                value="{{ !is_null($link->x) ? $link->x : '' }}"
                                                placeholder="https://url" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="whatsapp" class="form-label text-capitalize">
                                                whatsapp
                                            </label>
                                            {{-- <input type="hidden" name="name[]" value="whatsapp"> --}}
                                            <input type="url" name="whatsapp" id="whatsapp"
                                                value="{{ $link->whatsapp !== null ? $link->whatsapp : '' }}"
                                                placeholder="https://url" class="form-control">
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="fb" class="form-label text-capitalize">
                                            facebook
                                        </label>
                                        {{-- <input type="hidden" name="name[]" value="fb" /> --}}
                                        <input type="url" name="fb" id="fb" placeholder="https://url"
                                            class="form-control" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="linkedin" class="form-label text-capitalize">
                                            linkedIn
                                        </label>
                                        {{-- <input type="hidden" name="name[]" value="linkedin"> --}}
                                        <input type="url" name="linkedin" id="linkedin" placeholder="https://url"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="instagram" class="form-label text-capitalize">
                                            instagram
                                        </label>
                                        {{-- <input type="hidden" name="name[]" value="instagram"> --}}
                                        <input type="url" name="instagram" id="instagram" placeholder="https://url"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="x" class="form-label text-capitalize">
                                            x(twitter)
                                        </label>
                                        {{-- <input type="hidden" name="name[]" value="x"> --}}
                                        <input type="url" name="x" id="x" placeholder="https://url"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="whatsapp" class="form-label text-capitalize">
                                            whatsapp
                                        </label>
                                        {{-- <input type="hidden" name="name[]" value="whatsapp"> --}}
                                        <input type="url" name="whatsapp" id="whatsapp" placeholder="https://url"
                                            class="form-control">
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="form-group my-3">
                            <button type="submit" class="btn btn-primary">
                                save
                            </button>
                        </div>
                    </form>
                </div>
                <div class="row my-3 shadow-3 py-2">
                    <h6 class="h4 text-capitalize fw-bold" id="phone-numbers">active phone numbers</h6>
                    <form id="add-contact">
                        <div id="alert-3" style="display: none;" class="alert" role="alert">
                        </div>

                        @csrf
                        {{-- <input type="hidden" name="contacts" value="contacts"> --}}
                        <div class="row" id="contact-block">
                            @if ($user->employer->phoneNumbers->isNotEmpty())
                                <input class="d-none" readonly name="row-count"
                                    value="{{ $user->employer->phoneNumbers->count() ?? 0 }}">
                                @foreach ($user->employer->phoneNumbers as $contact)
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="phone" class="form-label">
                                                phone number {{ $loop->iteration }}
                                            </label>
                                            <input required type="text" class="form-control" name="phone[]"
                                                id="phone" value="{{ $contact->number }}" />
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="phone" class="form-label">
                                            phone number
                                        </label>
                                        <input required type="text" class="form-control" name="phone[]"
                                            id="phone" />
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="form-group my-3">
                            <button type="submit" class="btn btn-primary">
                                save
                            </button>
                            <button type="button" class="btn btn-secondary" id="add-phone-field"
                                title="add more phone field">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="row my-3 shadow-3 py-2">
                    <div id="alert-2" style="display: none;" class="alert" role="alert">
                    </div>
                    <div class="col-auto">
                        <small>Logo Image</small>
                        <label for="logo"
                            class="form-label cursor-pointer d-flex align-items-center justify-content-center bg-secondary rounded-2 {{ $user->employer ? '' : 'd-none' }}"
                            style="cursor: pointer;width: 120px; height: 120px;" title="Click to upload image">
                            <img id="logo_img"
                                src="{{ $user->employer?->image?->logo ? url($user->employer->image->logo) : asset('app/plugins/icons/svgs/solid/cloud-arrow-up.svg') }}"
                                style="width: {{ $user->employer?->image?->logo ? 'auto' : '100px' }} !important;"
                                class="img-fluid {{ $user->employer?->image?->logo ? '' : 'bg-secondary' }}" />
                            <input type="file" class="form-control" name="logo" id="logo" accept="image/*"
                                aria-describedby="fileHelpId" style="display: none;" />
                        </label>
                    </div>
                    <div class="col-auto">
                        <small>Banner Image</small>
                        <label for="banner"
                            class="form-label cursor-pointer d-flex align-items-center justify-content-center bg-secondary shadow rounded-2 {{ $user->employer ? '' : 'd-none' }}"
                            style="cursor: pointer;width: 320px !important; height: 120px;" title="Click to upload image">
                            <img id="banner_img"
                                src="{{ $user->employer?->image?->banner ? url($user->employer->image->banner) : asset('app/plugins/icons/svgs/solid/cloud-arrow-up.svg') }}"
                                style="width: auto!important; height: 120px;"
                                class="img-fluid {{ $user->employer?->image?->banner ? '' : 'bg-secondary' }}" />
                            <input type="file" class="form-control" name="banner" id="banner" accept="image/*"
                                aria-describedby="fileHelpId" style="display: none;" />
                        </label>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- Tabs content -->
    <script type="text/javascript">
        $(document).ready(function() {
            const $error = $('#alert-2');
            const $success = $('#success');
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
            $('input[name="logo"]').change(function() {
                // alert('file uploaded');
                var file = this.files[0];
                var formData = new FormData();
                formData.append('logo', file);
                formData.append('_token', '{{ csrf_token() }}');
                console.log(formData, file, $(this).closest('img'));
                const allowedFileType = ['image/png', 'image/jpeg', 'image/jpg', 'image/webm', 'image/bmp'];
                if (!allowedFileType.includes(file.type)) {
                    $error.text('file type not allowed');
                    return $error.addClass('alert-danger').show();
                }
                $.ajax({
                    type: 'POST',
                    url: '{{ route('employer.profile.upload-images') }}',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $error.show().text('file uploaded successfully').addClass(
                            'alert-success');
                        $('img#logo_img').attr('src', data.file)
                        // return $('#upload-msg').addClass('alert-success').show();
                    },
                    error: function(error) {
                        console.log(error);
                        if (error.status == 500) {
                            return $error.show().text('server error').addClass('alert-danger');
                        }
                        $error.show().text(error.responseJSON.message).addClass('alert-danger');
                        // return $('#upload-msg').addClass('alert-danger').show();
                    }
                });
            });
            $('input[name="banner"]').change(function() {
                // alert('file uploaded');
                var file = this.files[0];
                var formData = new FormData();
                formData.append('banner', file);
                formData.append('_token', '{{ csrf_token() }}');
                console.log(formData, file, $(this).closest('img'));
                const allowedFileType = ['image/png', 'image/jpeg', 'image/jpg', 'image/webm', 'image/bmp'];
                if (!allowedFileType.includes(file.type)) {
                    $error.text('file type not allowed');
                    return $error.addClass('alert-danger').show();
                }
                $.ajax({
                    type: 'POST',
                    url: '{{ route('employer.profile.upload-images') }}',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $error.show().text('file uploaded successfully').addClass(
                            'alert-success');
                        $('img#banner_img').attr('src', data.file)
                        // return $('#upload-msg').addClass('alert-success').show();
                    },
                    error: function(error) {
                        console.log(error);
                        if (error.status == 500) {
                            return $error.show().text('server error').addClass('alert-danger');
                        }
                        $error.show().text(error.responseJSON.message).addClass('alert-danger');
                        // return $('#upload-msg').addClass('alert-danger').show();
                    }
                });
            });
            var row = parseInt($('input[name="row-count"]').val() ?? 0) + 1;
            $('button#add-phone-field').on('click', function(e) {
                var block = $('#contact-block');
                var content = `
                <div class="col-sm-4">
                        <div class="form-group">
                            <label for="phone_${row}" class="form-label">
                                phone number ${row}
                            </label>
                            <input type="text" class="form-control" name="phone[]" id="phone_${row}"/>
                        </div>
                    </div>
                `;
                if (row > 0 && row <= 4) {
                    block.append(content);
                    row++;
                } else {
                    alert('Maximum phone number must be 4')
                }
            });
            $('form#add-contact').on('submit', function(e) {
                e.preventDefault();
                const alert = $('#alert-3');
                let btn = $('form#add-contact :submit');
                btn.addClass('disabled').html($loader + 'saving data...');
                $.ajax('{{ route('employer.profile.store-contacts') }}', {
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(data) {
                        btn.removeClass('disabled').text('save');
                        alert.show().text(data.message).addClass('alert-success').removeClass(
                            'alert-danger');
                    },
                    error: function(error) {
                        btn.removeClass('disabled').text('save');
                        if (error.status == 500) {
                            alert.show().text('server error, please try again after some time.')
                                .addClass('alert-danger');
                        }
                        alert.show().text(error.responseJSON.message).addClass('alert-danger')
                            .removeClass('alert-success');
                    }
                });
            });
            $('form#social-media').on('submit', function(e) {
                e.preventDefault();
                const alert = $('#alert-4');
                let btn = $('form#social-media :submit');
                btn.addClass('disabled').html($loader + 'saving data...');
                $.ajax('{{ route('employer.profile.social-media-links') }}', {
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(data) {
                        btn.removeClass('disabled').text('save');
                        alert.show().text(data.message).addClass('alert-success').removeClass(
                            'alert-danger').removeClass('alert-warning');
                    },
                    error: function(error) {
                        btn.removeClass('disabled').text('save');
                        if (error.status == 500) {
                            alert.show().text('server error, please try again after some time.')
                                .addClass('alert-danger');
                        }
                        if (error.status == 422) {
                            console.log(error);

                            alert.show().text(error.message).addClass('alert-warning')
                                .removeClass('alert-danger');
                        }
                        alert.show().text(error.responseJSON.message).addClass('alert-danger')
                            .removeClass('alert-success');
                    }
                });
            });
        });
    </script>
@endsection
