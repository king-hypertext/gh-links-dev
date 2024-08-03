@extends('layout.auth-layout')
@section('content')
    <div>
        <!-- Simplicity is an acquired taste. - Katharine Gerould -->
        <h5 class="h5 fw-semibold text-capitalize text-center">create an account</h5>
    </div>

    <div style="display: none;" id="response" class="alert alert-danger" role="alert">
    </div>

    <div class="tab-pane fade show active" id="candidate" role="tabpanel" aria-labelledby="candidate">
        <form id="reg" method="POST">
            @csrf
            <div class="container-fluid mt-3">
                <div class="form-group mb-3">
                    <select name="account_type" required class="form-select" data-mdb-select-init>
                        <option value="" selected>Select Account Type</option>
                        <option value="1">Candidate</option>
                        <option value="2">Non-candidate(Company)</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <div data-mdb-input-init class="form-outline">
                        <input required name="username" type="text" id="un" class="form-control" />
                        <label class="form-label" for="un">Username</label>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div data-mdb-input-init class="form-outline">
                        <input required name="phone_number" type="tel" id="tell" class="form-control" />
                        <label class="form-label" for="tell">Phone number</label>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div data-mdb-input-init class="form-outline">
                        <input required name="email" type="text" id="email" class="form-control" />
                        <label class="form-label" for="email">Email</label>
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
                    <div class="form-outline" data-mdb-input-init>
                        <input required type="password" name="password_confirmation" class="form-control"
                            id="confirm-password">
                        <label class="form-label" for="confirm-password">Confirm password</label>
                        <span class="input-group-icon">
                            <i class="fa fa-eye" title="Click to show password"></i>
                        </span>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="form-check">
                        <input required onchange="document.getElementById('register').disabled = !this.checked"
                            name="accept_terms" class="form-check-input" type="checkbox" value="1" id="agree">
                        <label class="form-check-label user-select-none" for="agree">I agree to the Terms of
                            Services</label>
                    </div>
                </div>
                <div class="row form-group mx-1 mb-3">
                    <button disabled type="submit" id="register" class="btn btn-primary">Register
                        <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="text-center my-3">
        <a href="{{ route('login') }}">Already have an account? Login</a>
    </div>
    </div>
@endsection
