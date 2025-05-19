@extends('front.layouts.main')
@push('title')
  <title>Login - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>
    <section class="main-logins">

      <div class="container ">
       <div class="row">
        <div class="col-12 col-sm-12 col-md-8 col-lg-6 mx-auto">
           <div id="login" class="login-forms">
          <!-- <h4 class="" >Please Log In to continue</h4> -->
           <div class="main-background" ></div>
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
            <h4 class="user-login" >User Login</h4>
            <form action="{{ url('student-login') }}" method="post">
              @csrf
              {{-- <a href="#0" class="social_bt facebook">Login with Facebook</a>
              <a href="#0" class="social_bt google">Login with Google</a>
              <a href="#0" class="social_bt linkedin">Login with Linkedin</a>
              <div class="divider"><span>Or</span></div> --}}
              <input type="hidden" name="back_to" value="{{ $_GET['url'] ?? 'profile' }}">
              <div class="form-group">
                <div class="position-relative logiin-forma">
                  <i class="fa fa-envelope mails-icons" aria-hidden="true"></i>

                <input type="email" name="email" class="form-control" placeholder="Your email address"
                  value="{{ old('email') }}">
                </div>
              </div>
              <div class="form-group">
                <div class="position-relative logiin-forma">
                  <i class="fa fa-lock mails-icons" aria-hidden="true"></i>

                  <input type="password" class="form-control" placeholder="Your password" id="password" name="password">
                </div>
              </div>
              <a class="forgot-show" href="{{ url('forget-password') }}">Forgot password?</a>
             
              <div class="form-group text-center mt-3">
                <input class="login-input medium w-100" type="submit" value="Login">
              </div>
            <h6 class="account-fields"> Don't have an account?  <a href="{{ url('signup') }}"> Sign Up Here</a></h6>
            </form>
          </div>
          <!--p class="text-center link_bright">Are you a new user? <a href="signup.html"><strong>SIGN UP HERE</strong></a></p-->
        </div>
        </div>
       </div>
        <!-- /login -->
      </div>
</section>
  </main>
@endsection
