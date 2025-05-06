@php
  use App\Models\Country;
  use App\Models\State;
@endphp
@extends('front.layouts.main')
@push('title')
  <title>Personal Details - Gyandeep NGO</title>
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
            <a href="javascript:void()" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
          </div>
          <div class="stepwizard-step">
            <a href="javascript:void()" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
          </div>
          <div class="stepwizard-step">
            <a href="javascript:void()" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
          </div>
        </div>
      </div>

      <form action="{{ url('scholarship/personal-details') }}" method="post" role="form">
        @csrf
        <div class="row setup-content" id="step-1">
          <div class="col-xl-12 col-lg-12">
            <div class="pb-2">
              <div id="detail-title" style="padding-left: 15px">
                <i class="icon-user-1"></i> Personal Details
              </div>
              <div class="box_general_3">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Candidate's Full Name <span class="text-danger">*</span></label>
                      <input type="text" name="name" value="{{ old('name') ?? $student->name }}"
                        class="form-control" placeholder="Enter Your First Name" />
                      @error('name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Father's Name <span class="text-danger">*</span></label>
                      <input type="text" name="father" value="{{ old('father') ?? $student->father }}"
                        class="form-control" placeholder="Enter Father Name" />
                      @error('father')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Father Occupation <span class="text-danger">*</span></label>
                      <input type="text" name="father_occupation"
                        value="{{ old('father_occupation') ?? $student->father_occupation }}" class="form-control"
                        placeholder="Enter Father Occupation" />
                      @error('father_occupation')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Father Annual Income <span class="text-danger">*</span></label>
                      <input type="text" name="father_income"
                        value="{{ old('father_income') ?? $student->father_income }}" class="form-control"
                        placeholder="Enter Father Income" />
                      @error('father_income')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Mother's Name <span class="text-danger">*</span></label>
                      <input type="text" name="mother" value="{{ old('mother') ?? $student->mother }}"
                        class="form-control" placeholder="Enter Mother Name" />
                      @error('mother')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Mother Occupation <span class="text-danger">*</span></label>
                      <input type="text" name="mother_occupation"
                        value="{{ old('mother_occupation') ?? $student->mother_occupation }}" class="form-control"
                        placeholder="Enter Mother Occupation" />
                      @error('mother_occupation')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Mother Annual Income <span class="text-danger">*</span></label>
                      <input type="text" name="mother_income"
                        value="{{ old('mother_income') ?? $student->mother_income }}" class="form-control"
                        placeholder="Enter Mother Income" />
                      @error('mother_income')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Gender <span class="text-danger">*</span></label>
                      <select class="form-control" name="gender">
                        <option value="">Select Gender</option>
                        <option value="Male"
                          {{ old('gender') == 'Male' || $student->gender == 'Male' ? 'Selected' : '' }}>Male
                        </option>
                        <option value="Female"
                          {{ old('gender') == 'Female' || $student->gender == 'Female' ? 'Selected' : '' }}>
                          Female</option>
                        <option value="Other"
                          {{ old('gender') == 'Other' || $student->gender == 'Other' ? 'Selected' : '' }}>
                          Other</option>
                      </select>
                      @error('gender')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Date of Birth <span class="text-danger">*</span></label>
                      <input type="date" name="dob" value="{{ old('dob') ?? $student->dob }}"
                        class="form-control" placeholder="Enter date of birth" />
                      @error('dob')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Category <span class="text-danger">*</span></label>
                      <select class="form-control" name="cast_category">
                        <option value="">Select</option>
                        <option value="SC/ST"
                          {{ old('cast_category') == 'SC/ST' || $student->cast_category == 'SC/ST' ? 'Selected' : '' }}>
                          SC/ST
                        </option>
                        <option value="OBC"
                          {{ old('cast_category') == 'OBC' || $student->cast_category == 'OBC' ? 'Selected' : '' }}>OBC
                        </option>
                        <option value="GENRAL"
                          {{ old('cast_category') == 'GENRAL' || $student->cast_category == 'GENRAL' ? 'Selected' : '' }}>
                          GENRAL
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Physically Handicaped <span class="text-danger">*</span></label>
                      <select class="form-control" name="handicaped">
                        <option value="">Select</option>
                        <option value="Yes"
                          {{ old('handicaped') == 'Yes' || $student->handicaped == 'Yes' ? 'Selected' : '' }}>
                          YES</option>
                        <option value="No"
                          {{ old('handicaped') == 'No' || $student->handicaped == 'No' ? 'Selected' : '' }}>NO
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Nationality <span class="text-danger">*</span></label>
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
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Aadhar Number/ National ID Number <span class="text-danger">*</span></label>
                      <input type="text" name="aadhar" value="{{ old('aadhar') ?? $student->aadhar }}"
                        class="form-control" placeholder="Enter Aadhar Number/ National ID Number" />
                      @error('aadhar')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Passport Number</label>
                      <input type="text" name="passport_number"
                        value="{{ old('passport_number') ?? $student->passport_number }}" class="form-control"
                        placeholder="Enter Passport Number" />
                      @error('passport_number')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Passport Expiry Date</label>
                      <input type="date" name="passport_expiry_date"
                        value="{{ old('passport_expiry_date') ?? $student->passport_expiry_date }}"
                        class="form-control" placeholder="Enter Your First Name" />
                      @error('passport_expiry_date')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-2 col-6"></div>
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
