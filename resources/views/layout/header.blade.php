    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
    <header class="d-flex w-100 justify-content-center shadow animate__animated" style="z-index: 1040;">
        <div style="z-index: 1045;"
            class="app-container bg-secondary py-2 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center justify-content-sm-between justify-content-start">
                <style>
                    .dropdown-menu.dropdown-item {
                        padding: 10px;
                    }

                    .dropdown-menu.dropdown-item:hover {
                        background-color: #f8f9fa;
                        border-radius: 0 !important;
                    }

                    .dropdown-menu.dropdown-item.active {
                        background-color: #f8f9fa;
                        color: #212529;
                        border-radius: 0 !important;
                    }

                    .dropdown-menu>li:first-child .dropdown-item,
                    .dropdown-menu>li:last-child .dropdown-item {
                        border-radius: 0 !important;
                    }

                    .dropdown-item i {
                        margin-right: .5rem;
                        color: #212529;
                        cursor: pointer;
                        align-content: center;
                        justify-content: center;
                    }
                </style>
                <div class="dropdown mx-2">
                    <button class="btn btn-secondary px-3" type="button" id="dropdownMenuButton" data-mdb-dropdown-init
                        data-mdb-ripple-init aria-expanded="false">
                        <i class="fas fa-bars-staggered"></i>
                    </button>
                    <ul id="nav" class="dropdown-menu shadow rounded-0 rounded-top-0"
                        aria-labelledby="dropdownMenuButton">
                        @auth('candidate', 'employer')
                            <div
                                class="d-flex flex-row align-items-center align-middle justify-content-center d-sm-none my-1">
                                <a href="{{ route('home') }}"
                                    class="align-items-center text-dark text-uppercase text-decoration-none">
                                    <svg style="height: 20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path
                                            d="M469.2 75A75.6 75.6 0 1 0 317.9 75a75.6 75.6 0 1 0 151.2 0zM154.2 240.7A75.6 75.6 0 1 0 3 240.7a75.6 75.6 0 1 0 151.2 0zM57 346C75.6 392.9 108 433 150 461.1s91.5 42.6 142 41.7c-14.7-18.6-22.9-41.5-23.2-65.2c-6.8-.9-13.3-2.1-19.5-3.4c-26.8-5.7-51.9-17.3-73.6-34s-39.3-38.1-51.7-62.5c-20.9 9.9-44.5 12.8-67.1 8.2zm395.1 89.8a75.6 75.6 0 1 0 -151.2 0 75.6 75.6 0 1 0 151.2 0zM444 351.6c18.5 14.8 31.6 35.2 37.2 58.2c33.3-41.3 52.6-92.2 54.8-145.2s-12.5-105.4-42.2-149.4c-8.6 21.5-24 39.6-43.8 51.6c15.4 28.6 22.9 60.8 21.9 93.2s-10.7 64-28 91.6zM101.1 135.4c12.4 2.7 24.3 7.5 35.1 14.3c16.6-24.2 38.9-44.1 64.8-58S255.8 70.4 285.2 70c.2-5.9 .9-11.9 2-17.7c3.6-16.7 11.1-32.3 21.8-45.5c-47.7-3.8-95.4 6-137.6 28.5S94.3 91.7 70.8 133.4c2.7-.2 5.3-.3 8-.3c7.5 0 15 .8 22.4 2.3z" />
                                    </svg>
                                    gh-links
                                </a>
                            </div>
                        @endauth
                        <li>
                            <a class="dropdown-item" href="{{ route('home') }}">
                                <i class="fa fa-house"></i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li class="d-md-none">
                            <a id="app-search" class="dropdown-item text-capitalize">
                                <i class="fa fa-search"></i>
                                <span>
                                    search
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('jobs.index') }}">
                                <i class="fa fa-suitcase"></i>
                                <span>Find Jobs</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('company.index') }}">
                                <i class="far fa-address-book"></i>
                                <span>Find Employers</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('candidates.index') }}">
                                <i class="fa fa-user-group"></i>
                                <span>Find Candidates</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fa fa-phone"></i>
                                <span>Customer Support</span>
                            </a>
                        </li>
                        @auth('candidate', 'employer')
                        @else
                            <li class="d-sm-none">
                                <hr class="dropdown-divider">
                                <div class="d-flex flex-row mx-2 mb-2">
                                    <button data-mdb-ripple-init onclick="window.open('{{ route('login') }}','_self')"
                                        type="button" class="btn btn-sm btn-outline-secondary me-2"
                                        title="login to your account">Login</button>
                                    <button data-mdb-ripple-init onclick="window.open('{{ route('register') }}','_self')"
                                        type="button" class="btn btn-sm text-nowrap py-1 btn-primary"
                                        title="create an account">Sign-up</button>
                                </div>
                            </li>
                        @endauth
                    </ul>
                </div>
                <div class="d-flex flex-row align-middle d-none d-sm-block">
                    <a id="home" href="{{ route('home') }}"
                        class="align-items-center text-dark text-uppercase text-decoration-none">
                        <svg style="height: 30px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path
                                d="M469.2 75A75.6 75.6 0 1 0 317.9 75a75.6 75.6 0 1 0 151.2 0zM154.2 240.7A75.6 75.6 0 1 0 3 240.7a75.6 75.6 0 1 0 151.2 0zM57 346C75.6 392.9 108 433 150 461.1s91.5 42.6 142 41.7c-14.7-18.6-22.9-41.5-23.2-65.2c-6.8-.9-13.3-2.1-19.5-3.4c-26.8-5.7-51.9-17.3-73.6-34s-39.3-38.1-51.7-62.5c-20.9 9.9-44.5 12.8-67.1 8.2zm395.1 89.8a75.6 75.6 0 1 0 -151.2 0 75.6 75.6 0 1 0 151.2 0zM444 351.6c18.5 14.8 31.6 35.2 37.2 58.2c33.3-41.3 52.6-92.2 54.8-145.2s-12.5-105.4-42.2-149.4c-8.6 21.5-24 39.6-43.8 51.6c15.4 28.6 22.9 60.8 21.9 93.2s-10.7 64-28 91.6zM101.1 135.4c12.4 2.7 24.3 7.5 35.1 14.3c16.6-24.2 38.9-44.1 64.8-58S255.8 70.4 285.2 70c.2-5.9 .9-11.9 2-17.7c3.6-16.7 11.1-32.3 21.8-45.5c-47.7-3.8-95.4 6-137.6 28.5S94.3 91.7 70.8 133.4c2.7-.2 5.3-.3 8-.3c7.5 0 15 .8 22.4 2.3z" />
                        </svg>
                        gh-links
                    </a>
                </div>
            </div>
            <div class="">
                <button type="button" id="app-search" title="search gh-links"
                    class="btn shadow-none px-3 btn-secondary mx-2 d-none d-md-block">
                    <i class="fas fa-search"></i>
                </button>
                <div class="search-dropdown shadow">
                    <form id="full-search" class="form-search" action="/search">
                        <div class="search-dialog" aria-labelledby="dropdownMenuButton">
                            <div class="card w-100 shadow-sm">
                                <div class="card-body">
                                    <div class="modal-header text-center">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            search <span class="text-uppercase fw-bold">
                                                gh-links
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="form-group d-flex flex-row justify-content-between">
                                        <input type="search" name="q" class="form-control"
                                            placeholder="Search: companies, positions...">
                                        <button id="close-search" title="exit search" type="button"
                                            class="btn btn-secondary shadow-sm ms-2 p-2 ">
                                            <i class="fa fa-xmark fa-2x"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @auth('candidate', 'employer')
                <div class="dropdown pe-2">
                    <a href="#"
                        class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ /* auth('candidate')->user()->profile->profile_image */ asset('icons/svgs/solid/user.svg') }}"
                            alt="" width="32" height="32" class="shadow-2 rounded-circle me-2">
                        <strong>{{ auth('candidate')->user()?->username }}</strong>
                    </a>
                    <ul class="dropdown-menu text-small shadow">
                        @auth('employer')
                            <li><a class="dropdown-item" href="{{ route('employer.dashboard') }}">Dashboard</a></li>
                        @endauth
                        {{-- <li><a class="dropdown-item" href="#">New project...</a></li> --}}
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fa-solid fa-gear"></i>
                                <span> Settings </span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                                <i class="fa-solid fa-user-circle"></i>
                                <span> Profile </span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" data-bs-toggle="modal" title="logout of your account"
                                href="#logout">
                                <i class="fa-solid fa-right-to-bracket"></i>
                                <span>
                                    Sign out
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            @else
                <div class="text-end d-none d-sm-block mx-2">
                    <button data-mdb-ripple-init onclick="window.open('{{ route('login') }}','_self')" type="button"
                        class="btn btn-outline-secondary me-2" title="login to your account">Login</button>
                    <button data-mdb-ripple-init onclick="window.open('{{ route('register') }}','_self')" type="button"
                        class="btn btn-primary" title="create an account">Sign-up</button>
                </div>
                <div class="d-flex flex-row align-middle pe-2 d-sm-none">
                    <a href="{{ route('home') }}"
                        class="align-items-center text-dark text-uppercase text-decoration-none">
                        <svg style="height: 30px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path
                                d="M469.2 75A75.6 75.6 0 1 0 317.9 75a75.6 75.6 0 1 0 151.2 0zM154.2 240.7A75.6 75.6 0 1 0 3 240.7a75.6 75.6 0 1 0 151.2 0zM57 346C75.6 392.9 108 433 150 461.1s91.5 42.6 142 41.7c-14.7-18.6-22.9-41.5-23.2-65.2c-6.8-.9-13.3-2.1-19.5-3.4c-26.8-5.7-51.9-17.3-73.6-34s-39.3-38.1-51.7-62.5c-20.9 9.9-44.5 12.8-67.1 8.2zm395.1 89.8a75.6 75.6 0 1 0 -151.2 0 75.6 75.6 0 1 0 151.2 0zM444 351.6c18.5 14.8 31.6 35.2 37.2 58.2c33.3-41.3 52.6-92.2 54.8-145.2s-12.5-105.4-42.2-149.4c-8.6 21.5-24 39.6-43.8 51.6c15.4 28.6 22.9 60.8 21.9 93.2s-10.7 64-28 91.6zM101.1 135.4c12.4 2.7 24.3 7.5 35.1 14.3c16.6-24.2 38.9-44.1 64.8-58S255.8 70.4 285.2 70c.2-5.9 .9-11.9 2-17.7c3.6-16.7 11.1-32.3 21.8-45.5c-47.7-3.8-95.4 6-137.6 28.5S94.3 91.7 70.8 133.4c2.7-.2 5.3-.3 8-.3c7.5 0 15 .8 22.4 2.3z" />
                        </svg>
                        gh-links
                    </a>
                </div>
            @endauth

            {{-- </div> --}}
    </header>
