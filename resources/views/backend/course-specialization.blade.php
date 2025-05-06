@extends('backend.layouts.main')
@push('title')
  <title>Course Specialization</title>
@endpush
@section('main-section')
  @php
  use App\Models\CourseCategory;
  @endphp
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
                  <li class="breadcrumb-item active" aria-current="page">Course Specialization</li>
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
              <form method="post" action="{{ url('admin/specialization/import') }}" id="import_csv"
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
                    <a download href="{{ asset('format/specialization.xlsx') }}" style="margin-top:28px"
                      class="btn btn-primary">Formate</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-12">
            <div class="box">
              <form action="{{ $url }}" method="post" class="form">
                @csrf
                <div class="box-body">
                  <h4 class="box-title text-info"> {{ $title }} Record</h4>
                  <hr class="my-15">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" type="text" class="form-control select2" required>
                          <option value="">Select</option>
                          @foreach ($cc as $c)
                            <option value="{{ $c->id }}"
                              {{ $ft == 'edit' && $sd->category_id == $c->id ? 'Selected' : '' }}>
                              {{ $c->category }}</option>
                          @endforeach
                        </select>
                        <span class="text-danger">
                          @error('category_id')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Specialization</label>
                        <input name="specialization" type="text" class="form-control" placeholder="specialization Name"
                          value="{{ $ft == 'edit' ? $sd->specialization : old('specialization') }}" required>
                        <span class="text-danger">
                          @error('specialization')
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
                <h4 class="box-title">Specialization List</h4>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr. No.</th>
                        <th>Category</th>
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
                          $fcc = CourseCategory::find($row->category_id);
                        @endphp
                        <tr id="row{{ $row->id }}">
                          <td>{{ $i }}</td>
                          <td>{{ $fcc->category }}</td>
                          <td>{{ $row->specialization }}</td>
                          <td>
                            <a href="javascript:void()" onclick="DeleteAjax('{{ $row->id }}')"
                              class="waves-effect waves-light btn btn-sm btn-outline btn-danger">
                              <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('admin/course-specialization/update/' . $row->id) }}"
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
    function DeleteAjax(id) {
      //alert(id);
      var cd = confirm("Are you sure ?");
      if (cd == true) {
        $.ajax({
          url: "{{ url('admin/cs/delete') }}" + "/" + id,
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
