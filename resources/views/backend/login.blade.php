<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="https://joblly-admin-template-dashboard.multipurposethemes.com/bs4/images/favicon.ico">
  <title>Gyandeep NGO Admin Dashboard - Log in </title>
  <!-- Vendors Style-->
  <link rel="stylesheet" href="{{ url('backend/main/css/vendors_css.css') }}">
  <!-- Style-->
  <link rel="stylesheet" href="{{ url('backend/main/css/horizontal-menu.css') }}">
  <link rel="stylesheet" href="{{ url('backend/main/css/style.css') }}">
  <link rel="stylesheet" href="{{ url('backend/main/css/skin_color.css') }}">
</head>

<body class="hold-transition theme-primary bg-img"
  style="background-image: url({{ url('assets/admin/') }}/images/auth-bg/bg-1.jpg)">
  <div class="container h-p100">
    <div class="row align-items-center justify-content-md-center h-p100">
      <div class="col-12">
        <div class="row justify-content-center no-gutters">
          <div class="col-lg-5 col-md-5 col-12">
            @if (session()->has('smsg'))
              <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session()->get('smsg') }}
              </div>
            @endif
            @if (session()->has('emsg'))
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session()->get('emsg') }}
              </div>
            @endif
            <div class="bg-white rounded30 shadow-lg">
              <div class="content-top-agile p-20 pb-0">
                <h2 class="text-primary">Let's Get Started</h2>
                <p class="mb-0">Sign in to continue.</p>
              </div>
              <div class="p-40">
                <form action="{{ url('admin/login') }}" method="post">
                  @csrf
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                      </div>
                      <input type="text" name="username" class="form-control pl-15 bg-transparent"
                        placeholder="Username" value="{{ old('username') }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
                      </div>
                      <input type="password" name="password" class="form-control pl-15 bg-transparent"
                        placeholder="Password">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="checkbox">
                        <input type="checkbox" id="basic_checkbox_1">
                        <label for="basic_checkbox_1">Remember Me</label>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                      <div class="fog-pwd text-right">
                        <a href="{{ url('admin/forget-password') }}" class="hover-warning"><i
                            class="ion ion-locked"></i> Forgot
                          pwd?</a><br>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-12 text-center">
                      <button type="submit" class="btn btn-danger mt-10">SIGN IN</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Vendor JS -->
  <script src="{{ url('backend/main/') }}/js/vendors.min.js"></script>
  <script src="{{ url('backend/main/') }}/js/pages/chat-popup.js"></script>
  <script src="{{ url('backend/assets/') }}/icons/feather-icons/feather.min.js"></script>

  <script src="{{ url('backend/assets/') }}/vendor_components/fullcalendar/fullcalendar.js"></script>
  <script src="{{ url('backend/assets/') }}/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js"></script>
  <script src="{{ url('backend/assets/') }}/vendor_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
  <script src="{{ url('backend/assets/') }}/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>

  <script src="{{ url('backend/assets/') }}/vendor_components/select2/dist/js/select2.full.js"></script>
  <script src="{{ url('backend/assets/') }}/vendor_plugins/input-mask/jquery.inputmask.js"></script>
  <script src="{{ url('backend/assets/') }}/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="{{ url('backend/assets/') }}/vendor_plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <script src="{{ url('backend/assets/') }}/vendor_components/moment/min/moment.min.js"></script>
  <script src="{{ url('backend/assets/') }}/vendor_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="{{ url('backend/assets/') }}/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
  </script>
  <script
    src="{{ url('backend/assets/') }}/vendor_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js">
  </script>
  <script src="{{ url('backend/assets/') }}/vendor_plugins/timepicker/bootstrap-timepicker.min.js"></script>
  <script src="{{ url('backend/assets/') }}/vendor_plugins/iCheck/icheck.min.js"></script>
  <!-- Joblly App -->
  <script src="{{ url('backend/main/') }}/js/jquery.smartmenus.js"></script>
  <script src="{{ url('backend/main/') }}/js/menus.js"></script>
  <script src="{{ url('backend/main/') }}/js/pages/toastr.js"></script>
  <script src="{{ url('backend/main/') }}/js/pages/notification.js"></script>
  <script src="{{ url('backend/main/') }}/js/pages/advanced-form-element.js"></script>
</body>

</html>
