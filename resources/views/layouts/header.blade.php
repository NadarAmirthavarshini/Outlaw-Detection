<?php
// session_start();
// if(!isset($_SESSION["id"])){
//       header("Location: login");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Outlaw Detection</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script> --}}

    {{-- <!-- Customized Bootstrap Stylesheet -->
    <link href="resources\css\bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="resources\css\style.css" rel="stylesheet"> --}}
      <!-- Customized Bootstrap Stylesheet -->
      {{-- <link href="css/bootstrap.min.css" rel="stylesheet"> --}}

      <!-- Template Stylesheet -->
      {{-- <link href="css/style.css" rel="stylesheet"> --}}
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<style>
    /********** Template CSS **********/
:root {
    --primary: #009CFF;
    --light: #F3F6F9;
    --dark: #191C24;
}

.back-to-top {
    position: fixed;
    display: none;
    right: 45px;
    bottom: 45px;
    z-index: 99;
}


/*** Spinner ***/
#spinner {
    opacity: 0;
    visibility: hidden;
    transition: opacity .5s ease-out, visibility 0s linear .5s;
    z-index: 99999;
}

#spinner.show {
    transition: opacity .5s ease-out, visibility 0s linear 0s;
    visibility: visible;
    opacity: 1;
}


/*** Button ***/
.btn {
    transition: .5s;
}

.btn.btn-primary {
    color: #FFFFFF;
}

.btn-square {
    width: 38px;
    height: 38px;
}

.btn-sm-square {
    width: 32px;
    height: 32px;
}

.btn-lg-square {
    width: 48px;
    height: 48px;
}

.btn-square,
.btn-sm-square,
.btn-lg-square {
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: normal;
    border-radius: 50px;
}


/*** Layout ***/
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    width: 250px;
    height: 100vh;
    overflow-y: auto;
    background: var(--light);
    transition: 0.5s;
    z-index: 999;
}

.content {
    margin-left: 250px;
    min-height: 100vh;
    background: #FFFFFF;
    transition: 0.5s;
}

@media (min-width: 992px) {
    .sidebar {
        margin-left: 0;
    }

    .sidebar.open {
        margin-left: -250px;
    }

    .content {
        width: calc(100% - 250px);
    }

    .content.open {
        width: 100%;
        margin-left: 0;
    }
}

@media (max-width: 991.98px) {
    .sidebar {
        margin-left: -250px;
    }

    .sidebar.open {
        margin-left: 0;
    }

    .content {
        width: 100%;
        margin-left: 0;
    }
}


/*** Navbar ***/
.sidebar .navbar .navbar-nav .nav-link {
    padding: 7px 20px;
    color: var(--dark);
    font-weight: 500;
    border-left: 3px solid var(--light);
    border-radius: 0 30px 30px 0;
    outline: none;
}

.sidebar .navbar .navbar-nav .nav-link:hover,
.sidebar .navbar .navbar-nav .nav-link.active {
    color: var(--primary);
    background: #FFFFFF;
    border-color: var(--primary);
}

.sidebar .navbar .navbar-nav .nav-link i {
    width: 40px;
    height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #FFFFFF;
    border-radius: 40px;
}

.sidebar .navbar .navbar-nav .nav-link:hover i,
.sidebar .navbar .navbar-nav .nav-link.active i {
    background: var(--light);
}

.sidebar .navbar .dropdown-toggle::after {
    position: absolute;
    top: 15px;
    right: 15px;
    border: none;
    content: "\f107";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    transition: .5s;
}

.sidebar .navbar .dropdown-toggle[aria-expanded=true]::after {
    transform: rotate(-180deg);
}

.sidebar .navbar .dropdown-item {
    padding-left: 25px;
    border-radius: 0 30px 30px 0;
}

.content .navbar .navbar-nav .nav-link {
    margin-left: 25px;
    padding: 12px 0;
    color: var(--dark);
    outline: none;
}

.content .navbar .navbar-nav .nav-link:hover,
.content .navbar .navbar-nav .nav-link.active {
    color: var(--primary);
}

.content .navbar .sidebar-toggler,
.content .navbar .navbar-nav .nav-link i {
    width: 40px;
    height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #FFFFFF;
    border-radius: 40px;
}

.content .navbar .dropdown-toggle::after {
    margin-left: 6px;
    vertical-align: middle;
    border: none;
    content: "\f107";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    transition: .5s;
}

.content .navbar .dropdown-toggle[aria-expanded=true]::after {
    transform: rotate(-180deg);
}

@media (max-width: 575.98px) {
    .content .navbar .navbar-nav .nav-link {
        margin-left: 15px;
    }
}


/*** Date Picker ***/
.bootstrap-datetimepicker-widget.bottom {
    top: auto !important;
}

.bootstrap-datetimepicker-widget .table * {
    border-bottom-width: 0px;
}

.bootstrap-datetimepicker-widget .table th {
    font-weight: 500;
}

.bootstrap-datetimepicker-widget.dropdown-menu {
    padding: 10px;
    border-radius: 2px;
}

.bootstrap-datetimepicker-widget table td.active,
.bootstrap-datetimepicker-widget table td.active:hover {
    background: var(--primary);
}

.bootstrap-datetimepicker-widget table td.today::before {
    border-bottom-color: var(--primary);
}


/*** Testimonial ***/
.progress .progress-bar {
    width: 0px;
    transition: 2s;
}


/*** Testimonial ***/
.testimonial-carousel .owl-dots {
    margin-top: 24px;
    display: flex;
    align-items: flex-end;
    justify-content: center;
}

.testimonial-carousel .owl-dot {
    position: relative;
    display: inline-block;
    margin: 0 5px;
    width: 15px;
    height: 15px;
    border: 5px solid var(--primary);
    border-radius: 15px;
    transition: .5s;
}

.testimonial-carousel .owl-dot.active {
    background: var(--dark);
    border-color: var(--primary);
}
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-dark"><i class="fa fa-hashtag me-2"></i>DASHBOARD</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" " src="{{URL('/images/Admin/default.png')}}" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{session("firstname"); }}</h6>
                        <span><i>{{session('role')}}</i></span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <?php if(session('role') =="admin"){ ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-user me-2"></i>Admin</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{url('add-admin')}}" class="dropdown-item">Add Admin</a>
                            <a href="{{url('all-admin')}}" class="dropdown-item">All Admin</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-user-secret me-2"></i>Suspects</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{url('add-suspect')}}" class="dropdown-item">Add Suspect</a>
                            <a href="{{url('all-suspect')}}" class="dropdown-item"> All Suspects</a>
                        </div>
                    </div>

                    <?php } ?>
                    <?php if(session('role') =="security_staff"){ ?>
                        <div class="nav-item dropdown">
                            <a href="{{url('all-suspect')}}" class="nav-link"><i class="fa fa-user-secret me-2"></i>Suspects</a>
                        </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-plane me-2"></i>Airport</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{url('add-airport')}}" class="dropdown-item">Add Airport</a>
                            <a href="{{url('all-airport')}}" class="dropdown-item"> All Airport</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-desktop me-2"></i>Device</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{url('add-device')}}" class="dropdown-item">Add Device</a>
                            <a href="{{url('all-device')}}" class="dropdown-item"> All Device</a>
                        </div>
                    </div>

                    <?php } ?>
                    <div class="nav-item dropdown">
                        <a href="{{url('notification')}}" class="nav-link"><i class="fa fa-bell me-2"></i>Notification</a>
                    </div>
                    <a href="{{url('logout')}}" class="nav-item nav-link"><i class="fa fa-arrow-left"></i>Logout</a>

                    </div>
                </div>
            </nav>
        </div>


