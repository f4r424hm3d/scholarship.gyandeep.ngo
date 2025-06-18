@extends('admin.layouts.main')
@push('title')
  <title>Exam Instruction - Gyandeep NGO</title>
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
                  <li class="breadcrumb-item active" aria-current="page">Exam Instruction</li>
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
                <h4 class="box-title text-danger">{{ $examDet->getScholarship->name }} |
                  {{ $examDet->getCourseCategory->category }}</h4>
                <hr class="my-15">
                <h4 class="box-title text-info"> {{ $title }} Record</h4>
                <hr class="my-15">
                <form action="{{ $url }}" method="post" class="form" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                        <label>Subjects</label>
                        <select name="subject_id{{ $ft == 'edit' ? '' : '[]' }}" class="form-control select2"
                          {{ $ft == 'edit' ? '' : 'multiple' }} data-placeholder="Select">
                          <option value="">Select</option>
                          @foreach ($subjects as $row)
                            <option value="{{ $row->id }}"
                              {{ ($ft == 'edit' && $sd->subject_id == $row->id) || (old('subject_id') && old('subject_id') == $row->id) ? 'selected' : '' }}>
                              {{ $row->subject }}</option>
                          @endforeach
                        </select>
                        <span class="text-danger">
                          @error('subject_id')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                      <div class="form-group">
                        <label>No of Questions</label>
                        <input name="noq" type="number" class="form-control" placeholder="No of Questions"
                          value="{{ $ft == 'edit' ? $sd->noq : old('noq') }}" required>
                        <span class="text-danger">
                          @error('noq')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                      <div class="form-group">
                        <label>Maximum Marks</label>
                        <input name="max_marks" type="number" class="form-control" placeholder="Maximum Marks"
                          value="{{ $ft == 'edit' ? $sd->max_marks : old('max_marks') }}" required>
                        <span class="text-danger">
                          @error('max_marks')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                      <div class="form-group">
                        <label>Negative Marks</label>
                        <input name="n_marks" type="number" class="form-control" placeholder="Negative Marks"
                          value="{{ $ft == 'edit' ? $sd->n_marks : old('n_marks') }}" required>
                        <span class="text-danger">
                          @error('n_marks')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                      <div class="form-group">
                        <label>Positive Marks</label>
                        <input name="p_marks" type="number" class="form-control" placeholder="Positive Marks"
                          value="{{ $ft == 'edit' ? $sd->p_marks : old('p_marks') }}" required>
                        <span class="text-danger">
                          @error('p_marks')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    @if ($ft == 'add')
                      <button type="reset" class="btn btn-sm btn-warning  mr-1">
                        <i class="ti-trash"></i> Reset
                      </button>
                    @endif
                    @if ($ft == 'edit')
                      <a href="{{ url('admin/levels') }}" class="btn btn-sm btn-info ">
                        <i class="ti-trash"></i> Cancel
                      </a>
                    @endif
                    <button type="submit" class="btn btn-sm btn-primary ">
                      <i class="ti-save-alt"></i> Save
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-12">
            <div class="box">
              <div class="box-header">
                <h4 class="box-title">Exam Instruction List</h4>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr. No.</th>
                        <th>Subject</th>
                        <th>No. of Question</th>
                        <th>Maximum Marks</th>
                        <th>Positive Marks</th>
                        <th>Negative Marks</th>
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
                          <td>{{ $row->getSubject->subject }}</td>
                          <td>{!! $row->noq !!}</td>
                          <td>{!! $row->max_marks !!}</td>
                          <td>{!! $row->p_marks !!}</td>
                          <td>{!! $row->n_marks !!}</td>
                          <td>
                            <a title="Delete" href="javascript:void()" onclick="DeleteAjax('{{ $row->id }}')"
                              class="waves-effect waves-light btn btn-xs btn-danger">
                              <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                            <a title="Edit"
                              href="{{ url('admin/exam-instruction/' . $row->exam_id . '/update/' . $row->id) }}"
                              class="waves-effect waves-light btn btn-xs btn-info">
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
      var tbl = 'users';
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
          url: "{{ url('admin/exam-instruction/delete') }}" + "/" + id,
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
