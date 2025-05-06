@php
  use App\Models\Country;
@endphp
@extends('front.layouts.main')
@push('title')
  <title>Enter OTP - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>
    <div id="hero_register">
      <div class="container margin_120_95">
        <div class="row">
          <div class="col-lg-3">
          </div>
          <div class="col-lg-6 ml-auto">
            @if (session()->has('smsg'))
              <div class="alert alert-success alert-dismissable">
                {{ session()->get('smsg') }}
              </div>
            @endif
            @if (session()->has('emsg'))
              <div class="alert alert-danger alert-dismissable">
                {{ session()->get('emsg') }}
              </div>
            @endif
            <div class="box_form">
              <form method="post" action="{{ url('submit-email-otp') }}" enctype="multipart/form-data">
                @csrf
                <h5 class="text-center mb-3">OTP will expire in 15 minute</h5>
                <input type="hidden" name="id" value="{{ session()->get('last_id') }}">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input name="otp" type="number" class="form-control" placeholder="Enter otp"
                        value="{{ old('otp') }}" required>
                      <span class="text-danger">
                        @error('otp')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                </div>
                <p class="text-center add_top_30">
                  <input type="submit" class="btn_1 medium" value="Submit">
                </p>
              </form>
            </div>
          </div>
          <div class="col-lg-3">
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
