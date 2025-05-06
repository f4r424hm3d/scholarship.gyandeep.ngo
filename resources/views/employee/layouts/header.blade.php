@php
$seg2 = Request::segment(2);
$seg3 = Request::segment(3);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="https://joblly-employee-template-dashboard.multipurposethemes.com/bs4/images/favicon.ico">
  @stack('title')
  <!-- Vendors Style-->
  <link rel="stylesheet" href="{{ url('backend/main/css/vendors_css.css') }}">
  <!-- Style-->
  <link rel="stylesheet" href="{{ url('backend/main/css/horizontal-menu.css') }}">
  <link rel="stylesheet" href="{{ url('backend/main/css/style.css') }}">
  <link rel="stylesheet" href="{{ url('backend/main/css/skin_color.css') }}">
  <script src="{{ url('/') }}/ckeditor/ckeditor.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <style>
    .hide-this {
      display: none
    }

    .float-right {
      float: right;
    }

    .chr {
      margin-top: 3px;
      margin-bottom: 3px
    }

    .just {
      text-align: justify;
      text-justify: inter-word;
    }
  </style>
</head>

<body class="layout-top-nav light-skin theme-primary">
  <div class="wrapper">
    <header class="main-header">
      <div class="inside-header">
        <div class="d-flex align-items-center logo-box justify-content-start">
          <!-- Logo -->
          <a href="{{ url('/employee/') }}" class="logo">
            <!-- logo-->
            <div class="logo-lg">
              <span class="light-logo"><img src="{{ url('backend/') }}/logo/cover.jpg" alt="logo"></span>
              <span class="dark-logo"><img src="{{ url('backend/') }}/logo/cover.jpg" alt="logo"></span>
            </div>
          </a>
        </div>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top">
          <div class="navbar-custom-menu r-side">
            <ul class="nav navbar-nav">
              <li class="btn-group nav-item d-lg-flex d-none align-items-center">
                <p class="mb-0 text-fade pr-10 pt-5"><?php echo date('D'); ?> , <?php echo date('d'); ?>th <?php echo date('M'); ?>
                  <?php echo date('Y'); ?></p>
              </li>
              <!-- Notifications -->
              <li class="dropdown notifications-menu">
                <a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown"
                  title="Notifications">
                  <i data-feather="bell"></i>
                </a>
                <ul class="dropdown-menu animated bounceIn">
                  <li class="header">
                    <div class="p-20">
                      <div class="flexbox">
                        <div>
                          <h4 class="mb-0 mt-0">Notifications</h4>
                        </div>
                        <div>
                          <a href="#" class="text-danger">Clear All</a>
                        </div>
                      </div>
                    </div>
                  </li>

                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu sm-scrol">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-info"></i> Curabitur id eros quis nunc suscipit blandit.
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-warning text-warning"></i> Duis malesuada justo eu sapien elementum, in semper
                          diam posuere.
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-danger"></i> Donec at nisi sit amet tortor commodo porttitor
                          pretium a erat.
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-shopping-cart text-success"></i> In gravida mauris et nisi
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-user text-danger"></i> Praesent eu lacus in libero dictum fermentum.
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-user text-primary"></i> Nunc fringilla lorem
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-user text-success"></i> Nullam euismod dolor ut quam interdum, at scelerisque
                          ipsum imperdiet.
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all</a>
                  </li>
                </ul>
              </li>
              <!-- User Account-->
              <li class="dropdown user user-menu">
                <a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown"
                  title="User">
                  <i data-feather="user"></i>
                </a>
                <ul class="dropdown-menu animated flipInX">
                  <li class="user-body">
                    <a class="dropdown-item" href="{{ url('employee/profile') }}"><i
                        class="ti-user text-muted mr-2"></i>
                      Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('employee/logout') }}"><i
                        class="ti-lock text-muted mr-2"></i>
                      Logout</a>
                  </li>
                </ul>
              </li>
              <li class="btn-group nav-item d-lg-flex d-none align-items-center">
                <p class="mb-0 text-fade pr-10 pt-5">
                  @php
                    $un = explode(' ', session()->get('userLoggedIn')['user_name']);
                    echo 'Welcome , ' . $un[0];
                  @endphp
                </p>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <nav class="main-nav" role="navigation">
      <!-- Mobile menu toggle button (hamburger/x icon) -->
      <input id="main-menu-state" type="checkbox" />
      <label class="main-menu-btn" for="main-menu-state">
        <span class="main-menu-btn-icon"></span> Toggle main menu visibility
      </label>
      <!-- Sample menu definition -->
      <ul id="main-menu" class="sm sm-blue">
        <li class="{{ $seg2 == '' ? 'current' : '' }}">
          <a href="{{ url('/employee/') }}"><i class="icon-Layout-4-blocks"><span class="path1"></span><span
                class="path2"></span></i>Dashboard</a>
        </li>
        <li class="{{ $seg2 == 'students' ? 'current' : '' }}">
          <a href="#">
            <i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
            Students
            <i class="fa fa-angle-right"></i>
          </a>
          <ul>
            <li class="{{ $seg2 == 'students' && $seg3 != 'trash' ? 'current' : '' }}">
              <a href="{{ url('employee/students/') }}">
                <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Students
              </a>
            </li>
            <li class="{{ $seg2 == 'student-trash' ? 'current' : '' }}">
              <a href="{{ url('employee/student-trash') }}">
                <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Trash
              </a>
            </li>
            <li class="{{ $seg2 == 'applications' ? 'current' : '' }}">
              <a href="{{ url('employee/applications') }}">
                <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Applications
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </nav>
