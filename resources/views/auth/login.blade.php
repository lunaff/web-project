<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Login | Aplikasi Kesiswaan</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    
    <body>

    <!-- <body data-layout="horizontal"> -->

    <div class="authentication-bg min-vh-100">
        <div class="bg-overlay bg-light"></div>
        <div class="container">
            <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-lg-6 col-xl-5">

                        <div class="mb-4 pb-2">
                            <a href="index.html" class="d-block auth-logo">
                                <img src="assets/images/logo-dark.png" alt="" height="30" class="auth-logo-dark me-start">
                                <img src="assets/images/logo-light.png" alt="" height="30" class="auth-logo-light me-start">
                            </a>
                        </div>

                        <div class="card">
                            <div class="card-body p-4"> 
                                <div class="text-center mt-2">
                                    <h5>LOGIN</h5>
                                </div>
                                <div class="p-2 mt-4">
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <!-- Email Field -->
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <div class="position-relative input-custom-icon">
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                                                <span class="bx bx-envelope"></span>
                                            </div>
                                        </div>

                                        <!-- Username Field -->
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Name</label>
                                            <div class="position-relative input-custom-icon">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                                                <span class="bx bx-user"></span>
                                            </div>
                                        </div>
                                    
                                        <!-- Password Field -->
                                        <div class="mb-3">
                                            <div class="float-end">
                                                <a href="auth-recoverpw.html" class="text-muted text-decoration-underline">Forgot password?</a>
                                            </div>
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup input-custom-icon">
                                                <span class="bx bx-lock-alt"></span>
                                                <input type="password" class="form-control" id="password-input" name="password" placeholder="Enter password">
                                                <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                                                    <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Level Field -->
                                        <div class="mb-3">
                                            <label class="form-label" for="level">Level</label>
                                            <select class="form-control" id="level" name="level">
                                                <option value="admin">Admin</option>
                                                <option value="operator">Operator</option>
                                                <option value="osis">Osis</option>
                                                <option value="bk">BK</option>
                                                <option value="kesiswaan">Kesiswaan</option>
                                            </select>
                                        </div>
                                    
                                        <!-- Remember Me -->
                                        <div class="form-check py-1">
                                            <input type="checkbox" class="form-check-input" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        </div>
                                    
                                        <!-- Submit Button -->
                                        <div class="mt-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div>
        </div><!-- end container -->
    </div>
    <!-- end authentication section -->

        <!-- JAVASCRIPT -->
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenujs/metismenujs.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/eva-icons/eva.min.js"></script>

        <script src="assets/js/pages/pass-addon.init.js"></script>

    </body>

</html>