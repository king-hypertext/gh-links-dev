<!DOCTYPE html>
<html lang="en" data-layout-mode="detached" data-topbar-color="dark" data-menu-color="light" data-sidenav-user="true"
    data-bs-theme="light" data-layout-position="fixed" data-sidenav-size="default" class="menuitem-active">

<head>
    <meta charset="utf-8">
    <title>GH-LINKS DASHBOARD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Kingsley Osei Opoku" name="author">
    <link rel="shortcut icon" href="{{ asset('icon.svg') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('app/dashboard/css/icons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/jquery-ui/jquery-ui.theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/jquery-ui/jquery-ui.css') }}" />

    <link rel="stylesheet" href="{{ asset('icons/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/dashboard/dropzone/dropzone.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/alert/sweetalert2.min.css') }}" />
    <link href="{{ asset('app/dashboard/css/app-modern.min.css') }}" rel="stylesheet" id="app-style" />
    <link rel="stylesheet" href="{{ asset('app/plugins/mdb/mdb.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/select2/css/select2.min.css') }}" />
    <script src="{{ asset('app/dashboard/js/hyper-config.js') }}"></script>
    <script src="{{ asset('app/plugins/alert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('app/plugins/jquery/external/jquery.js') }}"></script>
    <style>
        .tox-statusbar__branding {
            display: none !important;
        }

        .tox-promotion {
            visibility: hidden !important;
        }
    </style>
</head>

