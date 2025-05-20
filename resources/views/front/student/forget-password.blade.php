@extends('front.layouts.main')
@push('title')
  <title>Forget Password - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>
    <div class="bg_color_2">
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
      <section class="forgot-section py-5 mb-5">
        <div class="container px-sm-5">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-8 col-lg-6 mx-auto">
            <div id="login">
         
          <div class="box_form"> 
             <h2>Forgot password</h2>
            <p class="mb-3 have-account ">Don't have an account? <span>Create your account. It's take less then a minutes</span></p>
            <form method="post" action="{{ url('forget-password') }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <input name="email" type="email" class="form-control"
                  placeholder="Enter your registered email address" value="{{ old('email') }}" required>
                <span class="text-danger">
                  @error('email')
                    {{ $message }}
                  @enderror
                </span>
              </div>
             <div class="text-right mt-2">
              
            <p> <a href="{{ url('signup') }}">Create a new account</a></p>
             </div>
              <div class="form-group text-center">
                <input class="w-100 btn btn-primary" type="submit" value="Submit">
                  <div class="text-center mt-2">
                   Already a member ? <a href="{{ url('login') }}">Login</a>
                </div>
                
              </div>
            </form>
          </div>
        </div>
        </div>
      </div>
        <!-- /login -->
      </div>
      </section>
    </div>
  </main>
@endsection
