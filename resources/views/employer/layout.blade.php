<!DOCTYPE html>
<html lang="en" data-layout-mode="detached" data-topbar-color="dark" data-menu-color="light" data-sidenav-user="true"
    data-bs-theme="light" data-layout-position="fixed" data-sidenav-size="default" class="menuitem-active">

<head>
    <meta charset="utf-8">
    <title>GH-LINKS DASHBOARD </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="author">
    <meta name="_token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('icon.svg') }}" />

    <!-- Theme Config Js -->
    <link rel="stylesheet" href="{{ asset('app/plugins/icons/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/plugins/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/plugins/jquery-ui/jquery-ui.theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/jquery-ui/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/alert/sweetalert2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/mdb/mdb.min.css') }}">
    <script src="{{ asset('app/plugins/alert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('app/plugins/jquery/external/jquery.js') }}"></script>
    <style>
        body {
            background-color: #fbfbfb;
        }

        @media (min-width: 789.98px) {
            main {
                padding-left: 260px;
            }

            .overview-container {
                width: 100%;
                max-width: 1024px !important;
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
            width: 260px;
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
                left: -260px;
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
                    <h6 class="h6 text-uppercase fw-semibold">employer dashboard</h6>
                    <a href="{{ route('employer.dashboard') }}"
                        class="list-group-item list-group-item-action text-capitalize py-2 ripple">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>overview</span>
                    </a>
                    {{-- @if (auth('employer')->user()->isEmailVerified()) --}}
                    <a href="{{ route('employer.company-profile') }}"
                        class="list-group-item list-group-item-action text-capitalize py-2 ripple">
                        <i class="far fa-user fa-fw me-3"></i><span>Profile Setup</span>
                    </a>
                    <a href="{{ route('my-jobs.create') }}"
                        class="list-group-item list-group-item-action text-capitalize py-2 ripple"><i
                            class="fas fa-suitcase fa-fw me-3"></i><span>post job</span></a>
                    <a href="{{ route('my-jobs.index') }}"
                        class="list-group-item list-group-item-action text-capitalize py-2 ripple"><i
                            class="far fa-bookmark fa-fw me-3"></i><span>my jobs</span></a>
                    <a href="{{ route('employer.candidates') }}"
                        class="list-group-item list-group-item-action text-capitalize py-2 ripple"><i
                            class="fa fa-user-plus fa-fw me-3"></i><span>saved candidates</span></a>
                    <a href="{{ route('my-account.show') }}"
                        class="list-group-item list-group-item-action text-capitalize py-2 ripple">
                        <i class="fas fa-gear fa-fw me-3"></i><span>account & security</span>
                    </a>
                    {{-- @endif --}}
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
                            class="d-flex align-items-center link-body-emphasis text-decoration-none bg-body-tertiary dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ auth('employer')->user()->employer?->dp ?? asset('app/plugins/icons/svgs/solid/user.svg') }}"
                                alt="" width="32" height="32" class="shadow-2 rounded-circle me-2 user">
                            <strong
                                style="min-width: 65px;">{{ auth('employer')->user()->employer?->company_name ?? auth('employer')->user()?->username }}</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-start shadow">
                            {{-- <li><a class="dropdown-item" href="#">New project...</a></li> --}}
                            <li>
                                <a class="dropdown-item" href="{{ route('my-account.show') }}">
                                    <i class="fa-solid fa-gear"></i>
                                    <span> Account </span>
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
                    {{-- <div class="btn-group">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            
                        </button>
                        <div class="dropdown-menu dropdown-menu-start" aria-labelledby="triggerId">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item disabled" href="#">Disabled action</a>
                            <h6 class="dropdown-header">Section header</h6>
                            <a class="dropdown-item" href="#">Action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">After divider action</a>
                        </div>
                    </div> --}}

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
    <script>
        (() => {
            self.addEventListener('DOMContentLoaded', () => {
                // remove candidates from the list
                const token = $('[name="_token"]').attr('content');
                $('button.unsave-candidate').on('click', async function(e) {
                    e.stopPropagation();
                    var candidate_id = $(this).data('candidate-id');
                    await $.ajax({
                        type: 'POST',
                        url: '/dashboard/unsave-candidate',
                        data: {
                            _token: token,
                            candidate_id: candidate_id,
                        },
                        success: function(data) {
                            if (data.success) {
                                window.location.href = data.url; // toggle the icon
                            }
                        },
                        error: function(err) {
                            console.log(err);
                        },
                    });
                });
                tinymce.init({
                    selector: 'textarea#about',
                    height: 300,
                    plugins: [
                        'advlist', 'lists', 'charmap', 'preview',
                        'anchor', 'searchreplace', 'visualblocks', 'fullscreen', 'media', 'table',
                        'help', 'wordcount'
                    ],
                    toolbar: 'undo redo | blocks | bold italic backcolor | ' +
                        'alignleft aligncenter alignright alignjustify | ' +
                        'bullist numlist outdent indent | removeformat | help'
                });
                tinymce.init({
                    selector: 'textarea#company_vision',
                    height: 300,
                    plugins: [
                        'advlist', 'lists', 'charmap', 'preview',
                        'anchor', 'searchreplace', 'visualblocks', 'fullscreen', 'media', 'table',
                        'help', 'wordcount'
                    ],
                    toolbar: 'undo redo | blocks | bold italic backcolor | ' +
                        'alignleft aligncenter alignright alignjustify | ' +
                        'bullist numlist outdent indent | removeformat | help'
                });
                // $('.selectize').selectize();
                $('.select2').select2({
                    // placeholder: 'Select an option',
                    allowClear: false,
                    // theme: 'bootstrap5',

                });

                var urlParams = new URLSearchParams(window.location.search);
                var activeTab = urlParams.get('tab');
                console.log(activeTab, $('a[href="#' + activeTab + '"]'));
                if (activeTab !== null) {
                    $('a[href="#' + activeTab + '"]').tab('show');
                }
            });
        })();
    </script>
    @yield('script')
</body>

</html>
