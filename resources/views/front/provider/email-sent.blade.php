@extends('front.layouts.main')
@push('title')
  <title>Email Sent - Gyandeep NGO</title>
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
          <div class="box_form">
            <h5>
              <center>Email Sent</center>
            </h5>
            <p class="mb-3">
              We sent an email to <b>{{ session()->get('forget_password_email') }}</b> with a link to get back into your
              account.
            </p>
            <center><a href="{{ url('provider/forget-password') }}">Ok</a></center>
          </div>
        </div>
        <!-- /login -->
      </div>
    </div>
  </main>
@endsection
