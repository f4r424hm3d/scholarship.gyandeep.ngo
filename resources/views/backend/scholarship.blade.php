@php
use App\Models\ProviderType;
use App\Models\Provider;
use App\Models\Country;
use App\Models\CourseCategory;
use App\Models\Specialization;
use App\Models\Level;
@endphp
@extends('backend.layouts.main')
@push('title')
  <title>Scholarships</title>
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
                  <li class="breadcrumb-item active" aria-current="page">Scholarship</li>
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
                    <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                        <label>Scholarship Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Enter scholarship Name"
                          value="{{ $ft == 'edit' ? $sd->name : old('name') }}" required>
                        <span class="text-danger">
                          @error('name')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                      <div class="form-group">
                        <label>Deadline</label>
                        <input name="deadline" type="date" class="form-control" placeholder="Enter Deadline"
                          value="{{ $ft == 'edit' ? $sd->deadline : old('deadline') }}" required>
                        <span class="text-danger">
                          @error('deadline')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                      <div class="form-group">
                        <label>What it covers</label>
                        <select name="covers" type="text" class="form-control select2" required>
                          <option value="">Select</option>
                          <option value="full-funding"
                            {{ $ft == 'edit' && $sd->covers == 'full-funding' ? 'Selected' : '' }}>Full Funding
                          </option>
                          <option value="partial-funding"
                            {{ $ft == 'edit' && $sd->covers == 'partial-funding' ? 'Selected' : '' }}>Partial Funding
                          </option>
                          <option value="only-tution-fees"
                            {{ $ft == 'edit' && $sd->covers == 'only-tution-fees' ? 'Selected' : '' }}>Only Tution Fees
                          </option>
                        </select>
                        <span class="text-danger">
                          @error('covers')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                        <label>Covers Notes</label>
                        <input name="covers_notes" type="text" class="form-control" placeholder="Enter Deadline"
                          value="{{ $ft == 'edit' ? $sd->covers_notes : old('covers_notes') }}">
                        <span class="text-danger">
                          @error('covers_notes')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                      <div class="form-group">
                        <label>Eligibility Note</label>
                        <input name="eligibility" type="text" class="form-control" placeholder="Enter eligibility"
                          value="{{ $ft == 'edit' ? $sd->eligibility : old('eligibility') }}" required>
                        <span class="text-danger">
                          @error('eligibility')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                      <div class="form-group">
                        <label>Provider Type</label>
                        <select name="provider_type_id" id="provider_type_id" type="text" class="form-control select2"
                          required>
                          <option value="">Select</option>
                          @php
                            $pt = ProviderType::all();
                          @endphp
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
                    <div class="col-md-3 col-sm-12">
                      <div class="form-group">
                        <label>Provider</label>
                        <select name="provider" id="provider" type="text" class="form-control select2" required>
                          <option value="">Select</option>
                          @if ($ft == 'edit')
                            @php
                              $prv = Provider::where('provider_type_id', $sd->provider_type_id)->get();
                            @endphp
                            @foreach ($prv as $prv)
                              <option value="{{ $prv->id }}" {{ $sd->provider_id == $prv->id ? 'Selected' : '' }}>
                                {{ $prv->provider_name }}</option>
                            @endforeach
                          @endif
                        </select>
                        <span class="text-danger">
                          @error('provider')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                      <div class="form-group">
                        <label>Exam Type</label>
                        <select onchange="changeExamType(this.value)" name="exam_type" id="exam_type" type="text"
                          class="form-control select2" required>
                          <option value="">Select</option>
                          <option value="Paid" {{ $ft == 'edit' && $sd->exam_type == 'Paid' ? 'Selected' : '' }}>
                            Paid</option>
                          <option value="Free" {{ $ft == 'edit' && $sd->exam_type == 'Free' ? 'Selected' : '' }}>
                            Free</option>
                        </select>
                        <span class="text-danger">
                          @error('exam_type')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                      <div class="form-group">
                        <label>Exam Fees</label>
                        <input name="exam_fees" id="exam_fees" type="number" class="form-control" min="0"
                          value="{{ $ft == 'edit' ? $sd->exam_fees : old('exam_fees') }}" required>
                        <span class="text-danger">
                          @error('exam_fees')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="form-group col-md-12">
                      <label class="form-label" for="description">Description</label>
                      <textarea class="form-control mb-2 mr-sm-2" id="description" name="description" placeholder="Enter description">{{ $ft == 'edit' ? $sd->description : old('description') }}</textarea>
                    </div>
                    <div class="form-group col-md-12">
                      <label class="form-label" for="instruction">Instruction</label>
                      <textarea class="form-control mb-2 mr-sm-2" id="instruction" name="instruction" placeholder="Enter instruction">{{ $ft == 'edit' ? $sd->instruction : old('instruction') }}</textarea>
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
                        <th>Name</th>
                        <th>Eligibility</th>
                        <th>Deadline</th>
                        <th>Covers</th>
                        <th>Provider</th>
                        <th>Exam Type</th>
                        <th>Description</th>
                        <th>Instruction</th>
                        <th>Eligibilities</th>
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
                          <td>{{ $row->name }}</td>
                          <td>{{ $row->eligibility }}</td>
                          <td>{{ getFormattedDate($row->deadline, 'd-M-Y') }}</td>
                          <td>{{ $row->covers }} {{ $row->covers_note != '' ? '(' . $row->covers_note . ')' : '' }}
                          </td>
                          <td>{{ $row->getProvider->provider_name }}</td>
                          <td>

                            <span
                              class="badge badge-{{ $row->exam_type == 'Paid' ? 'success' : 'primary' }}">{{ $row->exam_type }}</span><br>
                            Amount : {{ $row->exam_fees }}

                          </td>
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
                            @if ($row->instruction != '')
                              <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                title="Click to view" data-target="#instruction<?php echo $row->id; ?>">
                                view
                              </button>
                              <div class="modal" id="instruction<?php echo $row->id; ?>" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Instruction</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body m-3">
                                      <p class="mb-0"><?php echo $row->instruction; ?></p>
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
                            <a href="{{ url('admin/scholarship/level/' . $row->id) }}"
                              class="waves-effect waves-light btn btn-sm btn-outline btn-info">
                              Levels
                            </a>
                            <br>
                            <a href="{{ url('admin/scholarship/subject/' . $row->id) }}"
                              class="waves-effect waves-light btn btn-sm btn-outline btn-info">
                              Specialization
                            </a>
                            <br>
                            <a href="{{ url('admin/scholarship/eligibility/' . $row->id) }}"
                              class="waves-effect waves-light btn btn-sm btn-outline btn-info">
                              Country
                            </a>
                            <br>
                            <a href="{{ url('admin/scholarship/custom-eligibility/' . $row->id) }}"
                              class="waves-effect waves-light btn btn-sm btn-outline btn-info">
                              Custom Eligibility
                            </a>
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
                            <a href="{{ url('admin/scholarship/update/' . $row->id) }}"
                              class="waves-effect waves-light btn btn-sm btn-outline btn-info">
                              <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
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
    function changeStatus(id, val) {
      //alert(id);
      var tbl = 'scholarships';
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

    function changeExamType(exam_type) {
      if (exam_type == 'Paid') {
        $('#exam_fees').val('');
        $('#exam_fees').attr('required', true);
        $('#exam_fees').attr('min', '1', true);
      }
      if (exam_type == 'Free') {
        $('#exam_fees').val('0');
        $('#exam_fees').attr('required', false);
      }
    }
    CKEDITOR.replace('description');
    CKEDITOR.replace('instruction');

    $(document).ready(function() {
      $('#provider_type_id').change(function() {
        var provider_type = $('#provider_type_id').val();
        alert(provider_type);
        if (provider_type != '') {
          $.ajax({
            url: "{{ url('admin/get-provider') }}",
            method: "get",
            data: {
              id: provider_type
            },
            success: function(data) {
              //alert(data);
              $('#provider').html(data);
            }
          });
        }
      });
    });

    function fcehck(id) {
      //alert(id);
      if (id != '') {
        $.ajax({
          url: "{{ url('admin/get-provider') }}" + "/" + id,
          success: function(data) {
            //alert(data);
            $('#provider').html(data);
          }
        });
      }
    }

    function DeleteAjax(id) {
      //alert(id);
      var cd = confirm("Are you sure ?");
      if (cd == true) {
        $.ajax({
          url: "{{ url('admin/scholarship/delete') }}" + "/" + id,
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
