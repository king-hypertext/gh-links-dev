@extends('layout.auth-layout')
@section('content')
    <div>
        <!-- Simplicity is an acquired taste. - Katharine Gerould -->
        <h5 class="h5 fw-semibold text-capitalize text-center">create an account</h5>
    </div>
    <!-- Tabs navs -->
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
    <div style="display: none;" id="response" class="alert alert-danger" role="alert">
    </div>

    <div class="tab-content" id="ex2-content">
        <div class="tab-pane fade show active" id="candidate" role="tabpanel" aria-labelledby="candidate">
            <form id="reg-as-candidate" method="POST">
                @csrf
                <div class="container-fluid mt-3">
                    <div class="form-group mb-3">
                        <div class="row ">
                            <div class="col-md-6 g-4">
                                <div data-mdb-input-init class="form-outline">
                                    <input autofocus required name="first_name" type="text" id="fn"
                                        class="form-control" />
                                    <label class="form-label" for="fn">First name</label>
                                </div>
                            </div>
                            <div class="col-md-6 g-4">
                                <div data-mdb-input-init class="form-outline">
                                    <input required name="last_name" type="text" id="ln" class="form-control" />
                                    <label class="form-label" for="ln">Last name</label>
                                </div>
                            </div>
                        </div>
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
                    {{-- <div class="form-group mb-3">
                        <select name="gender" required class="form-select" data-mdb-select-init>
                            <option value="" selected>Select Gender</option>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                        </select>
                    </div> --}}
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
                                name="accept_terms" class="form-check-input" type="checkbox" value="1"
                                id="agree">
                            <label class="form-check-label user-select-none" for="agree">I agree to the Terms of Services</label>
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
        <div class="tab-pane fade" id="employer" role="tabpanel" aria-labelledby="employer">
            <form id="reg-as-employer" method="POST">
                @csrf
                <div class="container-fluid mt-3">
                    <div class="form-group mb-3">
                        <div class="row ">
                            <div class="col-md-6 g-4">
                                <div data-mdb-input-init class="form-outline">
                                    <input autofocus required name="first_name" type="text" id="efn"
                                        class="form-control" />
                                    <label class="form-label" for="efn">First name</label>
                                </div>
                            </div>
                            <div class="col-md-6 g-4">
                                <div data-mdb-input-init class="form-outline">
                                    <input required name="last_name" type="text" id="eln"
                                        class="form-control" />
                                    <label class="form-label" for="eln">Last name</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div data-mdb-input-init class="form-outline">
                            <input required name="username" type="text" id="eun" class="form-control" />
                            <label class="form-label" for="eun">Username</label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div data-mdb-input-init class="form-outline">
                            <input required name="phone_number" type="tel" id="etell" class="form-control" />
                            <label class="form-label" for="etell">Phone number</label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div data-mdb-input-init class="form-outline">
                            <input required name="email" type="text" id="eemail" class="form-control" />
                            <label class="form-label" for="eemail">Email</label>
                        </div>
                    </div>
                    {{-- <div class="form-group mb-3">
                        <select name="gender" required class="form-select" data-mdb-select-init>
                            <option value="" selected>Select Gender</option>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                        </select>
                    </div> --}}
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
                        <div class="form-outline" data-mdb-input-init>
                            <input required type="password" name="password_confirmation" class="form-control"
                                id="econfirm-password">
                            <label class="form-label" for="econfirm-password">Confirm password</label>
                            <span class="input-group-icon">
                                <i class="fa fa-eye" title="Click to show password"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-check">
                            <input autocomplete="offf" required type="checkbox"
                                onchange="document.getElementById('employer_register').disabled = !this.checked"
                                name="accept_terms" class="form-check-input" value="1" id="eagree">
                            <label class="form-check-label user-select-none" for="eagree">I agree to the Terms of
                                Services</label>
                        </div>
                    </div>
                    <div class="row form-group mx-1 mb-3">
                        <button disabled id="employer_register" type="submit" class="btn btn-primary">Register <i
                                class="fas fa-arrow-right ms-2"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="text-center my-3">
            <a href="{{ route('login') }}">Already have an account? Login</a>
        </div>
    </div>
@endsection