<body class="show">
    @php
        $user = auth('employer')->user();
    @endphp
    <!-- Nothing worth having comes easy. - Theodore Roosevelt -->
    <div class="wrapper">


        <!-- ========== Topbar Start ========== -->
        <div class="navbar-custom">
            <div class="topbar container-fluid">
                <div class="d-flex align-items-center gap-lg-2 gap-1">

                    <!-- Topbar Brand Logo -->
                    {{-- <div class="logo-topbar">
                        <!-- Logo light -->
                        <a href="index.html" class="logo-light">
                            <span class="logo-lg">
                                <img src="assets/images/logo.png" alt="logo">
                            </span>
                            <span class="logo-sm">
                                <img src="assets/images/logo-sm.png" alt="small logo">
                            </span>
                        </a>

                        <!-- Logo Dark -->
                        <a href="index.html" class="logo-dark">
                            <span class="logo-lg">
                                <img src="assets/images/logo-dark.png" alt="dark logo">
                            </span>
                            <span class="logo-sm">
                                <img src="assets/images/logo-dark-sm.png" alt="small logo">
                            </span>
                        </a>
                    </div> --}}

                    <!-- Sidebar Menu Toggle Button -->
                    <button class="button-toggle-menu">
                        <i class="fa-solid fa-bars-staggered fa-sm"></i>
                    </button>

                    <!-- Horizontal Menu Toggle Button -->
                    <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <ul class="topbar-menu d-flex align-items-center gap-3">
                    <li class="dropdown d-lg-none">
                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ri-search-line font-22"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                            <form class="p-3">
                                <input type="search" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username">
                            </form>
                        </div>
                    </li>


                    <li class="d-none d-sm-inline-block">
                        <div class="nav-link" id="light-dark-mode" data-bs-toggle="tooltip" data-bs-placement="left"
                            aria-label="Theme Mode" data-bs-original-title="Theme Mode">
                            <i class="ri-moon-line font-22"></i>
                        </div>
                    </li>


                    <li class="d-none d-md-inline-block">
                        <a class="nav-link" href="" data-toggle="fullscreen">
                            <i class="ri-fullscreen-line font-22"></i>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="account-user-avatar">
                                {{-- <img src="assets/images/users/avatar-1.jpg" alt="user-image" width="32"
                                    class="rounded-circle"> --}}
                                {{-- <svg style="height: 25;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path
                                        d="M256 288A144 144 0 1 0 256 0a144 144 0 1 0 0 288zm-94.7 32C72.2 320 0 392.2 0 481.3c0 17 13.8 30.7 30.7 30.7H481.3c17 0 30.7-13.8 30.7-30.7C512 392.2 439.8 320 350.7 320H161.3z" />
                                </svg> --}}
                            </span>
                            <span class="d-lg-flex flex-column gap-1 d-none">
                                <h5 class="my-0 h6">{{ $user?->full_name }}</h5>
                                <h6 class="my-0 h6 fw-normal" style="font-size: 10px;">{{ $user?->username }}</h6>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                            <!-- item-->
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>

                            <!-- item-->
                            <a href="{{ route('my-account.show') }}" class="dropdown-item">
                                <i class="mdi mdi-account-circle me-1"></i>
                                <span>My Account</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="mdi mdi-account-edit me-1"></i>
                                <span>Settings</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="mdi mdi-lifebuoy me-1"></i>
                                <span>Support</span>
                            </a>
                            <a href="{{ route('employer.logout') }}" class="dropdown-item">
                                <i class="mdi mdi-logout me-1"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ========== Topbar End ========== -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu menuitem-active">

            <!-- Brand Logo Light -->
            {{-- <a href="index.html" class="logo logo-light">
                <span class="logo-lg">
                    <img src="assets/images/logo.png" alt="logo">
                </span>
                <span class="logo-sm">
                    <img src="assets/images/logo-sm.png" alt="small logo">
                </span>
            </a> --}}

            <!-- Brand Logo Dark -->
            {{-- <a href="index.html" class="logo logo-dark">
                <span class="logo-lg">
                    <img src="assets/images/logo-dark.png" alt="dark logo">
                </span>
                <span class="logo-sm">
                    <img src="assets/images/logo-dark-sm.png" alt="small logo">
                </span>
            </a> --}}

            <!-- Sidebar Hover Menu Toggle Button -->
            <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right"
                aria-label="Show Full Sidebar" data-bs-original-title="Show Full Sidebar">
                <i class="fa-solid fa-bars-staggered align-middle"></i>
            </div>

            <!-- Full Sidebar Menu Close Button -->
            <div class="button-close-fullsidebar">
                <i class="fa-solid fa-compress-arrows-alt align-middle"></i>
            </div>

            <!-- Sidebar -->
            <div class="h-100 show simplebar-scrollable-y" id="leftside-menu-container" data-simplebar="init">
                <div class="simplebar-wrapper" style="margin: 0px;">
                    <div class="simplebar-height-auto-observer-wrapper">
                        <div class="simplebar-height-auto-observer"></div>
                    </div>
                    <div class="simplebar-mask">
                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                                <div class="simplebar-content" style="padding: 0px;">
                                    <!-- Leftbar User -->
                                    <div class="leftbar-user">
                                        <a href="{{ route('my-account.show') }}" title="Profile">
                                            {{-- <img src="assets/images/users/avatar-1.jpg" alt="user-image"
                                                height="45" class="rounded-circle shadow-sm d-none"> --}}
                                            <svg class="rounded-circle shadow" style="height: 65px;width: 65px;"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                <path
                                                    d="M96 128a128 128 0 1 0 256 0A128 128 0 1 0 96 128zm94.5 200.2l18.6 31L175.8 483.1l-36-146.9c-2-8.1-9.8-13.4-17.9-11.3C51.9 342.4 0 405.8 0 481.3c0 17 13.8 30.7 30.7 30.7H162.5c0 0 0 0 .1 0H168 280h5.5c0 0 0 0 .1 0H417.3c17 0 30.7-13.8 30.7-30.7c0-75.5-51.9-138.9-121.9-156.4c-8.1-2-15.9 3.3-17.9 11.3l-36 146.9L238.9 359.2l18.6-31c6.4-10.7-1.3-24.2-13.7-24.2H224 204.3c-12.4 0-20.1 13.6-13.7 24.2z" />
                                            </svg>
                                            <span
                                                class="leftbar-user-name mt-2">{{ $user?->username ?? 'username' }}</span>
                                        </a>
                                    </div>

                                    <!--- Sidemenu -->
                                    <ul class="side-nav">

                                        <li class="side-nav-title">Navigation</li>

                                        <li class="side-nav-item">
                                            <a href="{{ route('employer.dashboard') }}" class="side-nav-link py-1">
                                                <i class="fa-solid fa-chart-simple"></i> {{-- <span class="badge bg-success float-end">5</span> --}}
                                                <span> Dashboard </span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('employer.company-profile') }}"
                                                class="side-nav-link py-1">
                                                <i class="fa fa-user-circle"></i>
                                                <span> Profile Setup</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('my-jobs.create') }}" class="side-nav-link py-1">
                                                <i class="fa-regular fa-square-plus"></i>
                                                <span> Post a Job </span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('job.index') }}" class="side-nav-link py-1">
                                                <i class="fas fa-suitcase"></i>
                                                <span> My Jobs</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="#" class="side-nav-link py-1">
                                                <i class="fa-solid fa-bookmark"></i>
                                                <span> Saved Candidates </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!--- End Sidemenu -->

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="simplebar-placeholder" style="width: 260px; height: 2065px;"></div>
                </div>
                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                    <div class="simplebar-scrollbar"
                        style="width: 0px; display: none; transform: translate3d(0px, 0px, 0px);"></div>
                </div>
                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                    <div class="simplebar-scrollbar"
                        style="height: 1549px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                </div>
            </div>
        </div>
        <!-- ========== Left Sidebar End ========== -->


        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right text-uppercase">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a
                                                href="{{ route('employer.dashboard') }}">dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">employer</a></li>
                                        <li class="breadcrumb-item active">{{ $path ?? '' }}</li>
                                    </ol>
                                </div>
                                <h4 class="page-title text-uppercase">{{ $path ?? '' }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                    @yield('content')

                </div> <!-- container -->

            </div> <!-- content -->
        </div>
    </div>
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
    <script src="{{ asset('app/dashboard/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ asset('app/plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('app/plugins/mdb/mdb.umd.min.js') }}"></script>
    <script src="{{ asset('app/plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('app/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('app/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('app/dashboard/js/app.min.js') }}"></script>
    <script src="{{ asset('app/dashboard/dashboard.js') }}"></script>
</body>

</html>
