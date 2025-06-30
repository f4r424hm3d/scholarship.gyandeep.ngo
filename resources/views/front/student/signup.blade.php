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
          <div class="row align-items-center flex-column-reverse flex-lg-row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-3">
              <div class="signup-detials">

                <h3>Apply for MBBS Scholarship in Kyrgyzstan
                  Offered by Gyandeep Welfare & Rehabilitation Society</h3>
                <p class="lead">In collaboration with the <span class="rep">Embassy of Kyrgyzstan in India</span>
                  Study at the prestigious Eurasian International University
                  Recognized by: WHO, WFME, ECFMG, FAIMER, and NMC.</p>

                <div class="box_feat_2">
                  <i class="icon_globe"></i>
                  <h3>Over ₹2.43 Crores of Scholarships.</h3>
                  <p>The Gyandeep MBBS Scholarship Program, in collaboration with the Kyrgyzstan Embassy in India, offers
                    ₹2.43+ Crores worth of tuition fee waivers to 100 deserving students.</p>
                </div>
                <div class="box_feat_2">
                  <i class="pe-7s-date"></i>
                  <h3>Performance-based scholarships via entrance exam.</h3>
                  <p>Transparent & Embassy-verified admission process.</p>
                </div>
                <div class="box_feat_2">
                  <i class="pe-7s-map-2"></i>
                  <h3>Qualified Indian Faculty.</h3>
                  <p>Expert guidance aligned with Indian medical education standards.</p>
                </div>
                <div class="box_feat_2">
                  <i class="pe-7s-phone"></i>
                  <h3>A Trusted & Transparent Platform.</h3>
                  <p> Empowered by Embassy collaboration and supported by regulatory bodies, ensuring a secure and
                    verified admission process.</p>
                </div>
              </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-3">
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
                  <div class="row">
                    <h5 class="text-center mb-3">Apply Now</h5>
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

                    <div class="col-md-6">
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
                    <div class="col-md-6">
                      <div class="form-group">
                        <select name="neet_status" id="neet_status" class="form-control" required>
                          <option value="">Neet Status</option>
                          <option value="Qualified">Qualified</option>
                          <option value="Not Qualified">Not Qualified</option>
                          <option value="Appearing">Appearing</option>
                        </select>
                        <span class="text-danger">
                          @error('neet_status')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>

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

                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <input name="referred_by" type="text" class="form-control"
                          placeholder="Referred By (If Any)" value="{{ old('referred_by') }}">
                        <span class="text-danger">
                          @error('referred_by')
                            {{ $message }}
                          @enderror
                        </span>
                        <small><b>Referred By : Google, Social, Company, Person Name</b></small>
                      </div>
                    </div>
                  </div>

                  <a class="forgot-show mb-3" href="{{ url('forget-password') }}">Forgot password?</a>
                  <p class="text-center add_top_30">
                    <input type="submit" class="login-input medium w-100" value="Submit">
                  </p>
                  <div class="text-center">
                    <h6 class="account-fields">Are you a already member?<a class="ms-2"
                        href="{{ url('login') }}">Login</a></h6>

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
