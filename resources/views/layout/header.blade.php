    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
    <header class="d-flex w-100 justify-content-center animate__animated" style="z-index: 1040">
        <div style="z-index: 1045;"
            class="app-container bg-white py-2 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center justify-content-sm-between">
                <button id="menu-toggler" type="button" data-bs-toggle="dropdown" data-bs-target="#menu"
                    class="btn btn-light mx-2 px-3" title="Menu">
                    <i id="toggler-icon" class="fas fa-bars"></i>
                </button>
                <ul class="dropdown-menu nav-menu fade shadow" id="menu">
                    <ul class="nav flex-column">
                        <h6 class="text-start text-uppercase my-2 d-flex justify-content-center align-items-center">
                            menu
                        </h6>
                        <hr class="my-0">
                        <li class="dropdown-item p-0">
                            <a href="#" class="nav-link active" aria-current="page">
                                <svg class="bi pe-none me-2" width="16" height="16">
                                    <use xlink:href="#home"></use>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li class="dropdown-item p-0">
                            <a href="#" class="nav-link link-body-emphasis">
                                <svg class="bi pe-none me-2" width="16" height="16">
                                    <use xlink:href="#speedometer2"></use>
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <hr class="mb-0">
                        @if (!auth()->check())
                            <li class="dropdown-item d-sm-none">
                                <div class="d-flex justify-content-start">
                                    <button type="button" class="btn btn-outline-secondary me-2" data-bs-toggle="modal"
                                        data-bs-target="#login" title="login to your account">Login</button>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#register" title="create an account">Sign-up</button>
                                </div>
                            </li>
                        @endif
                    </ul>
                </ul>
                <a href="/" class="align-items-center text-dark text-uppercase text-decoration-none">
                    gh-links
                </a>
            </div>
            <div class="">
                <button class="btn shadow-none px-3 btn-secondary mx-2">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            @auth
                <div class="dropdown me-2">
                    <a href="#"
                        class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="#" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong>mdo</strong>
                    </a>
                    <ul class="dropdown-menu text-small shadow">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
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
            @else
                <div class="text-end d-none d-sm-block mx-2">
                    <button type="button" class="btn btn-outline-secondary me-2" data-bs-toggle="modal"
                        data-bs-target="#login" title="login to your account">Login</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#register"
                        title="create an account">Sign-up</button>
                </div>
            @endauth
        </div>
    </header>
