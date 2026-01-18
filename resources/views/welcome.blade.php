<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In | Velonic - Inventory System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{url('')}}/assets/images/favicon.ico">

    <!-- Theme Config Js -->
    <script src="{{url('')}}/assets/js/config.js"></script>

    <!-- App css -->
    <link href="{{url('')}}/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{url('')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <style>
        .authentication-bg {
            position: relative;
            overflow: hidden;
        }

        /* Background image */
        .authentication-bg::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url("{{ url('assets/images/invtry.jpg') }}");
            background-size: cover;
            background-position: center;
            filter: blur(8px);
            transform: scale(1.1);
            z-index: 0;
        }

        /* Dark overlay */
        .authentication-bg::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            z-index: 1;
        }

        /* Content */
        .account-pages {
            position: relative;
            z-index: 2;
        }

        /* Footer */
        .footer {
            position: relative;
            z-index: 3;
            color: #ffffff !important;
            text-align: center;
            padding-bottom: 10px;
        }

        /* Footer text override */
        .footer span,
        .footer span * {
            color: #ffffff !important;
        }
    </style>


</head>

<body class="authentication-bg position-relative">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-6">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <!-- <div class="col-lg-6 d-none d-lg-block p-2">
                                <img src="{{url('')}}/assets/images/auth-img.jpg" alt="" class="img-fluid rounded h-100">
                            </div> -->
                            <div>
                                <div class="d-flex flex-column h-100">
                                    <div class="auth-brand p-4 text-center">
                                        <a href="{{url('')}}/index.html" class="logo-light">
                                            <img src="{{url('')}}/assets/images/logo.png" alt="logo" height="22">
                                        </a>
                                        <a href="{{url('')}}/index.html" class="logo-dark">
                                            <img src="{{url('')}}/assets/images/logo-dark.png" alt="dark logo" height="22">
                                        </a>
                                    </div>
                                    <div class="p-4 my-auto">
                                        <div class="text-center">
                                            <h4 class="fs-20">Welcome to Inventory Management & POS System</h4>
                                            <p class="text-muted mb-3">Please select your role to access
                                            </p>
                                        </div>
                                        <div class="row g-2 mt-3">
                                            <div class="col-12 col-md-4">
                                                <a href="{{ route('login') }}" class="btn btn-soft-primary w-100">
                                                    <i class="ri-login-circle-fill me-1"></i> <b>Admin</b>
                                                </a>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <a href="{{ route('manager.login') }}" class="btn btn-soft-primary w-100">
                                                    <i class="ri-login-circle-fill me-1"></i> <b>Manager</b>
                                                </a>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <a href="{{ route('executive.login') }}" class="btn btn-soft-primary w-100">
                                                    <i class="ri-login-circle-fill me-1"></i> <b>Executive</b>
                                                </a>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>

            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt fw-medium">
        <span class="text-dark">
            <script>
                document.write(new Date().getFullYear())
            </script> © Velonic - by Md. Mahmudul Islam
        </span>
    </footer>
    <!-- Vendor js -->
    <script src="{{url('')}}/assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="{{url('')}}/assets/js/app.min.js"></script>

</body>

</html>