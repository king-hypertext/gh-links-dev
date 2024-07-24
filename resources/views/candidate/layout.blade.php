<!DOCTYPE html>
<html lang="en" data-layout-mode="detached" data-topbar-color="dark" data-menu-color="light" data-sidenav-user="true"
    data-bs-theme="light" data-layout-position="fixed" data-sidenav-size="default" class="menuitem-active">

<head>
    <meta charset="utf-8">
    <title>GH-LINKS Profile </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="author">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('icon.svg') }}" />

    <!-- Theme Config Js -->
    <link rel="stylesheet" href="{{ asset('icons/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('app/plugins/jquery-ui/jquery-ui.theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/jquery-ui/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/alert/sweetalert2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/mdb/mdb.min.css') }}">
    <script src="{{ asset('app/plugins/alert/sweetalert2.all.min.js') }}"></script>
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="{{ asset('app/plugins/jquery/external/jquery.js') }}"></script>
    <style>
        body {
            background-color: #fbfbfb;
        }

        @media (min-width: 789.98px) {
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

        /* @media (max-width: 100.98px) {
            .sidebar {
                width: 100%;
            }
        } */

        .sidebar .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
            /* left: 0 !important;
            transition: all 0.5s ease-in-out; */
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

        @media(max-width: 768px) {
            .sidebar {
                left: -240px;
                transition: all 0.3s ease-in-out;
            }

            .sidebar.active {
                left: 0 !important;
                transition: all 0.3s ease-in-out;
            }

            main {
                padding-left: 0 !important;
            }
        }

        #main-navbar {
            z-index: 606;
        }

        .tox-statusbar__branding {
            display: none !important;
        }

        .tox-promotion {
            visibility: hidden !important;
        }
    </style>
</head>

<body>
    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="sidebar bg-white">
            <div class="position-sticky fixed-top">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <h6 class="h6 text-uppercase fw-semibold">candidate dashboard</h6>
                    <a href="{{ route('profile.show') }}"
                        class="list-group-item list-group-item-action text-capitalize py-2 ripple">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>overview</span>
                    </a>
                    <a href="{{ route('candidate.profile.create') }}"
                        class="list-group-item list-group-item-action text-capitalize py-2 ripple">
                        <i class="far fa-user fa-fw me-3"></i><span>Profile Setup</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action text-capitalize py-2 ripple"><i
                            class="fas fa-suitcase fa-fw me-3"></i><span>applied jobs</span></a>
                    <a href="{{ route('candidate.saved-jobs') }}"
                        class="list-group-item list-group-item-action text-capitalize py-2 ripple"><i
                            class="far fa-bookmark fa-fw me-3"></i><span>saved jobs</span></a>
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
            <div class="container-fluid mx-md-3 mx-0">
                <!-- Toggle button -->
                <div class="d-flex flex-row align-items-center">
                    <button data-mdb-button-init onclick="document.querySelector('.sidebar').classList.toggle('active')"
                        class="navbar-toggler d-md-none" type="button" aria-controls="sidebarMenu"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Brand -->
                    <a class="navbar-brand text-uppercase" href="{{ route('home') }}">
                        <img src="{{ asset('icon.svg') }}" height="25" alt="MDB Logo" loading="lazy" />
                        gh-links
                    </a>
                </div>

                <!-- Right links -->
                <ul class="d-flex flex-row me-0 me-sm-3 mb-0">
                    <div class="dropdown ">
                        <a href="#"
                            class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ auth('candidate')->user()->profile->profile_picture ?? asset('icons/svgs/solid/user.svg') }}"
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
    <main>
        <div class="container-fluid pt-2">
            @yield('content')
        </div>
    </main>
    @include('modals.logout')
    <script type="text/javascript">
        const showSuccessAlert = Swal.mixin({
            position: 'top-right',
            toast: true,
            timer: 6500,
            showCloseButton: true,
            showConfirmButton: false,
            timerProgressBar: false,
            onOpen: () => {
                setInterval(() => {
                    Swal.close()
                }, 6500);
            },
            showClass: {
                popup: `
                    animate__animated
                    animate__fadeInDown
                    animate__faster
                    `
            },
        });
    </script>
    @if (session('success'))
        <script type="text/javascript">
            showSuccessAlert.fire({
                icon: 'success',
                text: '{{ session('success') }}',
                padding: '15px',
                width: 'auto'
            });
        </script>
    @endif
    @if (session('error'))
        <script type="text/javascript">
            showSuccessAlert.fire({
                icon: 'error',
                text: '{{ session('error') }}',
                padding: '15px',
                width: 'auto'
            });
        </script>
    @endif
    @if (session('warning'))
        <script type="text/javascript">
            showSuccessAlert.fire({
                icon: 'warning',
                text: '{{ session('warning') }}',
                padding: '15px',
                width: 'auto'
            });
        </script>
    @endif
    @if (session('info'))
        <script type="text/javascript">
            showSuccessAlert.fire({
                icon: 'info',
                text: '{{ session('info') }}',
                padding: '15px',
                width: 'auto'
            });
        </script>
    @endif
    <!--Main layout-->
    <script src="{{ asset('app/plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('app/plugins/mdb/mdb.umd.min.js') }}"></script>
    <script src="{{ asset('app/plugins/selectize/selectize.min.js') }}"></script>
    <script src="{{ asset('app/plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('app/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('app/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('app/app.js') }}"></script>
</body>

</html>
