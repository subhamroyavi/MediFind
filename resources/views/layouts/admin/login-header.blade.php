<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/tocly/layouts/5.3.1/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Nov 2023 08:53:06 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Login | Admin & Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('admin_panel/assets/images/favicon.ico')}}">
    <!-- Layout Js -->
    <script src="{{asset('admin_panel/assets/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('admin_panel/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('admin_panel/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('admin_panel/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- CSRF TOKEN -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>

<body>

    <div class="auth-maintenance d-flex align-items-center min-vh-100">
        <div class="bg-overlay bg-light"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="auth-full-page-content d-flex min-vh-100 py-sm-5 py-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100 py-0 py-xl-3">
                                <div class="text-center mb-4">
                                    <a href="index.html" class="">
                                        <img src="{{asset('admin_panel/assets/images/logo-dark.png')}}" alt="" height="22" class="auth-logo logo-dark mx-auto">
                                        <img src="{{asset('admin_panel/assets/images/logo-light.png')}}" alt="" height="22" class="auth-logo logo-light mx-auto">
                                    </a>
                                    <p class="text-muted mt-2">User Experience & Interface Design Strategy Saas Solution</p>
                                </div>

                                <div class="card my-auto overflow-hidden">
                                    <div class="row g-0">
                                        <div class="col-lg-6">
                                            <div class="bg-overlay bg-primary"></div>
                                            <div class="h-100 bg-auth align-items-end">
                                            </div>
                                        </div>

                                        @yield('login-content')


                                    </div>
                                </div>
                                <!-- end card -->

                                <div class="mt-5 text-center">
                                    <p class="mb-0">© <script>
                                            document.write(new Date().getFullYear())
                                        </script> MediFind. Crafted with <i class="mdi mdi-heart text-danger"></i> by Subham Roy</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{asset('admin_panel/assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin_panel/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin_panel/assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('admin_panel/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('admin_panel/assets/libs/node-waves/waves.min.js')}}"></script>

    <!-- Icon -->
    <!-- <script src="../../../../unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script> -->

    <script src="{{asset('admin_panel/assets/js/app.js')}}"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @yield('js-content')


</body>

<!-- Mirrored from themesdesign.in/tocly/layouts/5.3.1/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Nov 2023 08:53:06 GMT -->

</html>