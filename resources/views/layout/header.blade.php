    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
    <header class="d-flex w-100 justify-content-center animate__animated" style="z-index: 1040">
        <div style="z-index: 1045;" class="app-container bg-white py-2 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center justify-content-sm-between">
                <div class="d-flex flex-row align-middle">
                    <a href="/" class="align-items-center text-dark text-uppercase text-decoration-none">
                        <svg style="height: 30px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path
                                d="M469.2 75A75.6 75.6 0 1 0 317.9 75a75.6 75.6 0 1 0 151.2 0zM154.2 240.7A75.6 75.6 0 1 0 3 240.7a75.6 75.6 0 1 0 151.2 0zM57 346C75.6 392.9 108 433 150 461.1s91.5 42.6 142 41.7c-14.7-18.6-22.9-41.5-23.2-65.2c-6.8-.9-13.3-2.1-19.5-3.4c-26.8-5.7-51.9-17.3-73.6-34s-39.3-38.1-51.7-62.5c-20.9 9.9-44.5 12.8-67.1 8.2zm395.1 89.8a75.6 75.6 0 1 0 -151.2 0 75.6 75.6 0 1 0 151.2 0zM444 351.6c18.5 14.8 31.6 35.2 37.2 58.2c33.3-41.3 52.6-92.2 54.8-145.2s-12.5-105.4-42.2-149.4c-8.6 21.5-24 39.6-43.8 51.6c15.4 28.6 22.9 60.8 21.9 93.2s-10.7 64-28 91.6zM101.1 135.4c12.4 2.7 24.3 7.5 35.1 14.3c16.6-24.2 38.9-44.1 64.8-58S255.8 70.4 285.2 70c.2-5.9 .9-11.9 2-17.7c3.6-16.7 11.1-32.3 21.8-45.5c-47.7-3.8-95.4 6-137.6 28.5S94.3 91.7 70.8 133.4c2.7-.2 5.3-.3 8-.3c7.5 0 15 .8 22.4 2.3z" />
                        </svg>
                        gh-links
                    </a>
                </div>
            </div>
            {{-- <div class="">
                <button class="btn shadow-none px-3 btn-secondary mx-2">
                    <i class="fas fa-search"></i>
                </button>
            </div> --}}
            <button type="button" id="app-search" title="search gh-links" class="btn shadow-none px-3 btn-secondary mx-2">
                <i class="fas fa-search"></i>
            </button>
            <div class="search-dropdown shadow">
                <form action="#">
                    <div class="search-dialog" aria-labelledby="dropdownMenuButton">
                        <div class="card w-100 shadow-sm">
                            <div class="card-body">
                                <div class="modal-header pb-3">
                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                    <button id="close-search" title="exit search" type="button" class="btn shadow-sm">
                                        <i class="fa fa-xmark"></i>
                                    </button>
                                </div>
                                <div class="form-group">
                                    <input type="search" class="form-control" placeholder="Search...">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            @auth('candidate', 'employer')
                <div class="dropdown me-2">
                    <a href="#"
                        class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="#" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong>{{ auth('candidate')->user()?->username }}</strong>
                    </a>
                    <ul class="dropdown-menu text-small shadow">
                        @auth('employer')
                            <li><a class="dropdown-item" href="{{ route('employer.dashboard') }}">Dashboard</a></li>
                        @endauth
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" data-bs-toggle="modal" title="logout of your account"
                                href="#logout">Sign out
                            </a>
                        </li>
                    </ul>
                </div>
            @endauth
            @if (!auth('candidate')->check())
                <div class="text-end d-none d-sm-block mx-2">
                    <button onclick="window.open('{{ route('login') }}','_self')" type="button"
                        class="btn btn-outline-secondary me-2" title="login to your account">Login</button>
                    <button onclick="window.open('{{ route('register') }}','_self')" type="button"
                        class="btn btn-primary" title="create an account">Sign-up</button>
                </div>
            @endif
        </div>
    </header>
