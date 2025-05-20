<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  @stack('title')
  <!-- Favicons-->
  <link rel="shortcut icon" href="{{ url('front') }}/img/favicon.png" type="image/x-icon" />
  <!-- GOOGLE WEB FONT -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet" />
  <!-- added font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- BASE CSS -->
  <link href="{{ url('front/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ url('front/css/style.css') }}" rel="stylesheet" />
  <link href="{{ url('front/css/menu.css') }}" rel="stylesheet" />
  <link href="{{ url('front/css/vendors.css') }}" rel="stylesheet" />
  <link href="{{ url('front/css/icon_fonts/css/all_icons_min.css') }}" rel="stylesheet" />
  <link href="{{ url('front/css/blog.css') }}" rel="stylesheet">

  <script src="{{ url('/') }}/ckeditor/ckeditor.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <style>
    .hide-this {
      display: none;
    }
  </style>
  <style>
    .apply-model-main {
      text-align: center;
      overflow: hidden;
      position: fixed;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      /* z-index: 1050; */
      -webkit-overflow-scrolling: touch;
      outline: 0;
      opacity: 0;
      -webkit-transition: opacity 0.15s linear, z-index 0.15;
      -o-transition: opacity 0.15s linear, z-index 0.15;
      transition: opacity 0.15s linear, z-index 0.15;
      z-index: -1;
      overflow-x: hidden;
      overflow-y: auto;
    }

    .apply-model-open {
      z-index: 99999;
      opacity: 1;
      overflow: hidden;
    }

    .apply-model-inner {
      -webkit-transform: translate(0, -25%);
      -ms-transform: translate(0, -25%);
      transform: translate(0, -25%);
      -webkit-transition: -webkit-transform 0.3s ease-out;
      -o-transition: -o-transform 0.3s ease-out;
      transition: -webkit-transform 0.3s ease-out;
      -o-transition: transform 0.3s ease-out;
      transition: transform 0.3s ease-out;
      transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
      display: inline-block;
      vertical-align: middle;
      width: 85%;
      margin: 30px auto;
      max-width: 97%;
    }

    .apply-model-wrap {
      display: block;
      width: 100%;
      position: relative;
      background-color: #fff;
      border: 1px solid #999;
      border: 1px solid rgba(0, 0, 0, 0.2);
      border-radius: 6px;
      -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
      box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
      background-clip: padding-box;
      outline: 0;
      text-align: left;
      padding: 0px;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      max-height: calc(100vh - 70px);
      overflow-y: auto;
    }

    .apply-model-open .apply-model-inner {
      -webkit-transform: translate(0, 0);
      -ms-transform: translate(0, 0);
      transform: translate(0, 0);
      position: relative;
      z-index: 999;
    }

    .apply-model-open .apply-bg-overlay {
      background: rgba(0, 0, 0, 0.6);
      z-index: 99;
    }

    .apply-bg-overlay {
      background: rgba(0, 0, 0, 0);
      height: 100vh;
      width: 100%;
      position: fixed;
      left: 0;
      top: 0;
      right: 0;
      bottom: 0;
      z-index: 0;
      -webkit-transition: background 0.15s linear;
      -o-transition: background 0.15s linear;
      transition: background 0.15s linear;
    }

    .apply-close-btn {
      position: absolute;
      right: 15px;
      top: 6px;
      cursor: pointer;
      z-index: 99;
      font-size: 30px;
      color: #fff;
    }

    .apply-model-main:before {
      content: "";
      display: inline-block;
      height: auto;
      vertical-align: middle;
      margin-right: -0px;
      height: 100%;
    }

    label {
      font-size: 14px;
    }

    .star-red {
      color: #be1f2c
    }

    @media (max-width: 767px) {
      .apply-mobile-head {
        text-align: center
      }

      .apply-mobile-head img {
        margin-bottom: 20px;
      }
    }
  </style>
  <style>
    .event-strip .name {
      font-size: 15px;
      color: #be1f2c;
      font-weight: 500;
      margin-left: 12px
    }

    .event-strip span {
      font-size: 14px;
      font-weight: 400;
      color: #555
    }

    .event-thumb {
      width: 60px;
      height: 60px;
      border: 4px solid #f8f8f8;
      border-radius: 50% !important;
      float: left
    }

    .event-social {
      float: right;
      display: flex
    }

    .event-social .share {
      text-align: center;
      margin-right: 10px;
      line-height: 16px;
    }

    .event-social .share span {
      font-size: 20px;
      color: #be1f2c;
      font-weight: 600;
    }

    .event-social .share b {
      font-size: 13px;
      color: #000;
    }

    .event-social a {
      font-size: 16px;
      color: #fff;
      width: 36px;
      height: 36px;
      line-height: 39px;
      text-align: center;
      border-radius: 5px;
      margin-right: 5px
    }

    .event-social .fb {
      background: #3a5795;
    }

    .event-social .fb:hover {
      background: #314781;
    }

    .event-social .twit {
      background: #4FB8DD;
    }

    .event-social .twit:hover {
      background: #4396dc;
    }

    .event-social .linkd {
      background: #0074b2;
    }

    .event-social .linkd:hover {
      background: #0069a1;
    }

    .event-social .yt {
      background: #ff0000;
    }

    .event-social .yt:hover {
      background: #e60202;
    }

    .event-social .insta {
      background: #a43a94;
      margin-right: 0px
    }

    .event-social .insta:hover {
      background: #f45047;
    }

    .custom-model-main {
      text-align: center;
      overflow: hidden;
      position: fixed;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      /* z-index: 1050; */
      -webkit-overflow-scrolling: touch;
      outline: 0;
      opacity: 0;
      -webkit-transition: opacity 0.15s linear, z-index 0.15;
      -o-transition: opacity 0.15s linear, z-index 0.15;
      transition: opacity 0.15s linear, z-index 0.15;
      z-index: -1;
      overflow-x: hidden;
      overflow-y: auto;
    }

    .model-open {
      z-index: 99999;
      opacity: 1;
      overflow: hidden;
    }

    .custom-model-inner {
      -webkit-transform: translate(0, -25%);
      -ms-transform: translate(0, -25%);
      transform: translate(0, -25%);
      -webkit-transition: -webkit-transform 0.3s ease-out;
      -o-transition: -o-transform 0.3s ease-out;
      transition: -webkit-transform 0.3s ease-out;
      -o-transition: transform 0.3s ease-out;
      transition: transform 0.3s ease-out;
      transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
      display: inline-block;
      vertical-align: middle;
      width: 600px;
      margin: 30px auto;
      max-width: 97%;
    }

    .custom-model-wrap {
      display: block;
      width: 100%;
      position: relative;
      background-color: #fff;
      border: 1px solid #999;
      border: 1px solid rgba(0, 0, 0, 0.2);
      border-radius: 6px;
      -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
      box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
      background-clip: padding-box;
      outline: 0;
      text-align: left;
      padding: 15px 15px 10px 15px;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      max-height: calc(100vh - 70px);
      overflow-y: auto;
    }

    .model-open .custom-model-inner {
      -webkit-transform: translate(0, 0);
      -ms-transform: translate(0, 0);
      transform: translate(0, 0);
      position: relative;
      z-index: 999;
    }

    .model-open .bg-overlay {
      background: rgba(0, 0, 0, 0.6);
      z-index: 99;
    }

    .bg-overlay {
      background: rgba(0, 0, 0, 0);
      height: 100vh;
      width: 100%;
      position: fixed;
      left: 0;
      top: 0;
      right: 0;
      bottom: 0;
      z-index: 0;
      -webkit-transition: background 0.15s linear;
      -o-transition: background 0.15s linear;
      transition: background 0.15s linear;
    }

    .close-btn {
      position: absolute;
      right: 0;
      top: -35px;
      cursor: pointer;
      z-index: 99;
      font-size: 30px;
      color: #fff;
    }

    .custom-model-main:before {
      content: "";
      display: inline-block;
      height: auto;
      vertical-align: middle;
      margin-right: -0px;
      height: 100%;
    }
  </style>
