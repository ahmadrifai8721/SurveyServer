<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $pageTitle }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('/') }}/assets/images/favicon.ico">

    <!-- Plugin css -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet"
        href="{{ url('/') }}/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css">

    <!-- Theme Config Js -->
    <script src="{{ url('/') }}/assets/js/hyper-config.js"></script>

    <!-- App css -->
    <link href="{{ url('/') }}/assets/css/app-modern.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ url('/') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body>

    @yield('content')


    <!-- Vendor js -->
    <script src="{{ url('/') }}/assets/js/vendor.min.js"></script>
    @yield('plugins')


    <!-- App js -->
    <script src="{{ url('/') }}/assets/js/app.min.js"></script>
    @yield('js')
</body>

</html>
