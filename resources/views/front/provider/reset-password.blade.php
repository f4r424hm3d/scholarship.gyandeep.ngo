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
          <h1>Reset password</h1>
          <div class="box_form">
            <form method="post" action="{{ url('provider/reset-password') }}" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" value="{{ $_GET['uid'] }}">
              <input type="hidden" name="remember_token" value="{{ $_GET['token'] }}">
              <div class="form-group">
                <label>Enter New Password</label>
                <input name="new_password" type="password" class="form-control" placeholder="Enter New Password" required>
                <span class="text-danger">
                  @error('new_password')
                    {{ $message }}
                  @enderror
                </span>
              </div>
              <div class="form-group">
                <label>Confirm New Password</label>
                <input name="confirm_new_password" type="password" class="form-control" placeholder="Confirm New Password"
                  required>
                <span class="text-danger">
                  @error('confirm_new_password')
                    {{ $message }}
                  @enderror
                </span>
              </div>
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
