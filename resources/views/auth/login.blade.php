@extends('layout.auth-layout')
@section('content')
    <h5 class="h5 fw-semibold text-capitalize text-center">login to your account</h5>

    <div style="display: none;" id="response" class="alert alert-danger" role="alert">
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
    <div class="tab-content" id="ex2-content">
        <div class="tab-pane fade show active" id="candidate" role="tabpanel" aria-labelledby="candidate">
            <form id="login" autocomplete="on" method="POST">
                @csrf
                <input type="hidden" name="to">
                <div class="container-fluid mt-3">
                    <div class="form-group mb-3">
                        <div data-mdb-input-init class="form-outline">
                            <input autofocus required name="user" type="text" id="un" class="form-control" />
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
                    <div class="form-group mb-3">
                        <select name="account_type" required class="form-select" data-mdb-select-init>
                            <option value="" selected>Select User Type</option>
                            <option value="1">Candidate</option>
                            <option value="2">Company</option>
                        </select>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">secure login
                                <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="text-center my-3">
            <a href="{{ route('register') }}">Don't have an account? Register</a>
        </div>
    </div>
    <script>
        document.querySelector('[name="to"]').value = new URLSearchParams(window.location.search).get('to');
    </script>
@endsection
