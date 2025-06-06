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
    <section class="main-profile py-5">
      <div class="container-fluid px-sm-5">
      <div class="row">

        @include('front.student.profile-sidebar')

        <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 mb-4">
          <div style="clear:both"></div>
          <div class="pb-2">
            <div id="detail-title" style="padding-left:15px"><i class="icon-info-circled"></i> Reset Password</div>
            <div class="box_general_3">
              <form action="{{ url('profile/change-password') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $student->id }}">
                <div class="row">
                  {{-- <div class="col-md-6">
                    <div class="form-group">
                      <label>Enter Old Password</label>
                      <input name="old_password" type="password" class="form-control" placeholder="Enter Current Password"
                        required>
                      <span class="text-danger">
                        @error('old_password')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div> --}}

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Enter New Password</label>
                      <input name="new_password" type="password" class="form-control" placeholder="Enter New Password"
                        required>
                      <span class="text-danger">
                        @error('new_password')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Confirm New Password</label>
                      <input name="confirm_new_password" type="password" class="form-control"
                        placeholder="Confirm New Password" required>
                      <span class="text-danger">
                        @error('confirm_new_password')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-12 text-end">
                  <input type="submit" class="btn_1 medium" value="Save"> &nbsp; &nbsp;<a href="{{ url('profile') }}"
                    class="medium">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-lg-3">
          <div class="pb-2">
            <div class="box_general_3 text-center"></div>
          </div>
        </div>

      </div>
    </div>
    </section>
  </main>
@endsection
