@extends('front.layouts.main')
@push('title')
  <title>Profile - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>

    <section class="main-profile  pt-5 px-0 px-sm-4 px-md-5" >
      <div class="container-fluid">
      <div class="row">

        @include('front.student.profile-sidebar')

        <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 mb-4">
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
          <div class="pb-2">
            <div id="detail-title" style="padding-left:15px"><i class="icon-info-circled"></i> Basic Information</div>
            <div class="box_general_3">
              <div class="row">
                <div class="col-md-6 mb-4">
                  <i class="icon-user-1 name-icon "></i> <strong>Gender :</strong>
                  {{ $student->gender }}
                </div>
                <div class="col-md-6 mb-4">
                  <i class="icon-calendar name-icon"></i> <strong>DOB :</strong> {{ $student->dob }}
                </div>
                <div class="col-md-6 mb-4">
                  <i class="icon-flag name-icon"></i> <strong>Nationality :</strong>
                  {{ $student->nationality }}
                </div>
                <div class="col-md-6 mb-4">
                  <i class="icon-location-outline name-icon"></i> <strong>Current location :</strong>
                  {{ $student->city }} , {{ $student->state }} , {{ $student->country }}
                </div>
                <div class="col-md-6 mb-4">
                  <i class="fa fa-phone name-icon"></i> <strong>Contact number :</strong>
                  +{{ $student->c_code }} {{ $student->mobile }}
                </div>
                <div class="col-md-6">
                  <i class="icon-gmail name-icon"></i> <strong>Email :</strong>
                  {{ $student->email }}
                </div>
              </div>
              <div class="row">
                <div class="offset-8 col-md-4">

                  <div class="float-end">
                    <a href="{{ url('profile/edit') }}" class="btn_1 mb-1">Edit Profile</a>
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
