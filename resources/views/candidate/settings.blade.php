@extends('candidate.layout')
@section('content')
    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
    @php
        $user = auth('candidate')->user();
    @endphp
    @use(Carbon\Carbon)

    <div class="container my-5">
        <h5 class="h5 text-uppercase fw-semibold">
            settings
        </h5>
        {{-- {{ $user }}
        {{ $user->profile }} --}}
        <div class="row">
            <div class="col-xl-4 col-lg-4">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="mb-3">
                            <div style="display: none;" id="upload-msg" class="alert fade show" role="alert">
                                <strong>Upload Failed: </strong> <span id="text"></span>
                            </div>

                            <label for="image" class="form-label cursor-pointer" style="cursor: pointer;"
                                title="Click to upload image">
                                <img id="user-image" src="{{ $user->profile->profile_picture }}" width="100"
                                    height="50" class="img-thumbnail" alt="profile-image" />
                            </label>
                            <input type="file" class="form-control" name="file" id="image" accept="image/*"
                                aria-describedby="fileHelpId" style="display: none;" />
                        </div>

                        <h4 class="mb-0 mt-2">{{ ucwords($user->profile->full_name) }}</h4>
                        <p class="text-muted font-14">{{ $user->profile->username }}</p>

                        <div class="text-start mt-3">
                            <p class="text-muted mb-2 font-13"><strong>Username :</strong>
                                <span class="ms-2">
                                    {{ ucwords($user->username) }}
                                </span>
                            </p>

                            <p class="text-muted mb-2 font-13"><strong>Mobile :</strong>
                                <span class="ms-2">
                                    {{ $user->phone_number }}
                                </span>
                            </p>

                            <p class="text-muted mb-2 font-13"><strong>Email :</strong>
                                <span class="ms-2 ">
                                    {{ $user->email }}
                                </span>
                            </p>
                            <p class="text-muted mb-2 font-13"><strong>Joined on :</strong>
                                <span class="ms-2 ">
                                    {{ Carbon::parse($user->created_at)->format('l, d M Y') . ' (' . Carbon::parse($user->created_at)->longRelativeDiffForHumans() . ')' }}
                                </span>
                            </p>
                        </div>
                    </div> <!-- end card-body -->
                </div>
            </div>
            <div class="col-xl-4 col-lg-4">
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
                            <form id="user" action="{{ route('candidate.update-info') }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="row mb-3">
                                    <div class="form-outline mb-3" data-mdb-input-init>
                                        <input required type="text" class="form-control" id="username" name="username"
                                            value="{{ $user->username }}">
                                        <label class="form-label" for="username">Username</label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-outline mb-3" data-mdb-input-init>
                                        <input required type="text" class="form-control" id="email" name="email"
                                            value="{{ $user->email }}">
                                        <label class="form-label" for="email">Email</label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-outline mb-3" data-mdb-input-init>
                                        <input required type="text" class="form-control" id="phone_number"
                                            name="phone_number" value="{{ $user->phone_number }}">
                                        <label class="form-label" for="phone_number">Phone number</label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-outline mb-3">
                                        <button type="submit" class="btn btn-primary">update</button>
                                    </div>
                                </div>
                            </form>
                            <p class="text-muted mb-2 font-13"><strong>Last updated :</strong>
                                <span class="ms-2 ">
                                    {{ Carbon::parse($user->updated_at)->format('l, d M Y') . ' (' . Carbon::parse($user->updated_at)->longRelativeDiffForHumans() . ')' }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4">
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
                            <div class="form-group mb-3" data-mdb-input-init>
                                <label for="c_password" class="form-label">Current password</label>
                                <input required type="text" class="form-control" name="c_password" id="c_password"
                                    aria-describedby="helpId" placeholder="" />
                            </div>
                            <div class="form-group mb-3" data-mdb-input-init>
                                <label for="password" class="form-label">New password</label>
                                <input required type="text" class="form-control" name="password" id="password"
                                    aria-describedby="helpId" placeholder="" />
                            </div>
                            <div class="form-group mb-3" data-mdb-input-init>
                                <label for="password_confirmation" class="form-label">Confirm new password</label>
                                <input required type="text" class="form-control" name="password_confirmation"
                                    id="password_confirmation" aria-describedby="helpId" placeholder="" />
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">update password</button>
                                </div>
                            </div>
                    </form>
                    
                </div>
            </div>
        </div>
        <script>
            const $loader = '<span id="btn-icon" class="fas fa-spinner fa-spin me-2"></span>';
            $('form#reset-password').on('submit', function(event) {
                event.preventDefault();
                $('form#reset-password :submit').html($loader + 'validating...').addClass('disabled');
                $.ajax({
                    url: '{{ route('candidate.update-info') }}',
                    type: 'PUT',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#error').hide();
                        if (response.success) {
                            window.location.reload();
                            window.location.href = response.url;
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#error').html('').show();
                        console.log(error, xhr);
                        $('form#reset-password :submit').html('').text('update password').removeClass(
                            'disabled');
                        if (xhr.responseJSON.errors) {
                            for (let key in xhr.responseJSON.errors) {
                                $('#error').append('<p>' + xhr.responseJSON.errors[key] + '</p>');
                            }
                        }
                    },
                });
            });
            $('form#user').on('submit', function(event) {
                $('form#user :submit').html($loader + 'updating...').addClass('disabled');
                return 1;
            });
            $('input[name="file"]').change(function() {
                // alert('file uploaded');
                var file = this.files[0];
                var formData = new FormData();
                formData.append('image', file);
                formData.append('_token', '{{ csrf_token() }}');
                console.log(formData, file);
                const allowedFileType = ['image/png', 'image/jpeg', 'image/jpg', 'image/webm', 'image/bmp'];
                if (!allowedFileType.includes(file.type)) {
                    $('#upload-msg span#text').text('file type not allowed');
                    return $('#upload-msg').addClass('alert-danger').show();

                }
                $.ajax({
                    type: 'POST',
                    url: '{{ route('candidate.upload-image') }}',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#upload-msg span#text').text('file uploaded successfully');
                        $('img, img.user').attr('src', data.file)
                        return $('#upload-msg').addClass('alert-success').show();
                    },
                    error: function(error) {
                        console.log(error);
                        $('#upload-msg span#text').text(error.responseJSON.message);
                        return $('#upload-msg').addClass('alert-danger').show();
                    }
                });
            });
        </script>
    @endsection
