@php
  use App\Models\Country;
  use App\Models\State;
@endphp
@extends('front.layouts.main')
@push('title')
  <title>Edit Profile - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>
    <div class="container-fluid margin_60_35">
      <div class="row">

        @include('front.student.profile-sidebar')

        <div class="col-xl-10 col-lg-10">
          <div style="clear:both"></div>
          <div class="pb-2">
            <div id="detail-title" style="padding-left:15px"><i class="icon-info-circled"></i> Basic Information</div>
            <div class="box_general_3">
              <form action="{{ url('profile/update') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $student->id }}">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Name</label>
                      <input name="name" type="text" class="form-control" placeholder="Your name"
                        value="{{ $student->name }}" required>
                      <span class="text-danger">
                        @error('name')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Gender</label>
                      <select name="gender" class="form-control" required>
                        <option value="">Select Gender</option>
                        <option value="Male" {{ $student->gender == 'Male' ? 'Selected' : '' }}>Male</option>
                        <option value="Female" {{ $student->gender == 'Female' ? 'Selected' : '' }}>Female</option>
                        <option value="Other" {{ $student->gender == 'Other' ? 'Selected' : '' }}>Other</option>
                      </select>
                      <span class="text-danger">
                        @error('gender')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Date of Birth</label>
                      <input name="dob" type="date" class="form-control" placeholder="Date of Birth"
                        value="{{ $student->dob }}" required>
                      <span class="text-danger">
                        @error('dob')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nationality</label>
                      <select name="nationality" class="form-control" placeholder="Country" required>
                        <option value="">Country</option>
                        @php
                          $country = Country::orderBy('name', 'ASC')->get();
                        @endphp
                        @foreach ($country as $country)
                          <option value="{{ $country->name }}"
                            {{ (old('nationality') && old('nationality') == $country->name) || $country->name == $student->nationality ? 'Selected' : '' }}>
                            {{ $country->name }}
                          </option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('nationality')
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
                            {{ (old('c_code') && old('c_code') == $country->phonecode) || $country->phonecode == '91' || $country->phonecode == $student->c_code ? 'Selected' : '' }}>
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
                        value="{{ $student->mobile }}" required>
                      <span class="text-danger">
                        @error('mobile')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>City</label>
                      <input name="city" value="{{ $student->city }}" type="text" class="form-control"
                        placeholder="Enter City">
                      <span class="text-danger">
                        @error('city')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>State</label>
                      <select name="state" class="form-control" placeholder="State">
                        <option value="">Select State</option>
                        @php
                          $state = State::orderBy('statename', 'ASC')->where('country', 'IND')->get();
                        @endphp
                        @foreach ($state as $state)
                          <option value="{{ $state->statename }}"
                            {{ $state->statename == $student->state ? 'Selected' : '' }}>
                            {{ $state->statename }}
                          </option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('state')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Country</label>
                      <select name="country" class="form-control" placeholder="Country">
                        <option value="">Select Country</option>
                        @php
                          $country = Country::orderBy('name', 'ASC')->get();
                        @endphp
                        @foreach ($country as $country)
                          <option value="{{ $country->name }}"
                            {{ $country->name == $student->country ? 'Selected' : '' }}>
                            {{ $country->name }}
                          </option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('country')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                </div>

                <input type="submit" class="btn_1 medium" value="Save"> &nbsp; &nbsp;
                <a href="#0" class="medium">Cancel</a>

              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </main>
@endsection
