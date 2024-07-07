<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('icon.svg') }}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{ asset('icon.svg') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/selectize/selectize.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/jquery-ui/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/jquery-ui/jquery-ui.theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/selectize/selectize.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/bootstrap/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/icons/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/mdb/mdb.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/icons/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/animate-css/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/alert/sweetalert2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/app.css') }}">
    <title>GH LINKS - {{ $page_title ?? '' }}</title>
    <script src="{{ asset('app/plugins/alert/sweetalert2.all.min.js') }}"></script>

    <script src="{{ asset('app/plugins/jquery/jquery.js') }}"></script>
</head>

<body class="bg-white ">
    <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
    @include('layout.header')
    <main class="app-container container px-0">
        <div class="container-fluid px-0">

            @yield('content')
        </div>
        @include('modals.login')
        @include('modals.register')
        @include('modals.logout')
    </main>
    <footer class="text-bg-dark">
        @include('layout.footer')
    </footer>
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
    <script src="{{ asset('app/plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('app/plugins/mdb/mdb.umd.min.js') }}"></script>
    <script src="{{ asset('app/plugins/selectize/selectize.min.js') }}"></script>
    <script src="{{ asset('app/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('app/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('app/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('app/app.js') }}"></script>
    <script src="{{ asset('app/auth.js') }}"></script>
</body>

</html>
