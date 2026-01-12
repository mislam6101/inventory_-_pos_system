<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Register | Velonic - Inventory Management System</title>
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
</head>

<body class="authentication-bg">

    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-6">
                    <div class="card overflow-hidden bg-opacity-25">
                        <div class="row g-0">
                            <!-- <div class="col-lg-6 d-none d-lg-block p-2">
                                <img src="{{url('')}}/assets/images/auth-img.jpg" alt="" class="img-fluid rounded h-100">
                            </div> -->
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
                                        <h4 class="fs-20">Executive Sign Up</h4>
                                        <p class="text-muted mb-3">Enter your email address and password to access
                                            account.</p>
                                    </div>

                                    <!-- form -->
                                    <form method="POST" action="{{ route('executive.register') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="fullname" class="form-label">Full Name</label>
                                            <input class="form-control" type="text" id="fullname" name="name"
                                                placeholder="Your name" required="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="emailaddress" class="form-label">Email address</label>
                                            <input class="form-control" type="email" id="emailaddress" required="" name="email"
                                                placeholder="name@email.com">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Create Password</label>
                                            <input class="form-control" type="password" required="" id="password" name="password"
                                                placeholder="Create password">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Confirm Password</label>
                                            <input class="form-control" type="password" required="" id="password" name="password_confirmation"
                                                placeholder="Confirm password">
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    id="checkbox-signup">
                                                <label class="form-check-label" for="checkbox-signup">I accept <a
                                                        href="{{url('')}}/javascript: void(0);" class="text-muted">Terms and
                                                        Conditions</a></label>
                                            </div>
                                        </div>
                                        <div class="mb-0 d-grid text-center">
                                            <button class="btn btn-primary fw-semibold" type="submit">Sign
                                                Up</button>
                                        </div><br>
                                        <div class="col-12 text-center">
                                            <p class="text-dark-emphasis">Already have account? <a href="{{ route('executive.login') }}"
                                                    class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Log In</b></a>
                                            </p>
                                        </div>
                                        <div class="text-center mt-4">
                                            <p class="text-muted fs-16">Sign in with</p>
                                            <div class="d-flex gap-2 justify-content-center mt-3">
                                                <a href="{{url('')}}/javascript: void(0);" class="btn btn-soft-primary"><i
                                                        class="ri-facebook-circle-fill"></i></a>
                                                <a href="{{url('')}}/javascript: void(0);" class="btn btn-soft-danger"><i
                                                        class="ri-google-fill"></i></a>
                                                <a href="{{url('')}}/javascript: void(0);" class="btn btn-soft-info"><i
                                                        class="ri-twitter-fill"></i></a>
                                                <a href="{{url('')}}/javascript: void(0);" class="btn btn-soft-dark"><i
                                                        class="ri-github-fill"></i></a>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- end form-->
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>

    <!-- end row -->
    </div>
    <!-- end container -->
    </div>
    <!-- end page -->
    <footer class="footer footer-alt fw-medium">
        <span class="text-dark-emphasis">
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