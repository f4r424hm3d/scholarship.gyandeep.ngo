@php
  use App\Models\Country;

@endphp
@extends('front.layouts.main')
@push('title')
  <title>Signup - Gyandeep NGO</title>
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
              <form method="post" action="{{ url('provider/signup') }}" enctype="multipart/form-data">
                @csrf
                <h5 class="text-center mb-3">Signup</h5>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input name="name" type="text" class="form-control" placeholder="Enter full name"
                        value="{{ old('name') }}" required>
                      <span class="text-danger">
                        @error('name')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <input name="email" type="email" class="form-control" placeholder="Enter Email Address"
                        value="{{ old('email') }}" required>
                      <span class="text-danger">
                        @error('email')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <select name="c_code" class="form-control" placeholder="Country" required>
                        <option value="">Country</option>
                        @foreach ($country as $country)
                          <option value="{{ $country->phonecode }}"
                            {{ old('c_code') == $country->phonecode || $country->phonecode == '91' ? 'Selected' : '' }}>
                            {{ $country->name }}(+{{ $country->phonecode }})</option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('c_code')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-lg-8">
                    <div class="form-group">
                      <input name="mobile" type="number" class="form-control" placeholder="Phone No."
                        value="{{ old('mobile') }}" required>
                      <span class="text-danger">
                        @error('mobile')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <select name="provider_type_id" class="form-control" placeholder="Select Provider Type" required>
                      <option value="">Select Provider Type</option>
                      @foreach ($pt as $pt)
                        <option value="{{ $pt->id }}" {{ old('provider_type_id') == $pt->id ? 'Selected' : '' }}>
                          {{ $pt->provider_type }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger">
                      @error('provider_type_id')
                        {{ $message }}
                      @enderror
                    </span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="password" class="form-control" placeholder="Enter password" id="password"
                        name="password">
                      <span class="text-danger">
                        @error('password')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="password" class="form-control" placeholder="Confirm password" id="password2"
                        name="password2">
                      <span class="text-danger">
                        @error('password2')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                </div>
                <p class="text-center add_top_30">
                  <input type="submit" class="btn_1 medium" value="Submit">
                </p>
                <div class="text-center">
                  <a href="{{ url('provider/forget-password') }}"><small>Forgot password?</small></a>
                  <a href="{{ url('provider/login') }}" class="float-end"><small>Login</small></a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
