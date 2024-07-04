<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{ asset('app/plugins/bootstrap/bootstrap.min.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('app/plugins/mdb/mdb.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('icons/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/app.css') }}" />
    <title>GH LINKS - {{ $page_title ?? '' }}</title>
    <script src="{{ asset('app/plugins/jquery/jquery.js') }}"></script>
    <style>
        .app-form {
            height: 100%;
            width: 100%;
            position: relative;
            display: flex;
            place-items: center;
            justify-content: center;
            background-color: inherit;
        }

        .input-group-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>

<body class="app-form">
    <div class="row justify-content-center container">
        <div class="card p-4 px-md-5 pb-3 border-0" style="max-width: 540px">
            <h5 class="h4 text-uppercase fw-semibold text-center">gh links</h5>
            <div class="text-center mt-2">
                <h6 class="h6" data-date-time="true"></h6>
            </div>
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('app/plugins/mdb/mdb.umd.min.js') }}"></script>
    <script src="{{ asset('app/auth.js') }}"></script>
</body>

</html>
