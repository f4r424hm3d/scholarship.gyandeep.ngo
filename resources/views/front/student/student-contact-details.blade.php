@php
  use App\Models\Country;
  use App\Models\State;
@endphp
@extends('front.layouts.main')
@push('title')
  <title>Contact Details - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>
    <div class="container margin_60_35">
      <div class="main_title">
        <h1>Application Form</h1>
      </div>
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
          <div class="stepwizard-step">
            <a href="javascript:void()" type="button" class="btn btn-primary btn-circle">1</a>
          </div>
          <div class="stepwizard-step">
            <a href="javascript:void()" type="button" class="btn btn-primary btn-circle">2</a>
          </div>
          <div class="stepwizard-step">
            <a href="javascript:void()" type="button" class="btn btn-primary btn-circle">3</a>
          </div>
          <div class="stepwizard-step">
            <a href="javascript:void()" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
          </div>
          <div class="stepwizard-step">
            <a href="javascript:void()" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
          </div>
        </div>
      </div>

      <form action="{{ url('scholarship/contact-details') }}" method="post" role="form">
        @csrf
        <div class="row setup-content" id="step-5">
          <div class="col-xl-12 col-lg-12">
            <div class="pb-2">
              <div id="detail-title" style="padding-left: 15px">
                <i class="icon-location-outline"></i> Contact Details
              </div>
              <div class="box_general_3">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Code <span class="text-danger">*</span></label>
                      <select name="c_code" class="form-control" placeholder="Country" required>
                        <option value="">Select</option>
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
                      @error('c_code')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Mobile No. <span class="text-danger">*</span></label>
                      <input type="text" name="mobile" value="{{ old('mobile') ?? $student->mobile }}"
                        class="form-control" placeholder="Enter Mobile No" required>
                      @error('mobile')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Email <span class="text-danger">*</span></label>
                      <input type="text" value="{{ old('email') ?? $student->email }}" class="form-control"
                        placeholder="Enter Email" required required>
                      @error('email')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Alternative Mobile No. </label>
                      <input type="text" name="alternative_mobile"
                        value="{{ old('alternative_mobile') ?? $student->alternative_mobile }}" class="form-control"
                        placeholder="Enter Alternative Mobile No.">
                      @error('alternative_mobile')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Parent's Mobile No. <span class="text-danger">*</span></label>
                      <input type="text" name="parents_mobile"
                        value="{{ old('parents_mobile') ?? $student->parents_mobile }}" class="form-control"
                        placeholder="Enter Parent's Mobile No." required>
                      @error('parents_mobile')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>

                <h5 class="mt-3">Present Address</h5>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Address <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" placeholder="eg: 473/2, Shyam Nagar" name="address"
                        value="{{ old('address') ?? $student->address }}">
                      @error('address')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>City <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" placeholder="Enter City" name="city"
                        value="{{ old('city') ?? $student->city }}">
                      @error('city')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>State/Province <span class="text-danger">*</span></label>
                      <input list="states" type="text" class="form-control" placeholder="Enter State"
                        name="state" value="{{ old('state') ?? $student->state }}">
                      <datalist id="states">
                        @php
                          $state = State::orderBy('statename', 'ASC')->where('country', 'IND')->get();
                        @endphp
                        @foreach ($state as $state)
                          <option value="{{ $state->statename }}">
                        @endforeach
                      </datalist>
                      @error('state')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Country <span class="text-danger">*</span></label>
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
                      @error('country')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Pincode/Zipcode <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" placeholder="Enter Pincode" name="zipcode"
                        value="{{ old('zipcode') ?? $student->zipcode }}">
                      @error('zipcode')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>

                <h5 class="mt-3">Permanent Address</h5>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Address <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" placeholder="eg: 473/2, Shyam Nagar"
                        name="parmanent_address" value="{{ old('parmanent_address') ?? $student->parmanent_address }}">
                      @error('parmanent_address')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>City <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" placeholder="Enter City" name="parmanent_city"
                        value="{{ old('parmanent_city') ?? $student->parmanent_city }}">
                      @error('parmanent_city')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>State/Province <span class="text-danger">*</span></label>
                      <input list="states" type="text" class="form-control" placeholder="Enter State"
                        name="parmanent_state" value="{{ old('parmanent_state') ?? $student->parmanent_state }}">
                      <datalist id="states">
                        @php
                          $state = State::orderBy('statename', 'ASC')->where('country', 'IND')->get();
                        @endphp
                        @foreach ($state as $state)
                          <option value="{{ $state->parmanent_statename }}">
                        @endforeach
                      </datalist>
                      @error('parmanent_state')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Country <span class="text-danger">*</span></label>
                      <select name="parmanent_country" class="form-control" placeholder="Country">
                        <option value="">Select Country</option>
                        @php
                          $country = Country::orderBy('name', 'ASC')->get();
                        @endphp
                        @foreach ($country as $country)
                          <option value="{{ $country->name }}"
                            {{ $country->name == $student->parmanent_country ? 'Selected' : '' }}>
                            {{ $country->name }}
                          </option>
                        @endforeach
                      </select>
                      @error('parmanent_country')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Pincode/Zipcode <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" placeholder="Enter Pincode" name="parmanent_zipcode"
                        value="{{ old('parmanent_zipcode') ?? $student->parmanent_zipcode }}">
                      @error('parmanent_zipcode')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-10 col-6"></div>
                  <div class="col-md-2 col-6 d-flex align-items-center">
                    <button class="btn_1 medium w-100 nextBtn" type="submit">Submit</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
@endsection
