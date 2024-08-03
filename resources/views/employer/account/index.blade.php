@extends('employer.layout')
@section('content')
    @use(Carbon\Carbon)
    @php
        $user = auth('employer')->user();
    @endphp
    <div>
        <!-- Order your soul. Reduce your wants. - Augustine -->
        account page
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="{{ $user->photo }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image" />

                        <h4 class="mb-0 mt-2">{{ auth('employer')->user()->full_name }}</h4>
                        <p class="text-muted font-14">{{ auth('employer')->user()->username }}</p>

                        <div class="text-start mt-3">
                            <p class="text-muted mb-2 font-13"><strong>Full Name :</strong>
                                <span class="ms-2">
                                    {{ auth('employer')->user()->full_name }}
                                </span>
                            </p>

                            <p class="text-muted mb-2 font-13"><strong>Mobile :</strong>
                                <span class="ms-2">
                                    {{ auth('employer')->user()->phone_number }}
                                </span>
                            </p>

                            <p class="text-muted mb-2 font-13"><strong>Email :</strong>
                                <span class="ms-2 ">
                                    {{ auth('employer')->user()->email }}
                                </span>
                            </p>
                            <p class="text-muted mb-2 font-13"><strong>Joined on :</strong>
                                <span class="ms-2 ">
                                    {{ Carbon::parse(auth('employer')->user()->created_at)->format('l, d M Y') . ' (' . Carbon::parse(auth('employer')->user()->created_at)->longRelativeDiffForHumans() . ')' }}
                                </span>
                            </p>
                        </div>

                        <ul class="social-list list-inline mt-3 mb-0 d-none">
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i
                                        class="mdi mdi-facebook"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i
                                        class="mdi mdi-google"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-info text-info"><i
                                        class="mdi mdi-twitter"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i
                                        class="mdi mdi-github"></i></a>
                            </li>
                        </ul>
                    </div> <!-- end card-body -->
                </div>
                <div class="card pb-1">
                    <div class="card-title text-capitalize text-center">
                        reset password
                    </div>
                    <form id="reset-password" method="POST">
                        @csrf
                        {{-- @method('PUT') --}}
                        <div class="card-body">
                            <div id="error" style="display: none;" class="alert alert-danger" role="alert">

                            </div>
                            <div class="form-outline mb-3" data-mdb-input-init>
                                <input required type="text" class="form-control form-control-sm" name="c_password"
                                    id="c_password" aria-describedby="helpId" placeholder="" />
                                <label for="c_password" class="form-label">Current password</label>
                            </div>
                            <div class="form-outline mb-3" data-mdb-input-init>
                                <input required type="text" class="form-control form-control-sm" name="password"
                                    id="password" aria-describedby="helpId" placeholder="" />
                                <label for="password" class="form-label">New password</label>
                            </div>
                            <div class="form-outline mb-3" data-mdb-input-init>
                                <input required type="text" class="form-control form-control-sm"
                                    name="password_confirmation" id="password_confirmation" aria-describedby="helpId"
                                    placeholder="" />
                                <label for="password_confirmation" class="form-label">Confirm new password</label>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">update password</button>
                                </div>
                            </div>
                    </form>
                </div> <!-- end card-body -->
            </div>
        </div>
        <div class="col-xl-8 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @if ($errors->any())
                            <div class="alert alert-danger text-center" role="alert">
                                <ul class="list-unstyled mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('my-account.update') }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="col-12">
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="first_name">First name</label>
                                    <div class="col-md-9">
                                        <input required type="text" class="form-control" id="first_name"
                                            name="first_name" value="{{ $user?->first_name }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="last_name">Last name</label>
                                    <div class="col-md-9">
                                        <input required type="text" class="form-control" id="last_name"
                                            name="last_name" value="{{ $user?->last_name }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="username">Username</label>
                                    <div class="col-md-9">
                                        <input required type="text" class="form-control" id="username"
                                            name="username" value="{{ $user?->username }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="email">Email</label>
                                    <div class="col-md-9">
                                        <input required type="text" class="form-control" id="email"
                                            name="email" value="{{ $user?->email }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="phone_number">Phone number</label>
                                    <div class="col-md-9">
                                        <input required type="text" class="form-control" id="phone_number"
                                            name="phone_number" value="{{ $user?->phone_number }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="gender" class="col-md-3 col-form-label">Gender</label>
                                    <div class="col-md-9">
                                        <select required class="form-select" name="gender" id="gender">
                                            <option selected value="">Select Any</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="password"> </label>
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-primary">update</button>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </form>

                        <p class="text-muted mb-2 font-13"><strong>Last updated at :</strong>
                            <span class="ms-2 ">
                                {{ Carbon::parse(auth('employer')->user()->updated_at)->format('l, d M Y') . ' (' . Carbon::parse(auth('employer')->user()->updated_at)->longRelativeDiffForHumans() . ')' }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- 
    <div>
    <div class="mb-4 d-flex justify-content-center">
        <img id="selectedImage" src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg"
        alt="example placeholder" style="width: 300px;" />
    </div>
    <div class="d-flex justify-content-center">
        <div data-mdb-ripple-init class="btn btn-primary btn-rounded">
            <label class="form-label text-white m-1" for="customFile1">Choose file</label>
            <input type="file" class="form-control d-none" id="customFile1" onchange="displaySelectedImage(event, 'selectedImage')" />
        </div>
    </div>
</div> 
    --}}
    <script>
        $('select[name="gender"]').val('{{ $user?->gender }}');
        const $loader = '<span id="btn-icon" class="fas fa-spinner fa-spin me-2"></span>';

        $('form#reset-password').on('submit', function(event) {
            event.preventDefault();
            $('form#reset-password :submit').html($loader + 'validating...').addClass('disabled');
            $.ajax({
                url: '{{ route('employer.reset_password') }}',
                type: 'PUT',
                data: $(this).serialize(),
                success: function(response) {
                    $('#error').hide();
                    if (response.success) {
                        window.location.href = response.url;
                    }
                },
                error: function(xhr, status, error) {
                    $('#error').html('').show();
                    console.log(error, xhr);
                    if (xhr.responseJSON.errors) {
                        for (let key in xhr.responseJSON.errors) {
                            $('#error').append('<p>' + xhr.responseJSON.errors[key] + '</p>');
                        }
                    }
                    $('form#reset-password :submit').html('').text('update password').removeClass(
                        'disabled');
                },
            });
        });

        function displaySelectedImage(event, elementId) {
            const selectedImage = document.getElementById(elementId);
            const fileInput = event.target;

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    selectedImage.src = e.target.result;
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>
@endsection
