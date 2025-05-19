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
    <section class="main-profile py-sm-5">
      <div class="container-fluid px-sm-5">
        <div class="row">

          @include('front.student.profile-sidebar')

          <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 mb-4">
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
                  <div class="col-12 text-end">

                    <input type="submit" class="btn_1 medium" value="Submit">
                    <!-- <a href="#0" class="medium">Cancel</a> -->
                  </div>

                </form>
              </div>

              <div class="box_general_3">
                <!-- basic Information start 1 -->

                <form id="basicInfoForm" method="post">
                  <input type="hidden" name="id" value="">

                  <div class="row g-3">
                    <!-- <div class="col-12">
          <h5 class="mt-4" >Basic Information</h5>
  <hr>
        </div> -->
                    <div class="col-md-3 col-sm-12">
                      <label class="form-label " for="interested_course_category">Interested Subject/Course</label>
                      <input type="text" class="form-control" name="interested_course_category"
                        id="interested_course_category" placeholder="Interested Subject/Course">
                    </div>

                    <div class="col-md-3 col-sm-12">
                      <label class="form-label " for="interested_university">Interested University</label>
                      <input type="text" class="form-control" name="interested_university"
                        id="interested_university" placeholder="Interested University">
                    </div>

                    <div class="col-md-3 col-sm-12">
                      <label class="form-label " for="highest_qualification">Highest Qualification</label>
                      <input type="text" class="form-control" name="highest_qualification"
                        id="highest_qualification" placeholder="Highest Qualification">
                    </div>

                    <div class="col-md-3 col-sm-12">
                      <label class="form-label " for="exam_taken">Exam Taken</label>
                      <input type="text" class="form-control" name="exam_taken" id="exam_taken"
                        placeholder="Exam Taken">
                    </div>

                    <div class="col-md-3 col-sm-12">
                      <label class="form-label " for="preferred_destination">Preferred Destination</label>
                      <input type="text" class="form-control" name="preferred_destination"
                        id="preferred_destination" placeholder="Preferred Destination">
                    </div>
                  </div>

                  <div class="row mt-4">
                    <div class="col-12 text-end">
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </div>
                </form>

                <!-- Personal information start 1 -->
                <div class="row g-3">
                  <div class="col-12">
                    <h5 class="mt-4">
                      Personal information
                    </h5>
                    <hr>
                  </div>
                  <div class="col-md-3 col-sm-12">
                    <label class="form-label " for="name">Full Name</label>
                    <input type="text" class="form-control" name="name" id="name"
                      placeholder="Enter Full Name">
                  </div>

                  <div class="col-md-3 col-sm-12">
                    <label class="form-label " for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email"
                      placeholder="Enter email">
                  </div>

                  <div class="col-md-3 col-sm-12">
                    <label class="form-label " for="c_code">Country Code</label>
                    <input type="number" min="0" class="form-control" name="c_code" id="c_code"
                      placeholder="Enter country code">
                  </div>

                  <div class="col-md-3 col-sm-12">
                    <label class="form-label " for="mobile">Phone Number</label>
                    <input type="text" class="form-control" name="mobile" id="mobile"
                      placeholder="Enter Phone Number">
                  </div>

                  <div class="col-md-3 col-sm-12">
                    <label class="form-label " for="father">Father Name</label>
                    <input type="text" class="form-control" name="father" id="father"
                      placeholder="Enter Father Name">
                  </div>

                  <div class="col-md-3 col-sm-12">
                    <label class="form-label " for="father_mobile">Father Mobile</label>
                    <input type="text" class="form-control" name="father_mobile" id="father_mobile"
                      placeholder="Enter Father Mobile">
                  </div>

                  <div class="col-md-3 col-sm-12">
                    <label class="form-label " for="mother">Mother Name</label>
                    <input type="text" class="form-control" name="mother" id="mother"
                      placeholder="Enter Mother Name">
                  </div>

                  <div class="col-md-3 col-sm-12">
                    <label class="form-label " for="mother_mobile">Mother Mobile</label>
                    <input type="text" class="form-control" name="mother_mobile" id="mother_mobile"
                      placeholder="Enter Mother Mobile">
                  </div>

                  <div class="col-md-3 col-sm-12">
                    <label class="form-label " for="nationality">Country of Citizenship</label>
                    <select name="nationality" id="nationality" class="form-select">
                      <option value="" selected>Select</option>
                      <option value="AFGHANISTAN">AFGHANISTAN</option>
                      <option value="ALBANIA">ALBANIA</option>
                      <option value="ALGERIA">ALGERIA</option>
                      <option value="AMERICAN SAMOA">AMERICAN SAMOA</option>
                      <option value="ANDORRA">ANDORRA</option>
                    </select>
                  </div>

                  <div class="col-md-3 col-sm-12">
                    <label class="form-label " for="gender">Gender</label>
                    <select id="gender" name="gender" class="form-select">
                      <option value="" selected>Select</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                      <option value="other">Other</option>
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-12">
                    <label class="form-label " for="occupation">Personal Occupation</label>
                    <input type="text" class="form-control" name="occupation" id="occupation"
                      placeholder="Enter Personal Occupation">
                  </div>

                  <div class="col-md-3 col-sm-12">
                    <label class="form-label " for="dob">D.O.B</label>
                    <input type="date" class="form-control" name="dob" id="dob"
                      placeholder="Enter date of birth">
                  </div>

                  <div class="col-md-3 col-sm-12">
                    <label class="form-label " for="first_language">First Language</label>
                    <input type="text" class="form-control" name="first_language" id="first_language"
                      placeholder="Enter First Language">
                  </div>

                  <div class="col-md-3 col-sm-12">
                    <label class="form-label " for="marital_status">Marital Status</label>
                    <select name="marital_status" id="marital_status" class="form-select">
                      <option value="" selected>Select</option>
                      <option value="Single">Single</option>
                      <option value="Married">Married</option>
                    </select>
                  </div>

                  <div class="col-md-3 col-sm-12">
                    <label class="form-label " for="passport_number">Passport Number</label>
                    <input type="text" class="form-control" name="passport_number" id="passport_number"
                      placeholder="Enter Passport Number">
                  </div>

                  <div class="col-md-3 col-sm-12">
                    <label class="form-label " for="passport_expiry">Passport Expiry</label>
                    <input type="date" class="form-control" name="passport_expiry" id="passport_expiry"
                      placeholder="Enter Passport Expiry date">
                  </div>

                  <div class="col-md-3 col-sm-12">
                    <label class="form-label " for="religion">Religion</label>
                    <input type="text" class="form-control" name="religion" id="religion"
                      placeholder="Enter Religion">
                  </div>
                </div>

                <!-- address detail start 1 -->

                <div class="row g-3">
                  <div class="col-12">
                    <h5 class="mt-4">Address detail</h5>
                    <hr>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <label class="form-label" for="home_address">Address</label>
                    <input type="text" class="form-control" name="home_address" id="home_address"
                      placeholder="Enter address">
                  </div>

                  <div class="col-md-3 col-sm-12">
                    <label class="form-label" for="city">City</label>
                    <input type="text" class="form-control" name="city" id="city"
                      placeholder="Enter city">
                  </div>

                  <div class="col-md-3 col-sm-12">
                    <label for="state" class="form-label">State/Province</label>
                    <select class="form-select" id="state" name="state" aria-label="Select State">
                      <option selected disabled>Open this select menu</option>
                      <option value="Selangor">Selangor</option>
                      <option value="Sabah">Sabah</option>
                      <option value="Perlis">Perlis</option>
                      <option value="Penang">Penang</option>
                      <option value="Negeri Sembilan">Negeri Sembilan</option>
                      <option value="Andaman and Nicobar Island (UT)">Andaman and Nicobar Island (UT)</option>
                    </select>
                  </div>

                  <div class="col-md-3 col-sm-12">
                    <label for="country" class="form-label">Country (Malaysia)</label>
                    <select class="form-select" id="country" name="country" aria-label="Select Country">
                      <option selected disabled>Open this select menu</option>
                      <option value="AFGHANISTAN">AFGHANISTAN</option>
                      <option value="ALBANIA">ALBANIA</option>
                      <option value="ALGERIA">ALGERIA</option>
                      <option value="AMERICAN SAMOA">AMERICAN SAMOA</option>
                      <option value="ANDORRA">ANDORRA</option>
                      <option value="MARSHALL ISLANDS">MARSHALL ISLANDS</option>
                    </select>

                  </div>

                  <div class="col-md-3 col-sm-12">
                    <label class="form-label" for="zipcode">Postal/Zipcode</label>
                    <input type="text" class="form-control" name="zipcode" id="zipcode"
                      placeholder="Enter Postal/Zipcode">
                  </div>

                  <div class="col-md-3 col-sm-12">
                    <label class="form-label" for="home_contact_number">Home Contact Number</label>
                    <input type="number" class="form-control" name="home_contact_number" id="home_contact_number"
                      placeholder="Enter home contact number">
                  </div>
                </div>
                <!-- Education Summary start 1 -->

                <div class="row">
                  <div class="col-12 mb-3">
                    <h5 class="mt-4">Education Summary
                    </h5>
                    <hr>

                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <label for="country_of_education" class="form-label">Country of Education</label>
                    <select class="form-select" id="country_of_education" name="country_of_education"
                      aria-label="Country of Education">
                      <option selected>Select</option>
                      <option value="AFGHANISTAN">AFGHANISTAN</option>
                      <option value="ALBANIA">ALBANIA</option>
                      <option value="ALGERIA">ALGERIA</option>
                      <option value="AMERICAN SAMOA">AMERICAN SAMOA</option>
                      <option value="ANDORRA">ANDORRA</option>
                    </select>
                  </div>

                  <div class="col-md-3 col-sm-12 mb-3">
                    <label for="highest_level_of_education" class="form-label">Highest Level of Education</label>
                    <select class="form-select" id="highest_level_of_education" name="highest_level_of_education"
                      aria-label="Highest Level of Education">
                      <option selected>Select</option>
                      <option value="Grade 9">Grade 9</option>
                      <option value="Grade 10">Grade 10</option>
                      <option value="Grade 11">Grade 11</option>
                    </select>
                  </div>

                  <div class="col-md-3 col-sm-12 mb-3">
                    <label for="grading_scheme" class="form-label">Grading Scheme</label>
                    <select class="form-select" id="grading_scheme" name="grading_scheme" aria-label="Grading Scheme">
                      <option selected>Select</option>
                      <option value="Percentage scale (0-100)">Percentage scale (0-100)</option>
                      <option value="Grade Points (10 scale)">Grade Points (10 scale)</option>
                      <option value="Grade (A to E)">Grade (A to E)</option>
                    </select>
                  </div>

                  <div class="col-md-3 col-sm-12 mb-3">
                    <label for="grade_average" class="form-label">Grade Average</label>
                    <input type="text" class="form-control" id="grade_average" name="grade_average"
                      placeholder="Enter Grade Average" />
                  </div>
                </div>
                <!-- Test Score start 1 -->

                <!-- <div class="row">
        <div class="col-12 mb-3">
      <h5 class="mt-4" >Test Score
  </h5>
  <hr>
  </div>
    <div class="col-md-3 col-sm-12 mb-3">
      <label for="english_exam_type" class="form-label">English Exam Type</label>
      <select name="english_exam_type" id="english_exam_type" class="form-select" aria-label="English Exam Type">
        <option value="" selected>Select</option>
        <option value="I dont have this">I don't have this</option>
        <option value="I will provide this later">I will provide this later</option>
        <option value="TOEFL">TOEFL</option>
        <option value="IELTS">IELTS</option>
        <option value="Duolingo English Test">Duolingo English Test</option>
        <option value="PTE">PTE</option>
      </select>
    </div>

    <div class="col-md-3 col-sm-12 mb-3">
      <label for="date_of_exam" class="form-label">Date of Exam</label>
      <input type="date" class="form-control" name="date_of_exam" id="date_of_exam" placeholder="Enter Date of Exam" value="">
    </div>

    <div class="col-md-3 col-sm-12 mb-3">
      <label for="listening_score" class="form-label">Listening</label>
      <input type="number" class="form-control" name="listening_score" id="listening_score" placeholder="Enter Listening Score" value="" step="any" min="0">
    </div>

    <div class="col-md-3 col-sm-12 mb-3">
      <label for="reading_score" class="form-label">Reading</label>
      <input type="number" class="form-control" name="reading_score" id="reading_score" placeholder="Enter Reading Score" value="" step="any" min="0">
    </div>

    <div class="col-md-3 col-sm-12 mb-3">
      <label for="writing_score" class="form-label">Writing</label>
      <input type="number" class="form-control" name="writing_score" id="writing_score" placeholder="Enter Writing Score" value="" step="any" min="0">
    </div>

    <div class="col-md-3 col-sm-12 mb-3">
      <label for="speaking_score" class="form-label">Speaking</label>
      <input type="number" class="form-control" name="speaking_score" id="speaking_score" placeholder="Enter Speaking Score" value="" step="any" min="0">
    </div>

    <div class="col-md-3 col-sm-12 mb-3">
      <label for="overall_score" class="form-label">Overall Score</label>
      <input type="number" class="form-control" name="overall_score" id="overall_score" placeholder="Enter Overall Score" value="" step="any" min="0">
    </div>
  </div> -->

                <!-- Document -->
                <div class="row">
                  <div class="col-12 mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                      <h5 class="mt-4">Document

                      </h5>
                      <i class="fa fa-window-close" aria-hidden="true"></i>

                    </div>
                    <hr>
                  </div>
                  <div class="row">
                    <!-- Document Select Dropdown -->
                    <div class="col-md-4 mb-3">
                      <label for="doc_name" class="form-label">Document Type</label>
                      <select class="form-select" id="doc_name" name="doc_name" required>
                        <option value="" selected>Select Document</option>
                        <option value="Doctoral Degree">Doctoral Degree (Transcript)</option>
                        <option value="Masters Degree">Masters Degree (Transcript)</option>
                        <option value="4-Year Bachelors Degree">4-Year Bachelors Degree (Transcript)</option>
                        <option value="Grade 12">Grade 12/High School (Transcript)</option>
                        <option value="Passport">Passport</option>
                      </select>
                    </div>

                    <!-- File Upload -->
                    <div class="col-md-4 mb-3">
                      <label for="files" class="form-label">Upload Image</label>
                      <input type="file" onchange="validate(this.value)" class="form-control" id="files"
                        name="files" required>
                      <span id="imageFileError" class="text-danger fw-bold"></span>
                      <span id="imageFileError2" class="text-danger fw-bold"></span>
                    </div>

                    <!-- Buttons -->
                    <div class="col-md-4 mb-3 d-flex align-items-end">
                      <div>
                        <button onclick="wait()" id="sbtBtnDu" name="uploadDoc" type="submit"
                          class="btn btn-primary me-2">
                          <i class="bi bi-upload"></i> Upload
                        </button>
                        <button style="display: none;" id="wtnBtnDu" type="button" class="btn btn-warning" disabled>
                          <i class="bi bi-cloud-upload"></i> Uploading...
                        </button>
                      </div>
                    </div>
                  </div>

                </div>

                <!-- document table -->
                <div class="col-12 mb-3">
                  <div class="d-flex justify-content-between align-items-center mt-5">
                    <h5 class="">Document

                    </h5>
                    <button type="button" class="btn btn-outline-success btn-sm" id="formBtn">
                      <i class="fa fa-upload" aria-hidden="true"></i> Upload Document
                    </button>

                  </div>
                  <hr>

                </div>

                <div class="row mb-3">
                  <!-- Show Entries -->
                  <div class="col-sm-12 col-md-6 mb-3">
                    <div class="d-flex align-items-center g-3">
                      <label for="selectExample" class="form-label me-3 mb-0">Show</label>
                      <select id="selectExample" class="form-select w-25" aria-label="Select number of entries">
                        <option selected disabled>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                    </div>

                  </div>

                  <!-- Search -->
                  <div class="col-sm-12 col-md-6 text-md-end mt-3 mt-md-0">
                    <label for="searchInput" class="form-label">Search</label>
                    <input type="search" id="searchInput"
                      class="form-control form-control-sm d-inline-block w-auto ms-2" placeholder="Search..."
                      aria-controls="datatables-basic">
                  </div>

                  <div class="col-12">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered">
                        <thead class="table-light">
                          <tr>
                            <th scope="col">S. N.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Path</th>
                            <th scope="col">File</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>Doctoral Degree (Phd, M.D., ...)</td>
                            <td>
                              <input type="text" class="form-control d-inline w-auto">
                              <button class="btn btn-outline-success btn-sm ms-2">
                                Copy
                              </button>
                            </td>
                            <td>
                              <a href="#" target="_blank">View</a> |
                              <a href="#">Download</a>
                            </td>
                            <td>
                              <button class="btn btn-outline-danger btn-sm me-1">
                                <i class="fa fa-trash"></i>
                              </button>
                              <a href="#" class="btn btn-outline-info btn-sm">
                                <i class="fa fa-edit"></i>
                              </a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

              </div>

            </div>
          </div>

        </div>
      </div>
    </section>
  </main>
@endsection
