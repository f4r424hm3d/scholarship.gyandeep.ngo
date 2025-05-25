@extends('backend.layouts.main')
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
                <li class="breadcrumb-item"><a href="{{ url('/admin/') }}"><i class="mdi mdi-home-outline"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/students/') }}">Students</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      @include('backend.student-profile-header')
      <div class="row">
        <div class="col-xl-12">
          <!-- NOTIFICATION FIELD START -->
          <x-result-notification-field />
          <!-- NOTIFICATION FIELD END -->
        </div>
      </div>

      <div class="row">
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
      <div class="row hide-this">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Student Profile</h4>
            </div>
            <div class="card-body {{ $ft == 'edit' ? '' : 'hide-thi' }}" id="tblCDiv">
              <form action="{{ aurl('student/update') }}" class="needs-validation" method="post"
                enctype="multipart/form-data" novalidate>
                @csrf
                <div class="row">
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-input-field type="text" label="Name" name="name" id="name" :ft="$ft"
                      :sd="$student" readonly="readonly" />
                  </div>
                  <div class="col-md-3 col-sm-12 mb-3">
                    <x-input-field type="text" label="Email" name="email" id="email" :ft="$ft"
                      :sd="$student" readonly="readonly" />
                  </div>
                  <div class="col-md-1 col-sm-12 mb-3">
                    <x-input-field type="text" label="Code" name="c_code" id="c_code" :ft="$ft"
                      :sd="$student" readonly="readonly" />
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-input-field type="text" label="Contact" name="mobile" id="mobile" :ft="$ft"
                      :sd="$student" readonly="readonly" />
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-input-field type="text" label="Gender" name="gender" id="gender" :ft="$ft"
                      :sd="$student" readonly="readonly" />
                  </div>
                  <div class="col-md-2 col-sm-12 mb-3">
                    <x-input-field type="text" label="DOB" name="dob" id="dob" :ft="$ft"
                      :sd="$student" readonly="readonly" />
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
  <script></script>
@endsection
