@extends('layout.auth-layout')
@section('content')
    <h5 class="h5 fw-semibold text-capitalize text-center">login to your account</h5>
    <ul class="nav nav-tabs nav-justified mb-3" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
            <a data-mdb-tab-init class="nav-link active" id="b" href="#candidate" role="tab"
                aria-controls="candidate" aria-selected="true">candidate</a>
        </li>
        <li class="nav-item" role="presentation">
            <a data-mdb-tab-init class="nav-link" id="a" href="#employer" role="tab" aria-controls="employer"
                aria-selected="false">employer</a>
        </li>
    </ul>
    <!-- Tabs content -->
    <div class="tab-content" id="ex2-content">
        <div class="tab-pane fade show active" id="candidate" role="tabpanel" aria-labelledby="candidate">
            <form id="login-as-candidate" autocomplete="off" method="POST">
                <div class="container-fluid mt-3">
                    <div class="form-group mb-3">
                        <div data-mdb-input-init class="form-outline">
                            <input required name="user" type="text" id="un" class="form-control" />
                            <label class="form-label" for="un">Username or Email</label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-outline" data-mdb-input-init>
                            <input required type="password" name="password" class="form-control" id="password">
                            <label class="form-label" for="password">Password</label>
                            <span class="input-group-icon">
                                <i class="fa fa-eye" title="Click to show password"></i>
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">login
                                <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="employer" role="tabpanel" aria-labelledby="employer">
            <form id="login-as-employer" autocomplete="off" method="POST">
                <div class="container-fluid mt-3">
                    <div class="form-group mb-3">
                    </div>
                    <div class="form-group mb-3">
                        <div data-mdb-input-init class="form-outline">
                            <input required name="user" type="text" id="eun" class="form-control" />
                            <label class="form-label" for="eun">Username or Email</label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-outline" data-mdb-input-init>
                            <input required type="password" name="password" class="form-control" id="epassword">
                            <label class="form-label" for="epassword">Password</label>
                            <span class="input-group-icon">
                                <i class="fa fa-eye" title="Click to show password"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary">
                            login
                            <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="text-center my-3">
            <a href="{{ route('register') }}">Don't have an account? Register</a>
        </div>
    </div>

    {{-- <h6 class="text-center h5 text-primary  text-uppercase mb-4">login</h6>
        <form id="login" method="POST" action="{{ route('login.authenticate') }}" autocomplete="on">
            @csrf
            @if (session('password_changed'))
                <div class="alert alert-info  text-center  text-info">{{ session('password_changed') }}</div>
            @endif
            @if (session('error'))
                <div class="h6 alert alert-danger alert-dismissible text-danger text-center">
                    <ul class="list-unstyled text-center">
                        <li>{{ session('error') }}</li>
                    </ul>
                </div>
            @endif
            @if ($errors->any())
                <div class="h6 alert alert-danger alert-dismissible text-danger text-center">
                    <ul class="list-unstyled text-center">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-outline mb-4">
                <input required type="text" autofocus onfocus="this.select()" name="username" id="username"
                    class="form-control form-control-lg" value="{{ @old('username') }}" />
                <label class="form-label" for="username">Username</label>
            </div>
            <div class="form-outline mb-4">
                <input required type="password" name="password" id="password" class="form-control form-control-lg" />
                <label class="form-label" for="password">Password</label>
            </div>
            <div class="form-group">
                <button type="submit"class="btn btn-lg btn-primary btn-block">
                    Secure Login
                </button>
            </div>
        </form>
        <div class="form-text">
            Forgotten Password? <a href="#" onclick="window.alert('Password reset \nPlease Contact your IT Manager')"
                title="Click to reset your password" class="btn-link">Reset</a>
        </div> --}}
@endsection
