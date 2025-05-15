@php
  use App\Models\Country;
  use App\Models\Level;
  use App\Models\CourseCategory;
@endphp
@extends('front.layouts.main')
@push('title')
  <title>Signup - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>
    <div id="hero_register" class="main-signups">
      <div class="container ">
       <div class="full-signup-details">
         <div class="row align-items-center">
          <div class="col-12 col-sm-6 col-lg-6 mb-3">
          <div class="signup-detials">
            
            <h3>925,000+ signed up to get the best of Study Abroad</h3>
            <p class="lead">Te pri adhuc simul. No eros errem mea. Diam mandamus has ad. Invenire senserit ad
              has, has ei quis iudico, ad mei nonumes periculis.</p>
            <div class="box_feat_2">
              <i class="icon_globe"></i>
              <h3>5,500+ Scholarships won globally</h3>
              <p>Get access to 50,000+ International Scholarships worth over $1 Billion.</p>
            </div>
            <div class="box_feat_2">
              <i class="pe-7s-date"></i>
              <h3>2200+ Education loans sanctioned worth over ₹ 770+ Cr</h3>
              <p>Secure the best abroad education loan in India from the top 10+ public/private banks.</p>
            </div>
            <div class="box_feat_2">
              <i class="pe-7s-map-2"></i>
              <h3>Opportunities covering 2500+ Universities worldwide</h3>
              <p>Explore Listings, courses, discussions and more!.</p>
            </div>
            <div class="box_feat_2">
              <i class="pe-7s-phone"></i>
              <h3>The most trusted platform</h3>
              <p>As the initiative is supported by the Government.</p>
            </div>
          </div>
          </div>

          <div class="col-12 col-sm-6 col-lg-6 mb-3">
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
              <form method="post" action="{{ url('student-signup') }}" enctype="multipart/form-data">
                @csrf
                <a href="#0" class="social_bt facebook">Login with Facebook</a>
                <div class="divider"><span>Or</span></div>
                <h5 class="text-center mb-3">Signup with email</h5>

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
                        @php
                          $country = Country::orderBy('phonecode', 'ASC')->where('phonecode', '!=', 0)->get();
                        @endphp
                        @foreach ($country as $country)
                          <option value="{{ $country->phonecode }}"
                            {{ (old('c_code') && old('c_code') == $country->phonecode) || $country->phonecode == '91' ? 'Selected' : '' }}>
                            {{ $country->name }}
                            (+{{ $country->phonecode }})
                          </option>
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
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <select name="current_qualification_level" id="current_qualification_level" class="form-control"
                        required>
                        <option value="">Current Qualification</option>
                        @php
                          $lvl = Level::all();
                        @endphp
                        @foreach ($lvl as $lvl)
                          <option value="{{ $lvl->id }}"
                            {{ old('current_qualification_level') == $lvl->id ? 'Selected' : '' }}>{{ $lvl->name }}
                          </option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('current_qualification_level')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <select name="intrested_course_category" id="intrested_course_category" class="form-control"
                        required>
                        <option value="">Intrested Course</option>
                        @php
                          $crs = CourseCategory::all();
                        @endphp
                        @foreach ($crs as $crs)
                          <option value="{{ $crs->id }}"
                            {{ old('intrested_course_category') == $crs->id ? 'Selected' : '' }}>
                            {{ $crs->category }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('intrested_course_category')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
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
                <a class="forgot-show mb-3" href="{{ url('forget-password') }}">Forgot password?</a>
                <p class="text-center add_top_30">
                  <input type="submit" class="login-input medium w-100" value="Submit">
                </p>
                <div class="text-center">
                  <h6 class="account-fields" >Are you a already member?<a class="ms-2" href="{{ url('login') }}">Login</a></h6>
                  
                </div>
              </form>
            </div>
          </div>
        </div>
       </div>
      </div>
    </div>
  </main>
@endsection
