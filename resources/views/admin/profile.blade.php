@extends('admin.layouts.main')
@push('title')
  <title>Admin Profile - Gyandeep NGO</title>
@endpush
@section('main-section')
  <div class="content-wrapper">
    <div class="container-full">
      <div class="content-header">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <h3 class="page-title">Profile</h3>
          </div>
        </div>
      </div>

      <section class="content">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-12">
            @if (session()->has('smsg'))
              <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session()->get('smsg') }}
              </div>
            @endif
            @if (session()->has('emsg'))
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session()->get('emsg') }}
              </div>
            @endif
          </div>
          <div class="col-12 col-lg-5 col-xl-4">
            <div class="box box-widget widget-user">
              <div class="widget-user-header bg-black"
                style="background: url('{{ url('/backend/') }}/images/gallery/full/10.jpg') center center;">
                <h3 class="widget-user-username">{{ $profile->name }}</h3>
                <h6 class="widget-user-desc">{{ $profile->role }}</h6>
              </div>
              <div class="widget-user-image">
                <img class="rounded-circle" src="{{ url('/backend/') }}/images/user3-128x128.jpg" alt="User Avatar">
              </div>
            </div>
            <div class="box">
              <div class="box-body box-profile">
                <div class="row">
                  <div class="col-12">
                    <div>
                      <p>Email :<span class="text-gray pl-10">{{ $profile->email }}</span> </p>
                      <p>Username :<span class="text-gray pl-10">{{ $profile->username }}</span></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-7 col-xl-8">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li><a class="active" href="#activity" data-toggle="tab">Info</a></li>
              </ul>
              <div class="tab-content">
                <div style="float:right;" class="mb-3">
                  <a style="color:red" onclick="viewUpdate();" role="button" title="Edit" data-toggle="tooltip"
                    class="editbtn"><i class="align-middle" data-feather="edit-2"></i></a>
                </div>
                <div class="active tab-pane" id="settings">
                  <div class="box p-15">
                    <form id="validation-form" method="post" enctype="multipart/form-data"
                      action="{{ url('admin/update-profile') }}">
                      @csrf
                      <input type="hidden" name="id" value="{{ session()->get('adminLoggedIn')['user_id'] }}">
                      <div class="row">
                        <div class="form-group col-md-4">
                          <label class="form-label" for="name">Name</label>
                          <input type="text" class="form-control mb-2 mr-sm-2" id="name" name="name"
                            placeholder="Enter name" value="{{ old('name') == '' ? $profile->name : old('name') }}"
                            required readonly>
                          <span class="text-danger">
                            @error('name')
                              {{ $message }}
                            @enderror
                          </span>
                        </div>
                        <div class="form-group col-md-4">
                          <label class="form-label" for="username">Username</label>
                          <input type="text" class="form-control mb-2 mr-sm-2" id="username" name="username"
                            placeholder="Enter Username"
                            value="{{ old('username') == '' ? $profile->username : old('username') }}" required readonly>
                          <span class="text-danger">
                            @error('username')
                              {{ $message }}
                            @enderror
                          </span>
                        </div>
                        <div class="form-group col-md-4">
                          <label class="form-label" for="password">Password</label>
                          <input type="password" class="form-control mb-2 mr-sm-2" id="password" name="password"
                            placeholder="Enter Password"
                            value="{{ old('password') == '' ? $profile->password : old('password') }}" required readonly>
                          <span class="text-danger">
                            @error('password')
                              {{ $message }}
                            @enderror
                          </span>
                        </div>
                        <div class="form-group col-md-4">
                          <label class="form-label" for="email">Email</label>
                          <input type="email" class="form-control mb-2 mr-sm-2" id="email" name="email"
                            placeholder="Enter Password"
                            value="{{ old('email') == '' ? $profile->email : old('email') }}" required readonly>
                          <span class="text-danger">
                            @error('email')
                              {{ $message }}
                            @enderror
                          </span>
                        </div>

                        <div class="form-group col-md-12 updbtn" style="display:none">
                          <button type="submit" name="update" class="btn btn-primary mb-2">Update</button>
                        </div>
                        <div class="form-group col-md-12 editbtn">
                          <a style="color:#fff" onclick="viewUpdate();" role="button"
                            class="btn btn-primary mb-2">Edit</a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <script>
    function viewUpdate() {
      $('.updbtn').show();
      $('.editbtn').hide();
      $("#name,#email,#username,#password").removeAttr('readonly');
    }
  </script>
@endsection
