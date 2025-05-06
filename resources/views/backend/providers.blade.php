@php
use App\Models\ProviderType;
use App\Models\Country;
@endphp
@extends('backend.layouts.main')
@push('title')
  <title>Providers</title>
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
                  <li class="breadcrumb-item active" aria-current="page">Providers</li>
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
              <form action="{{ $url }}" method="post" class="form" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                  <h4 class="box-title text-info"> {{ $title }} Record</h4>
                  <hr class="my-15">
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Provider Type</label>
                        <select name="provider_type_id" type="text" class="form-control select2" required>
                          <option value="">Select</option>
                          @foreach ($pt as $c)
                            <option value="{{ $c->id }}"
                              {{ $ft == 'edit' && $sd->provider_type_id == $c->id ? 'Selected' : '' }}>
                              {{ $c->provider_type }}</option>
                          @endforeach
                        </select>
                        <span class="text-danger">
                          @error('provider_type_id')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Enter Provider Name</label>
                        <input name="provider_name" type="text" class="form-control" placeholder="provider Name"
                          value="{{ $ft == 'edit' ? $sd->provider_name : old('provider_name') }}" required>
                        <span class="text-danger">
                          @error('provider_name')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Upload Logo</label>
                        <input name="logo" type="file" class="form-control" placeholder="Upload logo">
                        <span class="text-danger">
                          @error('logo')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Global Rank</label>
                        <input name="global_rank" type="number" class="form-control" placeholder="Enter global_rank"
                          value="{{ $ft == 'edit' ? $sd->global_rank : old('global_rank') }}">
                        <span class="text-danger">
                          @error('global_rank')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>acceptance Rate</label>
                        <input name="acceptance_rate" type="text" class="form-control"
                          placeholder="Enter acceptance Rate"
                          value="{{ $ft == 'edit' ? $sd->acceptance_rate : old('acceptance_rate') }}">
                        <span class="text-danger">
                          @error('acceptance_rate')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>University Type</label>
                        <input name="university_type" type="text" class="form-control"
                          placeholder="Enter university type"
                          value="{{ $ft == 'edit' ? $sd->university_type : old('university_type') }}">
                        <span class="text-danger">
                          @error('university_type')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Established Year</label>
                        <input name="established" type="text" class="form-control" placeholder="Enter Established Year"
                          value="{{ $ft == 'edit' ? $sd->established : old('established') }}">
                        <span class="text-danger">
                          @error('established')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Official Website</label>
                        <input name="website" type="url" class="form-control" placeholder="Enter website"
                          value="{{ $ft == 'edit' ? $sd->website : old('website') }}">
                        <span class="text-danger">
                          @error('website')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Address</label>
                        <input name="address" type="text" class="form-control" placeholder="Enter address"
                          value="{{ $ft == 'edit' ? $sd->address : old('address') }}">
                        <span class="text-danger">
                          @error('address')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>city</label>
                        <input name="city" type="text" class="form-control" placeholder="Enter city"
                          value="{{ $ft == 'edit' ? $sd->city : old('city') }}">
                        <span class="text-danger">
                          @error('city')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>state</label>
                        <input name="state" type="text" class="form-control" placeholder="Enter state"
                          value="{{ $ft == 'edit' ? $sd->state : old('state') }}">
                        <span class="text-danger">
                          @error('state')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Country</label>
                        <select name="country" id="country" type="text" class="form-control select2"
                          data-placeholder="Select Country" required>
                          <option value="">Select</option>
                          @php
                            $pt = Country::all();
                          @endphp
                          @foreach ($pt as $c)
                            <option value="{{ $c->id }}"
                              {{ $ft == 'edit' && $sd->country == $c->id ? 'Selected' : '' }}>
                              {{ $c->name }}</option>
                          @endforeach
                        </select>
                        <span class="text-danger">
                          @error('country')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Enter description Year">{{ $ft == 'edit' ? $sd->description : old('description') }}</textarea>
                        <span class="text-danger">
                          @error('description')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  @if ($ft == 'add')
                    <button type="reset" class="btn btn-rounded btn-warning btn-outline mr-1">
                      <i class="ti-trash"></i> Reset
                    </button>
                  @endif
                  @if ($ft == 'edit')
                    <a href="{{ url('admin/levels') }}" class="btn btn-rounded btn-primary btn-outline">
                      <i class="ti-trash"></i> Cancel
                    </a>
                  @endif
                  <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                    <i class="ti-save-alt"></i> Save
                  </button>
                </div>
              </form>
            </div>
          </div>
          {{-- {{ printArray($dep) }} --}}
          <div class="col-lg-12 col-md-12 col-12">
            <div class="box">
              <div class="box-header">
                <h4 class="box-title">Providers List</h4>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr. No.</th>
                        <th>Provider Type</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>University Type</th>
                        <th>Global Rank</th>
                        <th>Acceptance Rate</th>
                        <th>Established Year</th>
                        <th>Website</th>
                        <th>Description</th>
                        <th>Logo</th>
                        <th>Gallery</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $i = 1;
                      @endphp
                      @foreach ($rows as $row)
                        <tr id="row{{ $row->id }}">
                          <td>{{ $i }}</td>
                          <td>{{ $row->getProviderType->provider_type }}</td>
                          <td>{{ $row->provider_name }}</td>
                          <td>
                            {{ $row->address }}<br>
                            {{ $row->city }}<br>
                            {{ $row->state }}<br>
                            {{ $row->getCountry->name ?? '' }}
                          </td>
                          <td>{{ $row->university_type }}</td>
                          <td>{{ $row->global_rank }}</td>
                          <td>{{ $row->acceptance_rate }}</td>
                          <td>{{ $row->established }}</td>
                          <td><a target="_blank" href="{{ $row->website }}">Website</a></td>
                          <td>
                            @if ($row->description != '')
                              <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                title="Click to view" data-target="#description<?php echo $row->id; ?>">
                                view
                              </button>
                              <div class="modal" id="description<?php echo $row->id; ?>" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Description</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body m-3">
                                      <p class="mb-0"><?php echo $row->description; ?></p>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>

                                    </div>
                                  </div>
                                </div>
                              </div>
                            @else
                              Not available
                            @endif
                          </td>
                          <td>
                            @if ($row->logo_path != '')
                              <a href="{{ asset($row->logo_path) }}" alt="{{ $row->provider_name }}"
                                target="_blank">
                                <img src="{{ asset($row->logo_path) }}" alt="{{ $row->provider_name }}"
                                  height="50" width="50">
                              </a>
                            @else
                              No file uploaded
                            @endif
                          </td>
                          <td>
                            <a target="_blank" href="{{ url('admin/provider-photo/' . $row->id) }}"
                              class="waves-effect waves-light btn btn-sm btn-outline btn-info">Photo</a>
                            <br>
                            <a target="_blank" href="{{ url('admin/provider-video/' . $row->id) }}"
                              class="waves-effect waves-light btn btn-sm btn-outline btn-info">Video</a>
                          </td>
                          <td id="statustd{{ $row->id }}">
                            <span id="asts{{ $row->id }}"
                              class="badge badge-success {{ $row->status == 1 ? '' : 'hide-this' }}"
                              onclick="changeStatus('{{ $row->id }}','0')">Active</span>
                            <span id="ists{{ $row->id }}"
                              class="badge badge-danger {{ $row->status == 0 ? '' : 'hide-this' }}"
                              onclick="changeStatus('{{ $row->id }}','1')">Inactive</span>
                          </td>
                          <td>
                            <a href="javascript:void()" onclick="DeleteAjax('{{ $row->id }}')"
                              class="waves-effect waves-light btn btn-sm btn-outline btn-danger">
                              <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('admin/providers/update/' . $row->id) }}"
                              class="waves-effect waves-light btn btn-sm btn-outline btn-info">
                              <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                            <a target="_blank" href="{{ url('admin/provider-faq/' . $row->id) }}"
                              class="waves-effect waves-light btn btn-sm btn-outline btn-info">Faqs</a>
                          </td>
                        </tr>
                        @php
                          $i++;
                        @endphp
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <script>
    CKEDITOR.replace('description');

    function changeStatus(id, val) {
      //alert(id);
      var tbl = 'providers';
      $.ajax({
        url: "{{ url('common/change-status') }}",
        method: "GET",
        data: {
          id: id,
          tbl: tbl,
          val: val
        },
        success: function(data) {
          if (data == '1') {
            //alert('status changed of ' + id + ' to ' + val);
            if (val == '1') {
              $('#asts' + id).toggle();
              $('#ists' + id).toggle();
            }
            if (val == '0') {
              $('#asts' + id).toggle();
              $('#ists' + id).toggle();
            }
          }
        }
      });

    }

    function DeleteAjax(id) {
      //alert(id);
      var cd = confirm("Are you sure ?");
      if (cd == true) {
        $.ajax({
          url: "{{ url('admin/pr/delete') }}" + "/" + id,
          success: function(data) {
            if (data == '1') {
              $('#row' + id).remove();
              var h = 'Success';
              var msg = 'Record deleted successfully';
              var type = 'success';
              showToastr(h, msg, type);
            }
          }
        });
      }
    }

    function showToastr(h, msg, type) {
      $.toast({
        heading: h,
        text: msg,
        position: 'top-right',
        loaderBg: '#ff6849',
        icon: type,
        hideAfter: 3000,
        stack: 6
      });
    }
  </script>
@endsection
