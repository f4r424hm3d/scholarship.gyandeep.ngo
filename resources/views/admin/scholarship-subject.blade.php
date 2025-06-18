@php
  use App\Models\CourseCategory;
  use App\Models\Specialization;
@endphp
@extends('admin.layouts.main')
@push('title')
  <title>Scholarship Levels</title>
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
                  <li class="breadcrumb-item"><a href="{{ url('/admin/scholarship') }}">Scholarship</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Scholarship Subject
                    ({{ $sch->name }})</li>
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
                <input type="hidden" name="scholarship_id" value="{{ $sch->id }}">
                <div class="box-body">
                  <h4 class="box-title text-info"> {{ $title }} Record</h4>
                  <hr class="my-15">
                  <div class="row">
                    <div class="col-md-3 col-sm-12">
                      <div class="form-group">
                        <label>Course Category</label>
                        <select name="course_id" id="course_id" type="text" class="form-control select2" required>
                          <option value="">Select Course Category</option>
                          @php
                            $pt = CourseCategory::all();
                          @endphp
                          @foreach ($pt as $c)
                            <option value="{{ $c->id }}"
                              {{ $ft == 'edit' && $sd->course_id == $c->id ? 'Selected' : '' }}>
                              {{ $c->category }}</option>
                          @endforeach
                        </select>
                        <span class="text-danger">
                          @error('course_id')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-9 col-sm-12">
                      <div class="form-group">
                        <label>Specialization</label>
                        @if ($ft == 'edit')
                          <select name="spc_id" id="spc_id" class="form-control select2" required>
                            <option value="">Select Specialization</option>
                            @php
                              $spc = Specialization::where('category_id', $sd->spc_id)->get();
                            @endphp
                            @foreach ($spc as $spc)
                              <option value="{{ $spc->id }}"
                                {{ $ft == 'edit' && $sd->spc_id == $spc->id ? 'Selected' : '' }}>
                                {{ $spc->specialization }}</option>
                            @endforeach
                          </select>
                        @else
                          <select name="spc_id{{ $ft == 'edit' ? '' : '[]' }}" id="spc_id"
                            class="form-control select2" {{ $ft == 'edit' ? '' : 'multiple' }}
                            data-placeholder="Select Specialization" required>
                          </select>
                        @endif
                        <span class="text-danger">
                          @error('spc_id')
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
                <h4 class="box-title">Scholarship Subject List</h4>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr. No.</th>
                        <th>Course Category</th>
                        <th>Specialization</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $i = 1;
                      @endphp
                      @foreach ($rows as $row)
                        @php
                          $fpt = CourseCategory::find($row->course_id);
                          $sspc = Specialization::find($row->spc_id);
                        @endphp
                        <tr id="row{{ $row->id }}">
                          <td>{{ $i }}</td>
                          <td>{{ $fpt->category }}</td>
                          <td>{{ $sspc->specialization }}</td>
                          <td>
                            <a href="javascript:void()" onclick="DeleteAjax('{{ $row->id }}')"
                              class="waves-effect waves-light btn btn-sm btn-outline btn-danger">
                              <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('admin/scholarship/subject/' . $sch->id . '/update/' . $row->id) }}"
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#course_id').change(function() {
        var course_id = $('#course_id').val();
        //alert(course_id);
        if (course_id != '') {
          $.ajax({
            url: "{{ url('admin/get-spc-by-cat') }}",
            method: "get",
            data: {
              id: course_id
            },
            success: function(data) {
              //alert(data);
              $('#spc_id').html(data);
            }
          });
        }
      });
    });

    function DeleteAjax(id) {
      //alert(id);
      var cd = confirm("Are you sure ?");
      if (cd == true) {
        $.ajax({
          url: "{{ url('admin/scholarship/subject/delete') }}" + "/" + id,
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
