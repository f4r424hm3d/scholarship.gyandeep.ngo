@extends('front.layouts.main')
@push('title')
  <title>Login - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>
    <div class="bg_color_2">

      <div class="container margin_60_35">
        <div id="login">
          <h1>Please Log In to continue</h1>
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
          <div class="box_form">
            <form action="{{ url('provider/login') }}" method="post">
              @csrf
              {{-- <a href="#0" class="social_bt facebook">Login with Facebook</a>
              <a href="#0" class="social_bt google">Login with Google</a>
              <a href="#0" class="social_bt linkedin">Login with Linkedin</a>
              <div class="divider"><span>Or</span></div> --}}
              <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Your email address"
                  value="{{ old('email') }}">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Your password" id="password" name="password">
              </div>
              <a href="{{ url('provider/forget-password') }}"><small>Forgot password?</small></a>
              <a href="{{ url('provider/signup') }}" class="float-end"><small>Sign Up Here</small></a>
              <div class="form-group text-center add_top_20 mb-0">
                <input class="btn_1 medium" type="submit" value="Login">
              </div>
            </form>
          </div>
          <!--p class="text-center link_bright">Are you a new user? <a href="signup.html"><strong>SIGN UP HERE</strong></a></p-->
        </div>
        <!-- /login -->
      </div>
    </div>
  </main>
@endsection
