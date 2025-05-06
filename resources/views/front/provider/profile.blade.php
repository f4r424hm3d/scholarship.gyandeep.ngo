@php
  if ($provider->logo_path == null) {
      $avatar = 'front/avatars/logo.png';
  } else {
      $avatar = $provider->logo_path;
  }
@endphp
@extends('front.layouts.main')
@push('title')
  <title>Provider Profile - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>
    <div class="container-fluid margin_60_35">
      <div class="row">

        @include('front.provider.profile-sidebar')

        <div class="col-xl-10 col-lg-10">
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
            <div id="detail-title" style="padding-left:15px"><i class="icon-info-circled"></i> Basic Information
            </div>
            <div class="box_general_3">
              <div class="row">
                <h5>Account Holder Information</h5>
                <hr>
                <div class="col-md-6 mb-2">
                  <i class="icon-user-1"></i> <strong>Name :</strong> {{ $provider->name }}
                </div>

                <div class="col-md-6 mb-2">
                  <i class="icon-phone-outline"></i> <strong>Contact number :</strong>
                  +{{ $provider->c_code }} {{ $provider->mobile }}
                </div>

                <div class="col-md-6">
                  <i class="icon-gmail"></i> <strong>Email :</strong> {{ $provider->email }} <i class="icon-ok"
                    style="color: green" title="Verified"></i>
                </div>

                <div class="col-md-6 mb-2">
                  <i class="icon-user-1"></i> <strong>Gender :</strong> {{ $provider->gender }}
                </div>

                <div class="col-md-6 mb-2">
                  <i class="icon-calendar"></i> <strong>DOB :</strong> {{ $provider->dob }}
                </div>

                <div class="col-md-6 mb-2">
                  <i class="icon-flag"></i> <strong>Nationality :</strong> {{ $provider->nationality }}
                </div>
              </div>
              <hr>
              <div class="row">
                <h5>Provider Information</h5>
                <hr>
                <div class="col-md-6 mb-2">
                  <i class="icon-user-1"></i> <strong>Povider Name :</strong> {{ $provider->provider_name }}
                </div>

                <div class="col-md-6 mb-2">
                  <i class=" icon-info-circled-1"></i> <strong>Address :</strong> {{ $provider->address }}
                </div>

                <div class="col-md-6">
                  <i class="icon-info-circled-1"></i> <strong>City :</strong> {{ $provider->city }}
                </div>

                <div class="col-md-6 mb-2">
                  <i class=" icon-info-circled-1"></i> <strong>State :</strong> {{ $provider->state }}
                </div>

                <div class="col-md-6 mb-2">
                  <i class=" icon-info-circled-1"></i> <strong>Country :</strong> {{ $provider->country }}
                </div>

                <div class="col-md-6 mb-2">
                  <i class=" icon-info-circled-1"></i> <strong>Global Rank :</strong> {{ $provider->global_rank }}
                </div>

                <div class="col-md-6 mb-2">
                  <i class=" icon-info-circled-1"></i> <strong>Acceptance Rate :</strong>
                  {{ $provider->acceptance_rate }}
                </div>

                <div class="col-md-6 mb-2">
                  <i class=" icon-info-circled-1"></i> <strong>Established :</strong> {{ $provider->established }}
                </div>

              </div>
              <div class="row">
                <div class="offset-8 col-md-4">
                  <div class="float-end">
                    <a href="{{ url('provider/profile/edit') }}" class="btn_1 mb-1">Edit Profile</a>
                  </div>
                </div>
              </div>
              <hr>
              <form action="{{ url('provider/profile/update-logo') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-4">
                    <img height="200" width="150" src="{{ url($avatar) }}" class="">
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Upload Logo</label>
                      <input name="logo" type="file" class="form-control" placeholder="Upload logo" required>
                      <span class="text-danger">
                        @error('logo')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <button type="submit" class="btn_1 mb-1">Change Logo</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </main>
@endsection
