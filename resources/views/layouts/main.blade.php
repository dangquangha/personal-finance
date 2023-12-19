<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert/index.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="{{ asset('plugins/select2/index.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

    <script src="{{ asset('plugins/sweetalert/index.js') }}"></script>
    <script>
        const toastMixin = Swal.mixin({
            toast: true,
            position: 'top-right',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast',
            },
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>

    @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('components.main.loader')

        @include('components.main.navbar')

        @include('components.main.sidebar')

        @yield('content')

        {{-- @include('components.main.footer') --}}
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-mask/index.js') }}"></script>
    <script src="{{ asset('plugins/select2/index.js') }}"></script>
    <script src="{{ asset('js/adminlte.js') }}"></script>

    <script src="{{ asset('js/layouts/main.js') }}"></script>

    @yield('script')
</body>

</html>