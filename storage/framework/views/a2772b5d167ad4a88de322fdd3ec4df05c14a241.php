<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-ILSIxQ2qmc8hftZE"></script>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(url('Bootstrap')); ?>/assets/images/favicon.png">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <!-- Custom CSS -->
    <link href="<?php echo e(url('Bootstrap')); ?>/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="<?php echo e(url('Bootstrap')); ?>/assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="<?php echo e(url('Bootstrap')); ?>/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="<?php echo e(url('Bootstrap')); ?>/assets/libs/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
    <link href="<?php echo e(url('Bootstrap')); ?>/assets/extra-libs/calendar/calendar.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="<?php echo e(url('Bootstrap')); ?>/assets/libs/magnific-popup/dist/magnific-popup.css" rel="stylesheet">
    <link href="<?php echo e(url('Bootstrap')); ?>/dist/css/style.min.css" rel="stylesheet">
    <script src="<?php echo e(url('Bootstrap')); ?>/assets/libs/jquery/dist/jquery.min.js"></script>
    <link href="<?php echo e(url('MyAsset')); ?>/css/jquery.dataTables.css" rel="stylesheet">
    <script src="<?php echo e(url('MyAsset')); ?>/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <a href="index.html" class="logo">
                            <!-- Logo icon -->
                            <b class="logo-icon">
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Dark Logo icon -->
                                
                                
                                <h1  class="dark-logo" style="color: black">E-Kasir</h1>
                                
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span class="logo-text">

                                
                                <!-- dark Logo text -->
                                
                                
                                
                            </span>
                        </a>
                        <a class="sidebartoggler d-none d-md-block" href="javascript:void(0)"
                            data-sidebartype="mini-sidebar">
                            <i class="mdi mdi-toggle-switch mdi-toggle-switch-off font-20"></i>
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti-more"></i>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <!-- <li class="nav-item d-none d-md-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                                <i class="mdi mdi-menu font-24"></i>
                            </a>
                        </li> -->
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->

                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href=""
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php if(!empty($userData->photoUser)): ?>
                                    <img src="<?php echo e(url('Uploads/photoUser/', [$userData->photoUser])); ?>" alt="user"
                                        class="rounded-circle" width="40">
                                <?php else: ?>
                                    <img src="<?php echo e(url('Bootstrap')); ?>/assets/images/users/2.jpg" alt="user"
                                        class="rounded-circle" width="40">
                                <?php endif; ?>
                                <span class="m-l-5 font-medium d-none d-sm-inline-block">
                                    <?php if($userData->nameUser != null): ?>
                                        <?php echo e($userData->nameUser); ?>

                                    <?php else: ?>
                                        <?php echo e($userData->usernameUser); ?>

                                    <?php endif; ?>
                                    - <?php echo e($userData->levelUser); ?>

                                    <i class="mdi mdi-chevron-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow">
                                    <span class="bg-primary"></span>
                                </span>
                                <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                    <div class="">
                                        <?php if(!empty($userData->photoUser)): ?>
                                            <img src="<?php echo e(url('Uploads/photoUser/', [$userData->photoUser])); ?>"
                                                alt="user" class="rounded-circle" width="40">
                                        <?php else: ?>
                                            <img src="<?php echo e(url('Bootstrap')); ?>/assets/images/users/2.jpg"
                                                alt="user" class="rounded-circle" width="40">
                                        <?php endif; ?>
                                    </div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0">
                                            <?php if($userData->nameUser != null): ?>
                                                <?php echo e($userData->nameUser); ?>

                                            <?php else: ?>
                                                <?php echo e($userData->usernameUser); ?>

                                            <?php endif; ?>
                                            - <?php echo e($userData->levelUser); ?>

                                        </h4>
                                        <p class=" m-b-0"><?php echo e($userData->emailUser); ?></p>
                                    </div>
                                </div>
                                <div class="profile-dis scrollable">

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo e(route('editProfile')); ?>">
                                        <i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>">
                                        <i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                    <div class="dropdown-divider"></div>
                                </div>

                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">

                        <?php if($userData->levelUser =="admin"): ?>
                        <li class="nav-small-cap">
                            <i class="fas fa-user"></i>
                            <span class="hide-menu">Menu</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo e(route('dashboard')); ?>" aria-expanded="false">
                                <i class="fas fa-tachometer-alt"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo e(route('product')); ?>" aria-expanded="false">
                                <i class="fas fa-cube"></i>
                                <span class="hide-menu">Produk</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo e(route('orderCategory')); ?>" aria-expanded="false">
                                <i class="fas fa-box"></i>
                                <span class="hide-menu">Order Category</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo e(route('schedule')); ?>" aria-expanded="false">
                                <i class="fas fa-calendar"></i>
                                <span class="hide-menu">Jadwal</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo e(route('employeSchedule')); ?>" aria-expanded="false">
                                <i class="fas fa-calendar-alt"></i>
                                <span class="hide-menu">Jadwal Kasir</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo e(route('user')); ?>" aria-expanded="false">
                                <i class="fas fa-users"></i>
                                <span class="hide-menu">User</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo e(route('transaction')); ?>" aria-expanded="false">
                               <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                <span class="hide-menu">Transaction</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo e(route('reportOrder')); ?>" aria-expanded="false">
                                <i class="fas fa-chart-bar"></i>
                                <span class="hide-menu">Report Order</span>
                            </a>
                        </li>
                        <?php elseif($userData->levelUser == "kasir"): ?>
                        <li class="nav-small-cap">
                            <i class="fas fa-user"></i>
                            <span class="hide-menu">Menu</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo e(route('dashboard')); ?>" aria-expanded="false">
                                <i class="fas fa-tachometer-alt"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo e(route('employeSchedule')); ?>" aria-expanded="false">
                                <i class="fas fa-calendar-alt"></i>
                                <span class="hide-menu">Jadwal Kasir</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo e(route('user')); ?>" aria-expanded="false">
                                <i class="fas fa-users"></i>
                                <span class="hide-menu">User</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo e(route('transaction')); ?>" aria-expanded="false">
                               <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                <span class="hide-menu">Transaction</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo e(route('reportOrder')); ?>" aria-expanded="false">
                                <i class="fas fa-chart-bar"></i>
                                <span class="hide-menu">Report Order</span>
                            </a>
                        </li>
                        <?php else: ?>

                        <?php endif; ?>


                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title"><?php echo $__env->yieldContent('pageTitle'); ?></h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo $__env->yieldContent('back'); ?>"><?php echo $__env->yieldContent('breadcrumb'); ?></a>
                                    </li>
                                    <?php if(!empty(trim($__env->yieldContent('breadcrumb2')))): ?>
                                        <li class="breadcrumb-item active" aria-current="page"><?php echo $__env->yieldContent('breadcrumb2'); ?></li>
                                    <?php endif; ?>



                                    <?php if(!empty(trim($__env->yieldContent('breadcrumb3')))): ?>
                                        <li class="breadcrumb-item active" aria-current="page"><?php echo $__env->yieldContent('breadcrumb3'); ?></li>
                                    <?php endif; ?>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by Nice admin. Designed and Developed by
                <a href="https://wrappixel.com">WrapPixel</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->

    <div class="chat-windows"></div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->


    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo e(url('Bootstrap')); ?>/assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo e(url('Bootstrap')); ?>/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo e(url('Bootstrap')); ?>/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="<?php echo e(url('Bootstrap')); ?>/dist/js/app.min.js"></script>

    <script>
        var isDarkMode = "<?php echo e($userData->themeUser); ?>";

        var scriptSrc;

        if (isDarkMode === "light") {
            scriptSrc = "<?php echo e(url('Bootstrap')); ?>/dist/js/app.init.light.js";
        } else if (isDarkMode === "dark") {
            scriptSrc = "<?php echo e(url('Bootstrap')); ?>/dist/js/app.init.dark.js";
        }

        var scriptElement = document.createElement('script');
        scriptElement.src = scriptSrc;
        document.head.appendChild(scriptElement);
    </script>


    <script src="<?php echo e(url('Bootstrap')); ?>/dist/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo e(url('Bootstrap')); ?>/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo e(url('Bootstrap')); ?>/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo e(url('Bootstrap')); ?>/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo e(url('Bootstrap')); ?>/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo e(url('Bootstrap')); ?>/dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="<?php echo e(url('Bootstrap')); ?>/assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="<?php echo e(url('Bootstrap')); ?>/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <!--c3 charts -->
    <script src="<?php echo e(url('Bootstrap')); ?>/assets/extra-libs/c3/d3.min.js"></script>
    <script src="<?php echo e(url('Bootstrap')); ?>/assets/extra-libs/c3/c3.min.js"></script>
    <script src="<?php echo e(url('Bootstrap')); ?>/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?php echo e(url('Bootstrap')); ?>/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?php echo e(url('Bootstrap')); ?>/dist/js/pages/dashboards/dashboard1.js"></script>
    <script src="<?php echo e(url('Bootstrap')); ?>/assets/libs/moment/min/moment.min.js"></script>
    <script src="<?php echo e(url('Bootstrap')); ?>/assets/libs/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="<?php echo e(url('Bootstrap')); ?>/dist/js/pages/calendar/cal-init.js"></script>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\Skripsi\ekasir\resources\views/Dashboard/app.blade.php ENDPATH**/ ?>