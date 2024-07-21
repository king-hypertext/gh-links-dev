<!DOCTYPE html>
<html lang="en" data-layout-mode="detached" data-topbar-color="dark" data-menu-color="light" data-sidenav-user="true"
    data-bs-theme="light" data-layout-position="fixed" data-sidenav-size="default" class="menuitem-active">

<head>
    <meta charset="utf-8">
    <title>GH-LINKS DASHBOARD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="author">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('icon.svg') }}" />

    <!-- Theme Config Js -->
    <link rel="stylesheet" href="{{ asset('icons/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/plugins/mdb/mdb.min.css') }}">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="{{ asset('app/plugins/jquery/external/jquery.js') }}"></script>
    <style>
        body {
            background-color: #fbfbfb;
        }

        @media (min-width: 991.98px) {
            main {
                padding-left: 240px;
            }
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 58px 0 0;
            /* Height of navbar */
            height: 100vh;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
            width: 240px;
            z-index: 600;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
            }
        }

        .sidebar .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto;
            /* Scrollable contents if viewport is shorter than content. */
        }

        #main-navbar {
            z-index: 606;
        }
    </style>
</head>

<body>
    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="  sidebar bg-white">
            <div class="position-sticky fixed-top">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <h6 class="h6 text-uppercase fw-semibold">candidate dashboard</h6>
                    <a href="#" class="list-group-item list-group-item-action text-capitalize py-2 ripple active">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>overview</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action text-capitalize py-2 ripple"><i
                            class="fas fa-suitcase fa-fw me-3"></i><span>applied jobs</span></a>
                    <a href="#" class="list-group-item list-group-item-action text-capitalize py-2 ripple"><i
                            class="fas fa-bookmark fa-fw me-3"></i><span>saved jobs</span></a>
                    <a href="#" class="list-group-item list-group-item-action text-capitalize py-2 ripple">
                        <i class="fas fa-gear fa-fw me-3"></i><span>settings</span>
                    </a>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar  navbar-light bg-white position-sticky top-0">
            <!-- Container wrapper -->
            <div class="container-fluid mx-3">
                <!-- Toggle button -->
                {{-- <button data-mdb-button-init class="navbar-toggler" type="button" data-mdb-collapse-init
                    data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button> --}}

                <!-- Brand -->
                <a class="navbar-brand text-uppercase" href="#">
                    <img src="{{ asset('icon.svg') }}" height="25" alt="MDB Logo" loading="lazy" />
                    gh-links
                </a>

                <!-- Right links -->
                <ul class="d-flex flex-row me-0 me-sm-3 mb-0">
                    <div class="dropdown ">
                        <a href="#"
                            class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ /* auth('candidate')->user()->profile->profile_image */ asset('icons/svgs/solid/user.svg') }}"
                                alt="" width="32" height="32" class="shadow-2 rounded-circle me-2">
                            <strong>{{ auth('candidate')->user()?->username }}</strong>
                        </a>
                        <ul class="dropdown-menu text-small shadow">
                            {{-- <li><a class="dropdown-item" href="#">New project...</a></li> --}}
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fa-solid fa-gear"></i>
                                    <span> Settings </span>
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
                </ul>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            @yield('content')

        </div>
    </main>
    <!--Main layout-->
    <script src="{{ asset('app/plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('app/plugins/mdb/mdb.umd.min.js') }}"></script>
</body>

</html>
