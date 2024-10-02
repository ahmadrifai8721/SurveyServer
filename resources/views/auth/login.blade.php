<!DOCTYPE html>
<html lang="en" data-layout="topnav" data-topbar-color="dark">

<head>
    <meta charset="utf-8" />
    <title>Log In | KISS BUNDA Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('/') }}/assets/images/favicon.ico">

    <!-- Theme Config Js -->
    <script src="{{ url('/') }}/assets/js/hyper-config.js"></script>

    <!-- App css -->
    <link href="{{ url('/') }}/assets/css/app-modern.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ url('/') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="pb-0 authentication-bg">

    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="gap-3 card-body d-flex flex-column h-100">

                <!-- Logo -->
                <div class="text-center auth-brand text-lg-start">
                    <a href="index.html" class="logo-dark">
                        <span><img src="{{ url('/') }}/assets/images/logo-dark.png" alt="dark logo"
                                height="100"></span>
                    </a>
                    <a href="index.html" class="logo-light">
                        <span><img src="{{ url('/') }}/assets/images/logo.png" alt="logo"
                                height="100"></span>
                    </a>
                </div>

                <div class="my-auto">
                    <!-- title-->
                    <h4 class="mt-0">Login</h4>
                    <p class="mb-4 text-muted">Silahkan masuk dengan akun yang sudah diberikan oleh admin
                    <h4 class="text-purple-500">KISS BUNDA</h4>
                    </p>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- form -->
                    <form action="{{ route('loginPagecheck') }}" method="POST">

                        @csrf

                        <div class="mb-3">
                            <label for="emailaddress" class="form-label">Email address</label>
                            <input class="form-control" type="email" id="emailaddress" required=""
                                placeholder="Enter your email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" type="password" required="" name="password" id="password"
                                placeholder="Enter your password">
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkbox-signin" name="remember"
                                    value="true">
                                <label class="form-check-label" for="checkbox-signin">Remember me</label>
                            </div>
                        </div>
                        <div class="mb-0 text-center d-grid">
                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-login"></i> Log In
                            </button>
                        </div>
                    </form>
                    <!-- end form-->
                </div>

                <!-- Footer-->
                <footer class="footer footer-alt">
                    <strong>
                        KISS BUNDA &copy 2024
                    </strong>
                </footer>

            </div> <!-- end .card-body -->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="text-center auth-fluid-right">
            <div class="auth-user-testimonial">
                <h2 class="mb-3">KISS BUNDA!</h2>
                <p class="lead"><i class="mdi mdi-format-quote-open text-capitalize"></i> aplikasi informasi untuk ibu
                    dan anak!
                    . <i class="mdi mdi-format-quote-close"></i>
                </p>
                <p>
                    - KISS BUNDA Admin User
                </p>
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->
    <!-- Vendor js -->
    <script src="{{ url('/') }}/assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="{{ url('/') }}/assets/js/app.min.js"></script>

</body>

</html>
