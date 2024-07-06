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

    <!-- Tabs content -->
    <div class="tab-content" id="account-setup-content">
        <div class="tab-pane fade show active" id="account-setup-tabs-1" role="tabpanel"
            aria-labelledby="account-setup-tab-1">
            <div class="mb-3">
                <label for="name" class="form-label">Company Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder=""
                    aria-describedby="helpId" />
                {{-- <small id="helpId" class="text-muted">Help text</small> --}}
            </div>
            <div class="mb-3">
                <div class="mb-3">
                    <label for="about" class="form-label">About Us</label>
                    <textarea class="form-control" name="about" id="about" rows="3"></textarea>
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
@endsection
