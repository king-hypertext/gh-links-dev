@extends('employer.layout')
@section('content')
    @use(Carbon\Carbon)
    <div>
        <!-- Order your soul. Reduce your wants. - Augustine -->
        account page
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="assets/images/users/avatar-1.jpg" class="rounded-circle avatar-lg img-thumbnail"
                            alt="profile-image">

                        <h4 class="mb-0 mt-2">{{ auth('employer')->user()->full_name }}</h4>
                        <p class="text-muted font-14">{{ auth('employer')->user()->username }}</p>

                        {{-- <button type="button" class="btn btn-success btn-sm mb-2">Follow</button>
                        <button type="button" class="btn btn-danger btn-sm mb-2">Message</button> --}}

                        <div class="text-start mt-3">
                            <h4 class="font-13 text-uppercase">About Me :</h4>
                            <p class="text-muted font-13 mb-3">
                                Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the
                                1500s, when an unknown printer took a galley of type.
                            </p>
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
                                    {{ Carbon::parse(auth('employer')->user()->created_at)->format('l, d M Y') . ' (' . Carbon::parse(auth('employer')->user()->created_at)->longAbsoluteDiffForHumans() . ')' }}
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
            </div>
            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @php
                                $user = auth('employer')->user();
                            @endphp
                            <div class="col-12">
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="first_name">First name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            value="{{ $user?->first_name }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="last_name">Last name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            value="{{ $user?->last_name }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="username">Username</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="username" name="username"
                                            value="{{ $user?->username }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="email">Email</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="email" name="email"
                                            value="{{ $user?->email }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="phone_number">Phone number</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                                            value="{{ $user?->phone_number }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="about_me" class="col-md-3 col-form-label">About Me</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="about_me" id="about_me" rows="3">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="password"> Password</label>
                                    <div class="col-md-9">
                                        <input type="password" id="password" name="password" class="form-control"
                                            value="">
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <p class="text-muted mb-2 font-13"><strong>Last updated at :</strong>
                                <span class="ms-2 ">
                                    {{ Carbon::parse(auth('employer')->user()->created_at)->format('l, d M Y') . ' (' . Carbon::parse(auth('employer')->user()->created_at)->longAbsoluteDiffForHumans() . ')' }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
