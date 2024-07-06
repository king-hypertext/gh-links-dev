@extends('employer.layout')
@section('content')
    <!-- Tabs navs -->
    <ul class="nav nav-tabs mb-3" id="account-setup" role="tablist">
        <li class="nav-item" role="presentation">
            <a data-mdb-tab-init class="nav-link active" id="account-setup-tab-1" href="#account-setup-tabs-1" role="tab"
                aria-controls="account-setup-tabs-1" aria-selected="true">
                <i class="fa-solid fa-address-card fa-fw me-2"></i> Company Info
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a data-mdb-tab-init class="nav-link" id="account-setup-tab-2" href="#account-setup-tabs-2" role="tab"
                aria-controls="account-setup-tabs-2" aria-selected="false"><i
                    class="fa-regular fa-circle-user fa-fw me-2"></i>founding info</a>
        </li>
        <li class="nav-item" role="presentation">
            <a data-mdb-tab-init class="nav-link" id="account-setup-tab-3" href="#account-setup-tabs-3" role="tab"
                aria-controls="account-setup-tabs-3" aria-selected="false">
                <i class="fa-solid fa-circle-info"></i>
                contact
            </a>
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
            flex-direction: column;
            margin: 0 auto;
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
            <form action="#" method="POST">
                <div class="row mb-3">
                    <div id="error" class="alert alert-danger" role="alert">
                        errr
                    </div>

                    <div class="col-sm-5">
                        <label for="logo" class="form-label">Upload Logo</label>
                        <div class="file-upload">
                            <div class="file-input">
                                <input type="file" accept=".jpg,.jpeg,.png,.webp,.bmp" id="logo" name="logo" />
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
                        <label for="banner_image" class="form-label">Upload Banner Image</label>
                        <div class="file-upload">
                            <div class="file-input">
                                <input type="file" accept=".jpg,.jpeg,.png,.webp,.bmp" id="banner_image"
                                    name="banner_image">
                                <label for="banner_image">
                                    <div class="file-icon">
                                        <i class="fa-solid fa-cloud-arrow-up fa-2xl"></i>
                                    </div>
                                    <div class="file-label">click to upload image</div>
                                    <span style="font-size: 10px;" class="b-0 m-0">
                                        Supported format are PNG, JPEG, WEBP, JPG, and BMP. Max size is 4MB.
                                    </span>
                                </label>
                            </div>
                            <div id="banner" class="progress mt-3" style="height: 12px;display: none;">
                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                    aria-valuemax="100">0%</div>
                            </div>
                            <div class="uploaded-file banner">
                                <div style="display: none;"
                                    class="uploaded-file f-banner d-flex flex-row align-items-center justify-content-center mt-2">
                                    <img width="65" height="auto" src="#" alt="" id="img-banner"
                                        class="img-thumbnail" />
                                    <i class="fa fa-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="mb-3">
                <label for="name" class="form-label">Company Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder=""
                    aria-describedby="helpId" />
                {{-- <small id="helpId" class="text-muted">Help text</small> --}}
            </div>
            <div class="mb-3">
                <div class="mb-3">
                    <label for="about" class="form-label">About Us</label>
                    <textarea class="form-control" name="about" id="about" rows="3">
                        <p>Write down about your company, let the candidate know who you are...</p>
                    </textarea>
                </div>
            </div>
            <div class="mb-3">
                <div class="d-gri gap-2">
                    <button type="button" name="" id="" class="btn btn-primary">
                        Save and continue <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="account-setup-tabs-2" role="tabpanel" aria-labelledby="account-setup-tab-2">
            Tab 2 content
        </div>
        <div class="tab-pane fade" id="account-setup-tabs-3" role="tabpanel" aria-labelledby="account-setup-tab-3">
            Tab 3 content
        </div>
    </div>
    <!-- Tabs content -->
    <script type="application/javascript">
        $(document).ready(function() {
            $('input[name="logo"]').change(function() {
                // alert('file uploaded');
                var file = this.files[0];
                var formData = new FormData();
                formData.append('logo', file);
                console.log(formData, file);
                formData.append('_token','{{ csrf_token() }}');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('your-profile.store') }}',
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
            $('input[name="banner_image"]').change(function() {
                // alert('file uploaded');
                var file = this.files[0];
                var formData = new FormData();
                formData.append('banner', file);
                formData.append('_token','{{ csrf_token() }}');
                console.log(formData, file);
                $.ajax({
                    type: 'POST',
                    url: '/',
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
        });
    </script>
@endsection
