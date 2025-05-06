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
      <div class="container margin_60_35">
        <div id="login">
          <h1>Forgot password</h1>
          <div class="box_form">
            <p class="mb-3">Don't have an account? Create your account. It's take less then a minutes</p>
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
              <a href="{{ url('login') }}"><small>Already member ? Login </small></a>
              <a href="{{ url('signup') }}" class="float-end"><small>Create a new account</small></a>
              <div class="form-group text-center add_top_20 mb-0">
                <input class="btn_1 medium" type="submit" value="Submit">
              </div>
            </form>
          </div>
        </div>
        <!-- /login -->
      </div>
    </div>
  </main>
@endsection
