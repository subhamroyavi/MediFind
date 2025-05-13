<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/tocly/layouts/5.3.1/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Nov 2023 08:53:06 GMT -->

<head>

    <meta charset="utf-8" />
    <title>MediFind | Admin & Dashboard </title>
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
    <!-- https://fontawesome.com/search -->
    <link href="{{asset('admin_panel/assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">




</head>

<body data-sidebar="colored">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="index.html" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{asset('admin_panel/assets/images/logo-dark.png')}}" alt="logo-sm-dark" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="{{asset('admin_panel/assets/images/logo-sm-dark.png')}}" alt="logo-dark" height="25">
                            </span>
                        </a>

                        <a href="index.html" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{asset('admin_panel/assets/images/logo-light.png')}}" alt="logo-sm-light" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="{{asset('admin_panel/assets/images/logo-sm-light.png')}}" alt="logo-light" height="25">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn" id="vertical-menu-btn">
                        <!-- <i class="ri-menu-2-line align-middle"></i> -->
                        <i class="fa-solid fa-align-left"></i>
                    </button>

                    <!-- start page title -->
                    <div class="page-title-box align-self-center d-none d-md-block">
                        <h4 class="page-title mb-0"><i class="fas fa-heartbeat"></i>MediFind</h4>
                    </div>
                    <!-- end page title -->
                </div>

                <div class="d-flex">

                    <!-- App Search-->
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="fa-solid fa-magnifying-glass"></span>
                        </div>
                    </form>

                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="fa-solid fa-expand"></i>
                        </button>
                    </div>


                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                            <i class="fa-solid fa-gear"></i>
                        </button>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('admin_panel/assets/images/logo-sm-dark.png')}}" alt="logo-sm-dark" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('admin_panel/assets/images/logo-dark.png')}}" alt="logo-dark" height="22">
                    </span>
                </a>

                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('admin_panel/assets/images/logo-sm-light.png')}}" alt="logo-sm-light" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('admin_panel/assets/images/logo-light.png')}}" alt="logo-light" height="22">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn" id="vertical-menu-btn">
                <i class="fa-solid fa-align-left"></i>
            </button>

            <div data-simplebar class="vertical-scroll">

                <!--- Sidemenu -->
                <div id="sidebar-menu">


                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>

                        <li>
                            <a href="{{route('admin.dashboard')}}" class="waves-effect">
                                <!-- <i class="uim uim-airplay"></i> -->
                                <i class="fas fa-chart-line"></i>
                                <span class="badge rounded-pill bg-success float-end">3</span>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.users')}}" class="waves-effect">
                                <i class="fas fa-users"></i><span class="badge rounded-pill bg-success float-end">3</span>
                                <span>Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.hospitals')}}" class="waves-effect">
                                <i class="fas fa-hospital"></i>
                                <span class="badge rounded-pill bg-success float-end">3</span>
                                <span>Hospitals</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.doctors.index') }}" class="waves-effect">
                                <i class="fas fa-user-md"></i>
                                <span class="badge rounded-pill bg-success float-end">3</span>
                                <span>Doctors</span>
                            </a>
                        </li>

                        <li>
                            <a href="" class="waves-effect">
                                <i class="fas fa-ambulance"></i><span class="badge rounded-pill bg-success float-end">3</span>
                                <span>Ambulances</span>
                            </a>
                        </li>

                        <li class="menu-title">Pages</li>
                        <li>
                            <a href="{{route('admin.services')}}" class="waves-effect">
                                <i class="fas fa-stethoscope"></i><span class="badge rounded-pill bg-success float-end">3</span>
                                <span>Servies</span>
                            </a>
                        </li>

                    </ul>

                </div>
                <!-- Sidebar -->
            </div>

            <div class="dropdown px-3 sidebar-user sidebar-user-info">
                <button type="button" class="btn w-100 px-0 border-0" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="admin_panel/assets/images/users/avatar-2.jpg" class="img-fluid header-profile-user rounded-circle" alt="">
                        </div>

                        <div class="flex-grow-1 ms-2 text-start">
                            <span class="ms-1 fw-medium user-name-text">Steven Deese</span>
                        </div>

                        <div class="flex-shrink-0 text-end">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </div>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>


                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="#"><span class="badge bg-primary mt-1 float-end">New</span><i class="mdi mdi-cog-outline text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Settings</span></a>

                    <a class="dropdown-item" href="auth-lock-screen.html"><i class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Lock screen</span></a>

                    <a class="dropdown-item" href="{{route('admin.logout')}}"><i class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Log Out</span></a>
                </div>
            </div>

        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    @yield('content')

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © MediFind.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Crafted with <i class="mdi mdi-heart text-danger"></i> by SubhamRoy
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title d-flex align-items-center px-3 py-4">

                <h5 class="m-0 me-2">Settings</h5>

                <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
            </div>

            <!-- Settings -->
            <hr class="mt-0" />
            <h6 class="text-center mb-0">Choose Layouts</h6>

            <div class="p-4">
                <div class="mb-2">
                    <img src="{{asset('admin_panel/assets/images/layouts/layout-1.jpg')}}" class="img-fluid img-thumbnail" alt="layout-1">
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                    <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                </div>

                <div class="mb-2">
                    <img src="{{asset('admin_panel/assets/images/layouts/layout-2.jpg')}}" class="img-fluid img-thumbnail" alt="layout-2">
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch" data-bsStyle="admin_panel/assets/css/bootstrap-dark.min.css" data-appStyle="admin_panel/assets/css/app-dark.min.html">
                    <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                </div>
            </div>

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="{{asset('admin_panel/assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin_panel/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin_panel/assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('admin_panel/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('admin_panel/assets/libs/node-waves/waves.min.js')}}"></script>

    <!-- Icon -->
    <script src="../../../../unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

    <!-- twitter-bootstrap-wizard js -->
    <script src="{{asset('admin_panel/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>

    <script src="{{asset('admin_panel/assets/libs/twitter-bootstrap-wizard/prettify.js')}}"></script>

    <!-- form wizard init -->
    <script src="{{asset('admin_panel/assets/js/pages/form-wizard.init.js')}}"></script>

    <script src="{{asset('admin_panel/assets/js/app.js')}}"></script>
    <script src="{{asset('admin_panel/assets/libs/select2/js/select2.min.js')}}"></script>


</body>

<!-- Mirrored from themesdesign.in/tocly/layouts/5.3.1/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Nov 2023 08:53:06 GMT -->

</html>