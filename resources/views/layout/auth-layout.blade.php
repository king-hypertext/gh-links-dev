<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('icon.svg') }}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{ asset('icon.svg') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('app/plugins/bootstrap/bootstrap.min.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('app/plugins/alert/sweetalert2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/mdb/mdb.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/icons/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/plugins/animate-css/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/app.css') }}" />
    <title>GH LINKS - {{ $page_title ?? '' }}</title>
    <script src="{{ asset('app/plugins/jquery/jquery.js') }}"></script>
    <script src="{{ asset('app/plugins/alert/sweetalert2.all.min.js') }}"></script>
</head>

<body class="app-form my-3">
    <div class="row justify-content-center container">
        <div class="card p-4 px-md-5 pb-3 border-0 animate__animated animate__fadeIn" style="max-width: 540px">
            <h5 class="h4 text-uppercase fw-semibold text-center user-select-none cursor-pointer mb-0"
                onclick="window.open('{{ route('home') }}','_self')">
                <img src="{{ asset('icon.svg') }}" height="20" alt="" class="d-none">
                gh links
            </h5>
            <div class="text-center mt-2">
                <h6 class="h6" data-date-time="true"></h6>
            </div>
            @yield('content')
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
    <script src="{{ asset('app/plugins/mdb/mdb.umd.min.js') }}"></script>
    <script src="{{ asset('app/auth.js') }}"></script>
</body>

</html>
