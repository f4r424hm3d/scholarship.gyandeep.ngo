@extends($role . '.layouts.main')
@push('title')
  <title>{{ $page_title }}</title>
@endpush
@section('main-section')
  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ $page_title }} <span class="text-danger">({{ $student->name }})</span>
            </h4>
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ url($role) }}"><i class="mdi mdi-home-outline"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ url($role . '/students/') }}">Students</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      @include('common.student-profile-header')
      <div class="row">
        <div class="col-xl-12">
          <!-- NOTIFICATION FIELD START -->
          <x-result-notification-field />
          <!-- NOTIFICATION FIELD END -->
        </div>
      </div>

      <div class="row hide-this">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Student Profile</h4>
            </div>
            <div class="card-body {{ $ft == 'edit' ? '' : 'hide-thi' }}" id="tblCDiv">
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
          <!-- end card -->
        </div>
      </div>
      <div class="row hide-thi">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Student Profile</h4>
            </div>
            <div class="card-body {{ $ft == 'edit' ? '' : 'hide-thi' }}" id="tblCDiv">
              <form action="{{ url($role . '/student/update') }}" class="needs-validation" method="post"
                enctype="multipart/form-data" novalidate>
                <input type="hidden" name="id" value="{{ $student->id }}">
                @csrf
                <div class="row">
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-input-field type="text" label="Name" name="name" id="name" :ft="$ft"
                      :sd="$student" readonly="readonl" />
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="text" label="Email" name="email" id="email" :ft="$ft"
                      :sd="$student" readonly="readonl" />
                  </div>
                  <div class="col-md-1 col-sm-12 mb-3">
                    <x-input-field type="text" label="Code" name="c_code" id="c_code" :ft="$ft"
                      :sd="$student" readonly="readonl" />
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-input-field type="text" label="Contact" name="mobile" id="mobile" :ft="$ft"
                      :sd="$student" readonly="readonl" />
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-input-field type="text" label="Gender" name="gender" id="gender" :ft="$ft"
                      :sd="$student" readonly="readonl" />
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-input-field type="text" label="DOB" name="dob" id="dob" :ft="$ft"
                      :sd="$student" readonly="readonl" />
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-select-field type="text" label="Nationality" name="nationality" id="nationality"
                      :ft="$ft" :sd="$student" :list="$countries" showv="name" savev="name"
                      readonly="readonl" />
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-input-field type="text" label="First Language" name="first_language" id="first_language"
                      :ft="$ft" :sd="$student" readonly="readonl" />
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-s-d-a-select-field type="text" label="Marital Status" name="marital_status"
                      id="marital_status" :ft="$ft" :sd="$student" :list="$maritulStatuses" readonly="readonl" />
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-input-field type="text" label="Religion" name="religion" id="religion" :ft="$ft"
                      :sd="$student" readonly="readonl" />
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="text" label="Passport Number" name="passport_number" id="passport_number"
                      :ft="$ft" :sd="$student" readonly="readonl" />
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="date" label="Passport Expiry Date" name="passport_expiry_date"
                      id="passport_expiry_date" :ft="$ft" :sd="$student" readonly="readonl" />
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="text" label="Father Name" name="father" id="father" :ft="$ft"
                      :sd="$student" readonly="readonl" />
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="text" label="Mother Name" name="mother" id="mother" :ft="$ft"
                      :sd="$student" readonly="readonl" />
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="text" label="Parents Contact No." name="parents_mobile"
                      id="parents_mobile" :ft="$ft" :sd="$student" readonly="readonl" />
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="text" label="Parents Occupation" name="parents_occupation"
                      id="parents_occupation" :ft="$ft" :sd="$student" readonly="readonl" />
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-12 mb-3">
                    <x-input-field type="text" label="Address" name="address" id="address" :ft="$ft"
                      :sd="$student" readonly="readonl" />
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="text" label="City" name="city" id="city" :ft="$ft"
                      :sd="$student" readonly="readonl" />
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="text" label="State" name="state" id="state" :ft="$ft"
                      :sd="$student" readonly="readonl" />
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-select-field type="text" label="Country" name="country" id="country" :ft="$ft"
                      :sd="$student" :list="$countries" showv="name" savev="name" readonly="readonl" />
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="text" label="Zipcode" name="zipcode" id="zipcode" :ft="$ft"
                      :sd="$student" readonly="readonl" />
                  </div>
                </div>
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
                    <x-input-field type="text" label="Passing Year" name="passing_year_10" id="passing_year_10"
                      :ft="$ft" :sd="$student" readonly="readonl" />
                  </div>
                  <div class="col-md-4 col-sm-12 mb-3">
                    <x-input-field type="text" label="Result" name="result_10" id="result_10" :ft="$ft"
                      :sd="$student" readonly="readonl" />
                  </div>
                  <div class="col-md-4 col-sm-12 mb-3">
                    <label for="12th" class="form-label">Grade</label>
                    <input type="text" class="form-control" id="12th" placeholder="12th" value="12th"
                      disabled />
                  </div>
                  <div class="col-md-4 col-sm-12 mb-3">
                    <x-input-field type="text" label="Passing Year" name="passing_year_12" id="passing_year_12"
                      :ft="$ft" :sd="$student" readonly="readonl" />
                  </div>
                  <div class="col-md-4 col-sm-12 mb-3">
                    <x-input-field type="text" label="Result" name="result_12" id="result_12" :ft="$ft"
                      :sd="$student" readonly="readonl" />
                  </div>
                  <div class="col-md-4 col-sm-12 mb-3">
                    <label for="NEET" class="form-label">Grade</label>
                    <input type="text" class="form-control" id="NEET" placeholder="NEET" value="NEET"
                      disabled />
                  </div>
                  <div class="col-md-4 col-sm-12 mb-3">
                    <x-input-field type="text" label="Passing Year" name="neet_passing_year" id="neet_passing_year"
                      :ft="$ft" :sd="$student" readonly="readonl" />
                  </div>
                  <div class="col-md-4 col-sm-12 mb-3">
                    <x-input-field type="text" label="Result" name="neet_result" id="neet_result"
                      :ft="$ft" :sd="$student" readonly="readonl" />
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 mb-3">
                    <h5 class="d-flex align-items-center main-docs">
                      Document :
                      <p class="text-danger main-onlys ">
                        Only jpg, jpeg, png and pdf files are allowed. File size should not exceed 1MB.
                      </p>
                    </h5>
                    <hr>
                    <table class="table table-bordered">
                      <tr>
                        <th>10th Marksheet</th>
                        <td>
                          @if ($student->marksheet_10_path != null)
                            <a href="{{ asset($student->marksheet_10_path) }}" target="_blank"
                              class="btn btn-xs btn-info btn-link">View</a>
                          @else
                            <label for="marksheet_10_copy" class="form-label text-danger">No file uploaded</label>
                          @endif
                        </td>
                        <td>
                          <input type="file" class="form-control" id="marksheet_10_copy" name="marksheet_10_copy"
                            value="{{ old('marksheet_10_copy') }}">

                          @error('marksheet_10_copy')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </td>
                        <th>12th Marksheet</th>
                        <td>
                          @if ($student->marksheet_12_path != null)
                            <a href="{{ asset($student->marksheet_12_path) }}" target="_blank"
                              class="btn btn-xs btn-info btn-link">View</a>
                          @else
                            <label for="marksheet_12_copy" class="form-label text-danger">No file uploaded</label>
                          @endif
                        </td>
                        <td>
                          <input type="file" class="form-control" id="marksheet_12_copy" name="marksheet_12_copy"
                            value="{{ old('marksheet_12_copy') }}">

                          @error('marksheet_12_copy')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </td>
                      </tr>
                      <tr>
                        <th>NEET Result</th>
                        <td>
                          @if ($student->neet_result_path != null)
                            <a href="{{ asset($student->neet_result_path) }}" target="_blank"
                              class="btn btn-xs btn-info btn-link">View</a>
                          @else
                            <label for="neet_result_copy" class="form-label text-danger">No file uploaded</label>
                          @endif
                        </td>
                        <td>
                          <input type="file" class="form-control" id="neet_result_copy" name="neet_result_copy"
                            value="{{ old('neet_result_copy') }}">

                          @error('neet_result_copy')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </td>
                        <th>Passport Photocopy</th>
                        <td>
                          @if ($student->passport_path != null)
                            <a href="{{ asset($student->passport_path) }}" target="_blank"
                              class="btn btn-xs btn-info btn-link">View</a>
                          @else
                            <label for="passport_copy" class="form-label text-danger">No file uploaded</label>
                          @endif
                        </td>
                        <td>
                          <input type="file" class="form-control" id="passport_copy" name="passport_copy"
                            value="{{ old('passport_copy') }}">

                          @error('passport_copy')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </td>
                      </tr>
                      <tr>
                        <th>Aadhar</th>
                        <td>
                          @if ($student->aadhar_path != null)
                            <a href="{{ asset($student->aadhar_path) }}" target="_blank"
                              class="btn btn-xs btn-info btn-link">View</a>
                          @else
                            <label for="aadhar_copy" class="form-label text-danger">No file uploaded</label>
                          @endif
                        </td>
                        <td>
                          <input type="file" class="form-control" id="aadhar_copy" name="aadhar_copy"
                            value="{{ old('aadhar_copy') }}">

                          @error('aadhar_copy')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </td>
                        <th>Passport Size Photo</th>
                        <td>
                          @if ($student->photo_path != null)
                            <a href="{{ asset($student->photo_path) }}" target="_blank"
                              class="btn btn-xs btn-info btn-link">View</a>
                          @else
                            <label for="photo_copy" class="form-label text-danger">No file uploaded</label>
                          @endif
                        </td>
                        <td>
                          <input type="file" class="form-control" id="photo_copy" name="photo_copy"
                            value="{{ old('photo_copy') }}">

                          @error('photo_copy')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="row hide-this">
                  <div class="col-12 mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                      <h5 class="mt-4">Scholarship Details </h5>
                    </div>
                    <hr>
                  </div>
                  <div class="col-md-4 col-sm-12 mb-3">
                    <label for="scholarship" class="form-label">Select Scholarship</label>
                    <select class="form-control" id="scholarship" name="scholarship"
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
                    <select class="form-control" id="course_category" name="course_category"
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
                <button class="btn btn-sm btn-primary" type="submit">Update</button>
              </form>
            </div>
          </div>
          <!-- end card -->
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $('#scholarship').on('change', function() {
      var scholarshipId = $('#scholarship').val();
      if (scholarshipId) {
        $.ajax({
          url: "{{ url('common/get-course-categories') }}/" + scholarshipId,
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
