<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="icon" href="{{ url('testapp/') }}/images/favicon.ico" />

  @stack('title')

  <!-- Vendors Style-->
  <link rel="stylesheet" href="{{ url('testapp/') }}/assets/css/vendors_css.css" />

  <!-- Style-->
  <link rel="stylesheet" href="{{ url('testapp/') }}/assets/css/horizontal-menu.css" />
  <link rel="stylesheet" href="{{ url('testapp/') }}/assets/css/style.css" />
  <link rel="stylesheet" href="{{ url('testapp/') }}/assets/css/skin_color.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="layout-top-nav light-skin theme-primary" onselectstart="return false">
  <div class="wrapper">
    <div id="loader"></div>

    <header class="main-header instruction-header">
      <div class="container-fluid px-sm-5">
        <div class="d-flex align-items-center logo-box justify-content-start">
          <a href="{{ url('testapp/') }}" class="logo">
            <div class="logo-lg">
              <div class="img-divs"><img src="https://gyandeep.ngo/front/assets/img/plant.png"
                  alt="logo" /></div>
          
            </div>
            <!-- <div class="logo-lg">
              <span class="light-logo"><img src="https://gyandeep.ngo/front/assets/img/plant.png"
                  alt="logo" /></span>
              <span class="dark-logo"><img src="https://gyandeep.ngo/front/assets/img/plant.png"
                  alt="logo" /></span>
            </div> -->
          </a>
        </div>

        <nav class="navbar navbar-static-top">
          <div class="app-menu">
            <ul class="header-megamenu nav">
              <li class="btn-group nav-item d-lg-flex align-items-center">
                <p class="mb-0">
                  {{ $exam->getScholarship->name }}
                </p>
              </li>
            </ul>
          </div>

          @if (session()->has('end_time'))
            <div class="time-btn d-lg-inline-flex">
              <i class="ti-timer"></i> <span class="hide-m">Time</span> Left: &nbsp;
              <script language="JavaScript">
                TargetDate = "{{ date('Y-m-d H:i:s', strtotime(session()->get('end_time'))) }}";
                CountActive = true;
                CountStepper = -1;
                LeadingZero = true;
                DisplayFormat = "%%H%% : %%M%% : %%S%%";
                FinishMessage = "Time finished!";
              </script>
              <script language="JavaScript" src="https://rhashemian.github.io/js/countdown.js"></script>
            </div>
          @endif
          <div class="navbar-custom-menu r-side">
            <ul class="nav navbar-nav main-navbs">
              <li class="btn-group nav-item d-lg-inline-flex d-none">
                <a href="{{ url('testapp/') }}/#" data-provide="fullscreen"
                  class="waves-effect waves-light nav-link full-screen m-0 border" title="Full Screen">
                  <i data-feather="maximize"></i>
                </a>
              </li>
              <!-- User Account-->
              <li class="dropdown user user-menu">
                <a href="{{ url('testapp/') }}/#" class="waves-effect m-0 waves-light dropdown-toggle"
                  data-toggle="dropdown" title="User">
                  <i data-feather="user"></i>
                </a>
                <ul class="dropdown-menu animated flipInX">
                  <li class="user-body">
                    <a target="_blank" class="dropdown-item" href="{{ url('profile') }}">
                      <i class="ti-user text-muted mr-2"></i>Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('student-logout') }}"><i class="ti-lock text-muted mr-2"></i>
                      Logout</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
