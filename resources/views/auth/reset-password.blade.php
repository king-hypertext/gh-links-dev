@extends('layout.auth-layout')
@section('content')
    <h5 class="h5 fw-semibold text-capitalize text-center">reset your password</h5>

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
            <form autocomplete="on" method="POST">
                @if (session('success'))
                    <div class="alert alert-success fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{ session('success') }}
                    </div>
                @endif
                @csrf
                <div class="container-fluid mt-3">
                    <div class="form-group mb-3">
                        <div data-mdb-input-init class="form-outline">
                            <input autofocus required name="email" value="{{ @old('email') }}"
                                placeholder="enter your email" type="email" id="un" class="form-control" />
                            <label class="form-label" for="un">Email</label>
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
                        <div class="d-flex form-group">
                            <button type="submit" class="btn btn-primary">send verification link
                                <i class="fas fa-arrow-right ms-2"></i>
                            </button>

                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
