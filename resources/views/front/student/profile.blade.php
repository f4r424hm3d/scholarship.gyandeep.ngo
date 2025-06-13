@php
  use App\Models\Country;
  use App\Models\State;
@endphp
@extends('front.layouts.main')
@push('title')
  <title>Profile - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>

    <section class="main-profile  py-5">
      <div class="container-fluid px-sm-5">
        <div class="row">

          @include('front.student.profile-sidebar')

          <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 mb-4">
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
            <div style="clear:both"></div>
            @if ($student->submit_application == 1)
              <div class="pb-2">
                <div id="detail-title" style="padding-left:15px"><i class="icon-info-circled"></i> Basic Information</div>
                <div class="box_general_3">
                  <div class="row">
                    <div class="row">
                      {{-- Basic Personal Information --}}
                      <x-student-info icon="icon-user-1" label="Full Name" :value="$student->name ?? 'N/A'" />
                      <x-student-info icon="icon-user-1" label="Gender" :value="ucfirst($student->gender ?? 'N/A')" />
                      <x-student-info icon="icon-calendar" label="DOB" :value="\Carbon\Carbon::parse($student->dob)->format('d M Y') ?? 'N/A'" />
                      <x-student-info icon="icon-flag" label="Nationality" :value="$student->nationality ?? 'N/A'" />
                      <x-student-info icon="fa fa-language" label="First Language" :value="$student->first_language ?? 'N/A'" />
                      <x-student-info icon="fa fa-heart" label="Marital Status" :value="$student->marital_status ?? 'N/A'" />
                      <x-student-info icon="fa fa-briefcase" label="Occupation" :value="$student->parents_occupation ?? 'N/A'" />
                      <x-student-info icon="fa fa-globe" label="Religion" :value="$student->religion ?? 'N/A'" />

                      {{-- Parents Information --}}
                      <x-student-info icon="fa fa-male" label="Father's Name" :value="$student->father ?? 'N/A'" />
                      <x-student-info icon="fa fa-female" label="Mother's Name" :value="$student->mother ?? 'N/A'" />
                      <x-student-info icon="fa fa-phone" label="Parents' Mobile" :value="$student->parents_mobile ?? 'N/A'" />

                      {{-- Contact & Address --}}
                      <x-student-info icon="fa fa-phone" label="Contact Number" :value="'+' . $student->c_code . ' ' . $student->mobile ?? 'N/A'" />
                      <x-student-info icon="icon-gmail" label="Email" :value="$student->email ?? 'N/A'" />
                      <x-student-info icon="fa fa-home" label="Home Address" :value="$student->address ?? 'N/A'" />
                      <x-student-info icon="fa fa-map-marker" label="City" :value="$student->city ?? 'N/A'" />
                      <x-student-info icon="fa fa-map-marker" label="State" :value="$student->state ?? 'N/A'" />
                      <x-student-info icon="fa fa-map-marker" label="Country" :value="$student->country ?? 'N/A'" />
                      <x-student-info icon="fa fa-map-pin" label="Zipcode" :value="$student->zipcode ?? 'N/A'" />

                      {{-- Passport Info --}}
                      <x-student-info icon="fa fa-id-card" label="Passport Number" :value="$student->passport_number ?? 'N/A'" />
                      <x-student-info icon="fa fa-calendar-check-o" label="Passport Expiry" :value="$student->passport_expiry_date
                          ? \Carbon\Carbon::parse($student->passport_expiry_date)->format('d M Y')
                          : 'N/A'" />

                      {{-- Education --}}
                      <x-student-info icon="fa fa-graduation-cap" label="10th Passing Year" :value="$student->passing_year_10 ?? 'N/A'" />
                      <x-student-info icon="fa fa-bar-chart" label="10th Result" :value="$student->result_10 ?? 'N/A'" />
                      <x-student-info icon="fa fa-graduation-cap" label="12th Passing Year" :value="$student->passing_year_12 ?? 'N/A'" />
                      <x-student-info icon="fa fa-bar-chart" label="12th Result" :value="$student->result_12 ?? 'N/A'" />
                      <x-student-info icon="fa fa-graduation-cap" label="NEET Passing Year" :value="$student->neet_passing_year ?? 'N/A'" />
                      <x-student-info icon="fa fa-bar-chart" label="NEET Result" :value="$student->neet_result ?? 'N/A'" />

                      {{-- Uploaded Documents --}}
                      <div class="col-md-6 mb-4">
                        <div class="d-flex">
                          <i class="fa fa-file name-icon"></i>
                          <span class="text-detailss">
                            <strong>10th Marksheet :</strong> {!! $student->marksheet_10_path
                                ? '<a href="' . asset($student->marksheet_10_path) . '" target="_blank">Uploaded</a>'
                                : 'Not Uploaded' !!}

                          </span>
                        </div>
                      </div>

                      <div class="col-md-6 mb-4">
                        <div class="d-flex">
                          <i class="fa fa-file name-icon"></i>
                          <span class="text-detailss">
                            <strong>12th Marksheet :</strong> {!! $student->marksheet_12_path
                                ? '<a href="' . asset($student->marksheet_12_path) . '" target="_blank">Uploaded</a>'
                                : 'Not Uploaded' !!}

                          </span>
                        </div>
                      </div>

                      <div class="col-md-6 mb-4">
                        <div class="d-flex">
                          <i class="fa fa-file name-icon"></i>
                          <span class="text-detailss">
                            <strong>NEET Result Copy :</strong> {!! $student->neet_result_path
                                ? '<a href="' . asset($student->neet_result_path) . '" target="_blank">Uploaded</a>'
                                : 'Not Uploaded' !!}

                          </span>
                        </div>
                      </div>

                      <div class="col-md-6 mb-4">
                        <div class="d-flex">
                          <i class="fa fa-file name-icon"></i>
                          <span class="text-detailss">
                            <strong>Passport Copy :</strong> {!! $student->passport_path
                                ? '<a href="' . asset($student->passport_path) . '" target="_blank">Uploaded</a>'
                                : 'Not Uploaded' !!}

                          </span>
                        </div>
                      </div>
                      <div class="col-md-6 mb-4">
                        <div class="d-flex">
                          <i class="fa fa-id-card name-icon"></i>
                          <span class="text-detailss">
                            <strong>Aadhar Card :</strong> {!! $student->aadhar_path
                                ? '<a href="' . asset($student->aadhar_path) . '" target="_blank">Uploaded</a>'
                                : 'Not Uploaded' !!}
                          </span>
                        </div>
                      </div>
                      <div class="col-md-6 mb-4">
                        <div class="d-flex">
                          <i class="fa fa-user name-icon"></i>
                          <span class="text-detailss">
                            <strong>Photo :</strong> {!! $student->photo_path
                                ? '<a href="' . asset($student->photo_path) . '" target="_blank">Uploaded</a>'
                                : 'Not Uploaded' !!}
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @else
              <div class="pb-2">
                <div id="detail-title" style="padding-left:15px"><i class="icon-info-circled"></i> Basic
                  Information
                </div>

                <div class="box_general_3">
                  <p class="text-danger"><strong>Note:</strong> All fields marked with <span class="text-danger">*</span>
                    are mandatory.</p>
                  <form action="{{ url('profile/update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Personal information start 1 -->
                    <div class="row g-3">
                      <div class="col-12">
                        <h5 class="mt-4">
                          Personal information
                        </h5>
                        <hr>
                      </div>
                      <div class="col-md-3 col-sm-12">
                        <label class="form-label " for="name">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="name"
                          placeholder="Enter Full Name" value="{{ old('name') ?? $student->name }}">
                        @error('name')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="col-md-3 col-sm-12">
                        <label class="form-label " for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" value="{{ $student->email }}"
                          disabled>
                        @error('email')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="col-md-3 col-sm-12">
                        <label class="form-label " for="c_code">Country Code <span
                            class="text-danger">*</span></label>
                        <input type="number" min="0" class="form-control" name="c_code" id="c_code"
                          placeholder="Enter country code" value="{{ old('c_code') }}">
                        @error('c_code')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="col-md-3 col-sm-12">
                        <label class="form-label " for="mobile">Phone Number <span
                            class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="mobile" id="mobile"
                          placeholder="Enter Phone Number" value="{{ old('mobile') }}">
                        @error('mobile')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="col-md-3 col-sm-12">
                        <label class="form-label " for="father">Father's Name <span
                            class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="father" id="father"
                          placeholder="Enter Father Name" value="{{ old('father') }}">
                        @error('father')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="col-md-3 col-sm-12">
                        <label class="form-label " for="mother">Mother's Name <span
                            class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="mother" id="mother"
                          placeholder="Enter Mother Name" value="{{ old('mother') }}">
                        @error('mother')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="col-md-3 col-sm-12">
                        <label class="form-label " for="parents_mobile">Parents Contact No <span
                            class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="parents_mobile" id="parents_mobile"
                          placeholder="Enter Mother Mobile" value="{{ old('parents_mobile') }}">
                        @error('parents_mobile')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="col-md-3 col-sm-12">
                        <label class="form-label " for="nationality">Nationality <span
                            class="text-danger">*</span></label>
                        <select name="nationality" id="nationality" class="form-select">
                          <option value="">Select</option>
                          @foreach ($countries as $row)
                            <option value="{{ $row->name }}"
                              {{ old('nationality') == $row->name ? 'selected' : '' }}>
                              {{ $row->name }}</option>
                          @endforeach
                        </select>
                        @error('nationality')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="col-md-3 col-sm-12">
                        <label class="form-label " for="gender">Gender <span class="text-danger">*</span></label>
                        <select id="gender" name="gender" class="form-select">
                          <option value="" selected>Select</option>
                          <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                          <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                          </option>
                          <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="col-md-3 col-sm-12">
                        <label class="form-label " for="occupation">Parents Occupation <span
                            class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="occupation" id="occupation"
                          placeholder="Enter Parents Occupation" value="{{ old('occupation') }}">
                        @error('occupation')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="col-md-3 col-sm-12">
                        <label class="form-label " for="dob">D.O.B <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="dob" id="dob"
                          placeholder="Enter date of birth" value="{{ old('dob') }}" max="2010-12-31">
                        @error('dob')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="col-md-3 col-sm-12">
                        <label class="form-label " for="first_language">First Language <span
                            class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="first_language" id="first_language"
                          placeholder="Enter First Language" value="{{ old('first_language') }}">
                        @error('first_language')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="col-md-3 col-sm-12">
                        <label class="form-label " for="marital_status">Marital Status <span
                            class="text-danger">*</span></label>
                        <select name="marital_status" id="marital_status" class="form-select">
                          <option value="">Select</option>
                          <option value="Single" {{ old('marital_status') == 'Single' ? 'selected' : '' }}>
                            Single
                          </option>
                          <option value="Married" {{ old('marital_status') == 'Married' ? 'selected' : '' }}>
                            Married
                          </option>
                        </select>
                        @error('marital_status')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="col-md-3 col-sm-12">
                        <label class="form-label " for="passport_number">Passport Number</label>
                        <input type="text" class="form-control" name="passport_number" id="passport_number"
                          placeholder="Enter Passport Number" value="{{ old('passport_number') }}">
                        @error('passport_number')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="col-md-3 col-sm-12">
                        <label class="form-label " for="passport_expiry">Passport Expiry</label>
                        <input type="date" class="form-control" name="passport_expiry" id="passport_expiry"
                          placeholder="Enter Passport Expiry date" value="{{ old('passport_expiry') }}"
                          min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                        @error('passport_expiry')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="col-md-3 col-sm-12">
                        <label class="form-label " for="religion">Religion <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="religion" id="religion"
                          placeholder="Enter Religion" value="{{ old('religion') }}">
                        @error('religion')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <!-- address detail start 1 -->
                    <div class="row g-3">
                      <div class="col-12">
                        <h5 class="mt-4">Address detail</h5>
                        <hr>
                      </div>
                      <div class="col-md-6 col-sm-12">
                        <label class="form-label" for="home_address">Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="home_address" id="home_address"
                          placeholder="Enter address" value="{{ old('home_address') }}">
                        @error('home_address')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="col-md-3 col-sm-12">
                        <label class="form-label" for="city">City <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="city" id="city"
                          placeholder="Enter city" value="{{ old('city') }}">
                        @error('city')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="col-md-3 col-sm-12">
                        <label class="form-label" for="state">State <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="state" id="state"
                          placeholder="Enter state" value="{{ old('state') }}">
                        @error('state')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="col-md-3 col-sm-12">
                        <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                        <select class="form-select" id="country" name="country" aria-label="Select Country">
                          <option value="">Select</option>
                          @foreach ($countries as $row)
                            <option value="{{ $row->name }}" {{ old('country') == $row->name ? 'selected' : '' }}>
                              {{ $row->name }}</option>
                          @endforeach
                        </select>
                        @error('country')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="col-md-3 col-sm-12">
                        <label class="form-label" for="zipcode">Postal/Zipcode <span
                            class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="zipcode" id="zipcode"
                          placeholder="Enter Postal/Zipcode" value="{{ old('zipcode') }}">
                        @error('zipcode')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                    </div>
                    <!-- Education Summary start 1 -->
                    <div class="row">
                      <div class="col-12 mb-3">
                        <h5 class="mt-4">Education Summary </h5>
                        <hr>
                      </div>
                      <div class="col-md-4 col-sm-12 mb-3">
                        <label for="10th" class="form-label">Grade</label>
                        <input type="text" class="form-control" id="10th" placeholder="10th" value="10th"
                          disabled />
                      </div>
                      <div class="col-md-4 col-sm-12 mb-3">
                        <label for="passing_year_10" class="form-label">Passing Year <span
                            class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="passing_year_10" name="passing_year_10"
                          placeholder="Enter Passing Year" max="{{ date('Y') }}"
                          value="{{ old('passing_year_10') }}" />
                        @error('passing_year_10')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="col-md-4 col-sm-12 mb-3">
                        <label for="result_10" class="form-label">Result <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="result_10" name="result_10"
                          placeholder="Enter Result" value="{{ old('result_10') }}" />
                        @error('result_10')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="col-md-4 col-sm-12 mb-3">
                        <label for="country_of_education" class="form-label">Grade</label>
                        <input type="text" class="form-control" id="12th" placeholder="12th" value="12th"
                          disabled />
                      </div>
                      <div class="col-md-4 col-sm-12 mb-3">
                        <label for="passing_year_12" class="form-label">Passing Year <span
                            class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="passing_year_12" name="passing_year_12"
                          placeholder="Enter Passing Year" max="{{ date('Y') }}"
                          value="{{ old('passing_year_12') }}" />
                        @error('passing_year_12')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="col-md-4 col-sm-12 mb-3">
                        <label for="result_12" class="form-label">Result <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="result_12" name="result_12"
                          placeholder="Enter Result" value="{{ old('result_12') }}" />
                        @error('result_12')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="col-md-4 col-sm-12 mb-3">
                        <label for="country_of_education" class="form-label">Grade</label>
                        <input type="text" class="form-control" id="NEET" placeholder="NEET" value="NEET"
                          disabled />
                      </div>
                      <div class="col-md-4 col-sm-12 mb-3">
                        <label for="neet_passing_year" class="form-label">Passing Year</label>
                        <input type="year" class="form-control" id="neet_passing_year" name="neet_passing_year"
                          placeholder="Enter Passing Year" max="{{ date('Y') }}"
                          value="{{ old('neet_passing_year') }}" />
                        @error('neet_passing_year')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="col-md-3 col-sm-12 mb-3">
                        <label for="neet_result" class="form-label">Result</label>
                        <input type="text" class="form-control" id="neet_result" name="neet_result"
                          placeholder="Enter Result" value="{{ old('neet_result') }}" />
                        @error('neet_result')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <!-- Test Score start 1 -->
                    <div class="row">
                      <div class="col-12 mb-3">
                        <h5 class="d-flex align-items-center main-docs">
                          Document :
                          <p class="text-danger main-onlys ">Only jpg, jpeg, png and pdf files are allowed. File
                            size
                            should not
                            exceed
                            1MB.</p>
                        </h5>
                        <hr>
                      </div>
                      <!-- Document Select Dropdown -->
                      <!-- File Upload -->
                      <div class="col-md-4 mb-3">
                        <label for="marksheet_10_copy" class="form-label">Upload 10th Marksheet <span
                            class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="marksheet_10_copy" name="marksheet_10_copy"
                          value="{{ old('marksheet_10_copy') }}">

                        @error('marksheet_10_copy')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="marksheet_12_copy" class="form-label">Upload 12th Marksheet <span
                            class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="marksheet_12_copy" name="marksheet_12_copy"
                          value="{{ old('marksheet_12_copy') }}">
                        @error('marksheet_12_copy')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="aadhar_copy" class="form-label">Upload Aadhar <span
                            class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="aadhar_copy" name="aadhar_copy"
                          value="{{ old('aadhar_copy') }}">
                        @error('aadhar_copy')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="photo_copy" class="form-label">Upload Passport Size Photo <span
                            class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="photo_copy" name="photo_copy"
                          value="{{ old('photo_copy') }}">
                        @error('photo_copy')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="neet_result_copy" class="form-label">Upload NEET Result</label>
                        <input type="file" class="form-control" id="neet_result_copy" name="neet_result_copy"
                          value="{{ old('neet_result_copy') }}">
                        @error('neet_result_copy')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="passport_copy" class="form-label">Upload Passport Photocopy</label>
                        <input type="file" class="form-control" id="passport_copy" name="passport_copy"
                          value="{{ old('passport_copy') }}">
                        @error('passport_copy')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                          <h5 class="mt-4">Scholarship Details </h5>
                        </div>
                        <hr>
                      </div>
                      <div class="col-md-4 col-sm-12 mb-3">
                        <label for="scholarship" class="form-label">Select Scholarship</label>
                        <select class="form-select" id="scholarship" name="scholarship"
                          aria-label="Country of Education">
                          <option value="">Select Scholarship</option>
                          @foreach ($scholarships as $row)
                            <option value="{{ $row->id }}" {{ old('scholarship') == $row->id ? 'selected' : '' }}>
                              {{ $row->name }}</option>
                          @endforeach
                        </select>
                        @error('scholarship')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="col-md-4 col-sm-12 mb-3">
                        <label for="course_category" class="form-label">Select Category</label>
                        <select class="form-select" id="course_category" name="course_category"
                          aria-label="Country of Education">
                          <option value="">Select Category</option>
                          @if (old('scholarship'))
                            @foreach ($categories as $row)
                              <option value="{{ $row->id }}"
                                {{ old('course_category') == $row->id ? 'selected' : '' }}>
                                {{ $row->getCourseCategory->category }}</option>
                            @endforeach
                          @endif
                        </select>
                        @error('course_category')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="col-md-4 col-sm-12 mb-3">
                        <label for="country_of_education" class="form-label">Select Exam Date</label>
                        <input type="date" name="exam_date" id="exam_date" class="form-control"
                          value="{{ old('exam_date') }}" />
                      </div>
                    </div>
                    <div class="row">

                      <!-- Buttons -->
                      <div class="col-md-12 mb-3 text-end ">
                        <div>
                          <button id="sbtBtnDu" type="submit" class="btn btn-primary me-2">
                            Submit Application
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            @endif

          </div>
        </div>
      </div>
    </section>
  </main>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $('#scholarship').on('change', function() {
      var scholarshipId = $('#scholarship').val();
      if (scholarshipId) {
        $.ajax({
          url: "{{ url('/get-course-categories') }}/" + scholarshipId,
          type: 'GET',
          success: function(data) {
            $('#course_category').html(data);
          },
          error: function() {
            alert('Unable to fetch course categories.');
          }
        });
      } else {
        $('#course_category').empty().append('<option value="">Select Category</option>');
      }
    });
  </script>
@endsection
