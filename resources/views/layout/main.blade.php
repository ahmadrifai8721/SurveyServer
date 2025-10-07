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
    @livewireStyles
    @yield('css')
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">


        @include('layout/topbar')

        @include('layout/sidebar')


        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                @yield('content')

            </div>
            <!-- content -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    @include('layout/tools')
    <!-- Vendor js -->
    <script src="{{ url('/') }}/assets/js/vendor.min.js"></script>

    @livewireScripts

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
    </script>
    @if (session('success'))
        <script>
            Toast.fire({
                icon: "success",
                title: "{{ session('success') }}"
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            var html = "";
        </script>
        @foreach ($errors->all() as $error)
            <script>
                html += "<li>{{ $error }}</li>"
            </script>
        @endforeach
        <script>
            console.log(html)
            Toast.fire({
                icon: "danger",
                title: "<ul>" + html + "</ul>"
            });
        </script>
    @endif
    @yield('plugins')


    <!-- App js -->
    <script src="{{ url('/') }}/assets/js/app.min.js"></script>
    @yield('js')
</body>

</html>
