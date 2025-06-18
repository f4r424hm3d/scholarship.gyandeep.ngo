@php
  //printArray($country->toArray());
@endphp
@extends('admin.layouts.main')
@push('title')
  <title>Add Student</title>
@endpush
@section('main-section')
  <div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <div class="d-inline-block align-items-center">
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/admin/') }}"><i class="mdi mdi-home-outline"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add Student</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <!-- Main content -->
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
          <div class="col-lg-12 col-md-12 col-12">
            <div class="box">
              <div class="box-body">
                <h4 class="box-title text-info"> Upload File</h4>
                <hr class="my-15">
                <form method="post" action="{{ url('admin/student/import') }}" id="import_csv"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="form-group col-md-4">
                      <label>Select CSV File</label>
                      <input type="file" name="file" id="file" required class="form-control mb-2 mr-sm-2" />
                    </div>
                    <div class="form-group col-md-4">
                      <label>&nbsp;&nbsp;</label>
                      <button style="margin-top:28px" type="submit" name="import_csv" class="btn btn-info"
                        id="import_csv_btn">Import</button>
                      <a download href="{{ asset('format/students.xlsx') }}" style="margin-top:28px"
                        class="btn btn-primary">Formate</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-12">
            <div class="box">
              <div class="box-body">
                <h4 class="box-title text-info">{{ $title }} Record</h4>
                <hr class="my-15">
                <form action="{{ $url }}" method="post" class="form" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label>Student Name</label>
                      <input name="name" type="text" class="form-control" placeholder="Enter name"
                        value="{{ $ft == 'edit' ? $sd->name : old('name') }}">
                      <span class="text-danger">
                        @error('name')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Email</label>
                      <input name="email" type="text" class="form-control" placeholder="Enter email"
                        value="{{ $ft == 'edit' ? $sd->email : old('email') }}">
                      <span class="text-danger">
                        @error('email')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group col-md-1">
                      <label>Code</label>
                      <input name="c_code" type="number" class="form-control" placeholder="Enter Country Code"
                        value="{{ $ft == 'edit' ? $sd->c_code : old('c_code') }}">
                      <span class="text-danger">
                        @error('c_code')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Mobile</label>
                      <input name="mobile" type="number" class="form-control" placeholder="Enter Mobile"
                        value="{{ $ft == 'edit' ? $sd->mobile : old('mobile') }}">
                      <span class="text-danger">
                        @error('mobile')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group col-md-2">
                      <label>Gender</label>
                      <select name="gender" id="gender" type="text" class="form-control select2"
                        data-placeholder="Select Country">
                        <option value="">Select</option>
                        @php
                          $genders = ['Male', 'Female', 'Other'];
                        @endphp
                        @foreach ($genders as $gender)
                          <option value="{{ $gender }}"
                            {{ $ft == 'edit' && $sd->gender == $gender ? 'Selected' : '' }}>
                            {{ $gender }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('gender')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group col-md-2">
                      <label>Nationality</label>
                      <select name="nationality" id="nationality" class="form-control select2">
                        <option value="">Select</option>
                        @foreach ($country as $row)
                          <option value="{{ $row->name }}"
                            {{ $ft == 'edit' && $sd->nationality == $row->name ? 'Selected' : '' }}>
                            {{ $row->name }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('nationality')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group col-md-2">
                      <label>Source</label>
                      <input name="source" type="text" class="form-control" placeholder="Enter Source"
                        value="{{ $ft == 'edit' ? $sd->source : old('source') }}">
                      <span class="text-danger">
                        @error('source')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group col-md-2">
                      <label>D.O.B</label>
                      <input name="dob" type="date" class="form-control" placeholder="Enter Mobile"
                        value="{{ $ft == 'edit' ? $sd->dob : old('dob') }}">
                      <span class="text-danger">
                        @error('dob')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Current Level</label>
                      <select name="current_qualification_level" id="current_qualification_level"
                        class="form-control select2">
                        <option value="">Select</option>
                        @foreach ($levels as $row)
                          <option value="{{ $row->id }}"
                            {{ $ft == 'edit' && $sd->current_qualification_level == $row->id ? 'Selected' : '' }}>
                            {{ $row->name }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('current_qualification_level')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Intrested Course</label>
                      <select name="intrested_course_category" id="intrested_course_category"
                        class="form-control select2">
                        <option value="">Select</option>
                        @foreach ($cc as $row)
                          <option value="{{ $row->id }}"
                            {{ $ft == 'edit' && $sd->intrested_course_category == $row->id ? 'Selected' : '' }}>
                            {{ $row->category }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('intrested_course_category')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Address</label>
                      <input name="address" type="text" class="form-control" placeholder="Enter address"
                        value="{{ $ft == 'edit' ? $sd->address : old('address') }}">
                      <span class="text-danger">
                        @error('address')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group col-md-2">
                      <label>city</label>
                      <input name="city" type="text" class="form-control" placeholder="Enter city"
                        value="{{ $ft == 'edit' ? $sd->city : old('city') }}">
                      <span class="text-danger">
                        @error('city')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group col-md-2">
                      <label>state</label>
                      <input name="state" type="text" class="form-control" placeholder="Enter state"
                        value="{{ $ft == 'edit' ? $sd->state : old('state') }}">
                      <span class="text-danger">
                        @error('state')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group col-md-2">
                      <label>Country</label>
                      <select name="country" id="country" class="form-control select2">
                        <option value="">Select</option>
                        @foreach ($country as $row)
                          <option value="{{ $row->name }}"
                            {{ $ft == 'edit' && $sd->country == $row->name ? 'Selected' : '' }}>
                            {{ $row->name }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('country')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="row">
                    <div class="form-group col-md-3 col-sm-12">
                      @if ($ft == 'add')
                        <button type="reset" class="btn btn-sm btn-warning mr-1">
                          <i class="ti-trash"></i> Reset
                        </button>
                      @endif
                      @if ($ft == 'edit')
                        <a href="{{ url('admin/levels') }}" class="btn btn-sm btn-primary">
                          <i class="ti-trash"></i> Cancel
                        </a>
                      @endif
                      <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
@endsection
