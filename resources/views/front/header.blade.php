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

  <!-- BASE CSS -->

  <link href="{{ url('front/css/bootstrap.min.css') }}" rel="stylesheet" />

  <link href="{{ url('front/css/style.css') }}" rel="stylesheet" />

  <link href="{{ url('front/css/menu.css') }}" rel="stylesheet" />

  <link href="{{ url('front/css/vendors.css') }}" rel="stylesheet" />

  <link href="{{ url('front/css/icon_fonts/css/all_icons_min.css') }}" rel="stylesheet" />

  <link href="{{ url('front/css/blog.css') }}" rel="stylesheet">

  <style>
    .hide-this {
      display: none;
    }
  </style>

</head>

<body>

  {{-- <div id="preloader" class="Fixed">

    <div data-loader="circle-side"></div>

  </div> --}}

  <!-- /Preload-->

  <div id="page">

    <header class="header_sticky">

      <a href="#menu" class="btn_mobile">

        <div class="hamburger hamburger--spin" id="hamburger">

          <div class="hamburger-box">

            <div class="hamburger-inner"></div>

          </div>

        </div>

      </a>

      <!-- /btn_mobile-->

      <div class="container-fluid">

        <div class="row">

          <div class="col-lg-2 col-6">

            <div id="logo_home">

              <a href="{{ url('/') }}" title="Logo"><img src="{{ url('front/img/logo.png') }}" /></a>

            </div>

          </div>

          <div class="col-lg-10 col-6">

            <ul id="top_access" class="d-flex align-items-center">

              @if (session()->has('student_id'))
                <li class="d-lg-block d-md-block d-xl-block">

                  <a href="{{ url('student-logout') }}" class="btn_1 text-center pt-2"
                    style="color: #fff !important">Logout</a>

                </li>

                <li><a href="{{ url('profile') }}" title="Profile"><i class="pe-7s-user"></i></a></li>
              @else
                <li class="d-none"><a href="{{ url('login') }}" class="btn_1 text-center pt-2"
                    style="color: #fff !important">Login</a></li>
                <li class="d-block d-sm-block d-lg-none d-md-none d-xl-none"><a href="{{ url('login') }}"><i
                      class="pe-7s-user"></i></a></li>
                <li><a href="{{ url('signup') }}" title="Sign Up"><i class="pe-7s-add-user"></i></a></li>
              @endif

            </ul>

            <nav id="menu" class="main-menu">

              <ul>

                <li>

                  <span><a href="javascript:void()">About</a></span>

                  <ul>

                    <li>

                      <a href="{{ url('about-mudra-education') }}">About Gyandeep NGO</a>

                    </li>

                    <li>

                      <a href="{{ url('about-scholarship') }}">About Scholarship</a>

                    </li>

                  </ul>

                </li>

                <li>

                  <span><a href="{{ url('scholarships') }}">All Scholarships</a></span>

                </li>

                <li>

                  <span><a href="{{ url('providers') }}">Our Scholarship Providers</a></span>

                </li>

                <li>

                  <span><a href="{{ url('services') }}">Services</a></span>

                </li>

                <li>

                  <span><a href="{{ url('currency-converter') }}">Currency Converter</a></span>

                </li>

                <li>

                  <span><a href="{{ url('contact-us') }}">Contact Us</a></span>

                </li>

                <li>

                  <span><a href="#0">More</a></span>

                  <ul>

                    <li><a href="{{ url('articles') }}">Articles</a></li>

                    <li><a href="{{ url('events') }}">Events</a></li>

                    <li><a href="{{ url('blogs') }}">Blog</a></li>

                    <li><a href="{{ url('testimonials') }}">Testimonials</a></li>

                  </ul>

                </li>

              </ul>

            </nav>

          </div>

        </div>

      </div>

    </header>