</head>

<body>
  <div id="page">
    <header class="header_sticky">

      <!-- /btn_mobile-->
      <div class="container-fluid px-sm-5">
        <div class="d-flex justify-content-between align-items-center">
          <div class="">
            <div id="logo_home" class="img-logos">
              <a href="{{ url('/') }}" title="Logo">
                <div class="img-divs">
                  <img src="https://gyandeep.ngo/front/assets/img/plant.png" />
                </div>
              </a>
            </div>
          </div>
          <div class="">
            
            <!-- sidebar-menu start -->
            <nav id="menu" class="main-menu">
<ul id="top_access" class="d-flex align-items-center profiles-users ">
              @if (session()->has('student_id'))
                <li class="d-lg-block d-md-block d-xl-block">
                  <a href="{{ url('student-logout') }}" class="btn btn-primary"
                    style="color: #fff !important"> <i class="fa fa-sign-out mr-2" aria-hidden="true"></i>
 Logout</a>
                </li>
                <li><a href="{{ url('profile') }}" title="Profile" class="btn btn-outline-dark" ><i class="fa fa-user-o main-usrs mr-2" aria-hidden="true"></i>
 Profile</a></li>
              @else
                <li>
                  <a class="btn btn-primary main-login" href="{{ url('signup') }}" title="Sign Up"><i
                      class="pe-7s-add-user"></i>Apply Now</a>
                </li>
                <li><a class="btn btn-outline-dark outline-login " href="{{ url('login') }}" title="Login"><i
                      class="pe-7s-user"></i> Login</a></li>
              @endif
            </ul>

              <ul>
                {{-- <li>
                  <span><a href="{{ url('scholarships') }}">All Scholarships</a></span>
                </li> --}}
                {{-- <li>
                  <span><a href="{{ url('providers') }}">Scholarship Providers</a></span>
                </li> --}}
                {{-- <li>
                  <span><a href="#0">More</a></span>
                  <ul>
                    <li><a href="{{ url('articles') }}">Articles</a></li>
                    <li><a href="{{ url('events') }}">Events</a></li>
                    <li><a href="{{ url('blogs') }}">Blog</a></li>
                    <li><a href="{{ url('testimonials') }}">Testimonials</a></li>
                  </ul>
                </li> --}}
              </ul>
            </nav>

          <!-- hamburder icon  outside   -->
            <a href="#menu" class="btn_mobile">
              <div class="hamburger hamburger--spin" id="hamburger">
                <div class="hamburger-box">
                  <div class="hamburger-inner"></div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </header>
