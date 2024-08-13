<div class="app-container container">
    <!-- The biggest battle is the war against ignorance. - Mustafa Kemal Atatürk -->
    <div class="row mt-1 p-2">
        <style type="text/css">
            .text-bg-dark {
                color: #fff !important;
                background-color: RGBA(var(--bs-dark-rgb), var(--bs-bg-opacity, 1)) !important;
            }

            .text-muted {
                --bs-text-opacity: 1;
                color: var(--mdb-secondary) !important;
            }
        </style>
        <div class="col-sm-3 g-3">
            <h6 class="h6 mb-1 fw-bold text-capitalize">
                gh links
            </h6>
            <hr class="mt-0">
            <ul class="list-unstyled">
                <li class="text-muted">For enquiries, <i class="fas fa-phone"></i>
                    <strong class="d-flex flex-column align-middle align-items-start">
                        <a href="tel:+#" class="text-decoration-none text-muted fw-lighter">(+233) 000
                            0000</a>
                        <a href="tel:+#" class="text-decoration-none text-muted fw-lighter">(+233) 000
                            0000</a>
                    </strong>
                </li>
                <li>
                    <a class="link-light text-muted fw-lighter" href="">Faqs</a>
                </li>
                <li>
                    <a class="link-light text-muted fw-lighter" href="">Privacy Policy</a>
                </li>
                <li>
                    <a class="link-light text-muted fw-lighter" href="">Terms & Conditions</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-3 g-3">
            <h6 class="h6 mb-1 fw-semibold text-capitalize" id="a">
                quick links
            </h6>
            <hr class="mt-0">
            <ul class="list-unstyled">
                <li>
                    <a class="link-light text-muted fw-lighter" href="">About</a>
                </li>
                <li>
                    <a class="link-light text-muted fw-lighter" href="">Contact</a>
                </li>
                <li>
                    <a class="link-light text-muted fw-lighter" href="">Pricing</a>
                </li>
                <li>
                    <a class="link-light text-muted fw-lighter" href="">Blog</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-3 g-3">
            <h6 class="h6 mb-1 fw-semibold text-capitalize">
                candidates
            </h6>
            <hr class="mt-0">
            <ul class="list-unstyled">
                <li>
                    <a class="link-light text-muted fw-lighter" href="{{ route('jobs.index') }}">Browse Jobs</a>
                </li>
                <li>
                    <a class="link-light text-muted fw-lighter" href="{{ route('company.index') }}">Browse Employers</a>
                </li>
                <li>
                    <a class="link-light text-muted fw-lighter" href="{{ route('profile.show') }}">Candidate Profile</a>
                </li>
                <li>
                    <a class="link-light text-muted fw-lighter" href="{{ route('candidate.saved-jobs') }}">Saved Jobs</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-3 g-3">
            <h6 class="h6 mb-1 fw-bold text-capitalize">
                employers
            </h6>
            <hr class="mt-0">
            <ul class="list-unstyled">
                <li>
                    <a class="link-light text-muted fw-lighter" href="{{ route('my-jobs.create') }}">Post a Job</a>
                </li>
                <li>
                    <a class="link-light text-muted fw-lighter" href="{{ route('candidates.index') }}">Browse Candidates</a>
                </li>
                <li>
                    <a class="link-light text-muted fw-lighter" href="{{ route('employer.dashboard') }}">Employers
                        Dashboard</a>
                </li>
                <li>
                    <a class="link-light text-muted fw-lighter" href="{{ route('my-jobs.index') }}">Applications</a>
                </li>
            </ul>
        </div>
    </div>
    <hr class="m-0">
    <div class="d-flex justify-content-sm-between flex-column flex-sm-row flex-sm-nowrap  align-items-center">
        <h6 class="mt-3" style="font-size: 12px;">
            &copy; {{ Date('Y') }}. GH-LINKS . All Rights Reserved.
        </h6>
        <style>
            ul>li>a.link-light>i {
                margin: 0 .37rem;
            }
        </style>
        <ul class="list-unstyled my-auto d-flex mb-0">
            <li>
                <a href="#" class="link-light">
                    <i class="fab fa-facebook"></i>
                </a>
            </li>
            <li>
                <a href="#" class="link-light">
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
            <li>
                <a href="#" class="link-light">
                    <i class="fab fa-twitter"></i>
                </a>
            </li>
        </ul>
    </div>
    @include('layout.scroll-top')
</div>
