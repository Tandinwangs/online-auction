<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - BNBL Auction</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/admin/img/icon.png') }}" rel="icon">
  <link href="{{ asset('assets/admin/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/admin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/admin/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/admin/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/admin/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/admin/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/admin/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    .toast-success {
    background-color: #252D60;
    color: #fff !important;
}

.toast-info {
    background-color: #17a2b8 !important;
    color: #fff !important;
}

.toast-warning {
    background-color: #ffc107 !important;
    color: #000 !important;
}

.toast-error {
    background-color: #f40000 !important;
    color: #fff !important;
}

  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/admin/img/logo.png" alt="">
        <span class="d-none d-lg-block">Auction</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

   <!-- <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div> End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <!-- <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a> -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->


        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/admin/img/profile.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name}}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ Auth::user()->name}}</h6>
              <span>Admin</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('dashboard') ? '': 'collapsed'}} " href="{{ route ('dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('users.index')|| Request::routeIs('adminusers.show') ? '': 'collapsed'}} """ data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li class="nav-item">
          <a class="nav-link {{ Request::routeIs('users.index') ? '': 'collapsed'}} "" href="{{ route ('users.index') }}">
            <i class="bi bi-person"></i>
            <span>Users</span>
          </a>
        </li>

          <li>
            <a class="nav-link {{ Request::routeIs('adminusers.show') ? '': 'collapsed'}} "" href="{{ route ('adminusers.show') }}">
              <i class="bi bi-person"></i>
              <span>Admin-Users</span>
            </a>
          </li>
        
        </ul>
      </li>

     

      <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('category.index') ? '': 'collapsed'}} "" href="{{ route ('category.index') }}">
          <i class="bi bi-card-list"></i>
          <span>Category</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('refdate.index') ? '': 'collapsed'}} "" href="{{ route ('refdate.index') }}">
          <i class="bi bi-calendar"></i>
          <span>Ref-Date</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('item.index') ? '': 'collapsed'}} "" href="{{ route ('item.index') }}">
          <i class="bi bi-cart-check"></i>
          <span>Items</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('bid.index') ? '': 'collapsed'}} "" href="{{ route ('bid.index') }}">
          <i class="bi bi-hammer"></i>
          <span>Bids</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('payment.show')|| Request::routeIs('finalpayment.show') || Request::routeIs('repayment.show') ? '': 'collapsed'}} """ data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-card-list"></i><span>Payments</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
          <a class="nav-link {{ Request::routeIs('payment.show') ? '': 'collapsed'}} "" href="{{ route ('payment.show') }}">
            <i class="bi bi-card-list"></i>
              <span>Payment</span>
            </a>
          </li>

          <li>
            <a class="nav-link {{ Request::routeIs('finalpayment.show') ? '': 'collapsed'}} "" href="{{ route ('finalpayment.show') }}">
              <i class="bi bi-card-list"></i>
              <span>Final-Payment</span>
            </a>
          </li>

          <li>
            <a class="nav-link {{ Request::routeIs('repayment.show') ? '': 'collapsed'}} "" href="{{ route ('repayment.show') }}">
              <i class="bi bi-card-list"></i>
              <span>Re-Payment</span>
            </a>
          </li>
        
        </ul>
      </li>

    </ul>

  </aside><!-- End Sidebar-->