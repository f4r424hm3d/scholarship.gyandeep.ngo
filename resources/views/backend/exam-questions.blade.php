@extends('backend.layouts.main')
@push('title')
  <title>Exam Questions - Gyandeep NGO</title>
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
                  <li class="breadcrumb-item active" aria-current="page">Exam Questions</li>
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
                    <div class="col-md-3 col-sm-12">
                      <div class="form-group">
                        <label>Subjects</label>
                        <select name="subject_id" class="form-control select2">
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
                    <div class="col-md-12 col-sm-12">
                      <div class="form-group">
                        <label>Question</label>
                        <textarea name="question" id="question" type="text" class="form-control" placeholder="Question">{{ $ft == 'edit' ? $sd->question : old('question') }}</textarea>
                        <span class="text-danger">
                          @error('question')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                      <div class="form-group">
                        <label>Option A</label>
                        <input name="a" type="text" class="form-control" placeholder="Option A"
                          value="{{ $ft == 'edit' ? $sd->a : old('a') }}">
                        <span class="text-danger">
                          @error('a')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                      <div class="form-group">
                        <label>Option B</label>
                        <input name="b" type="text" class="form-control" placeholder="Option B"
                          value="{{ $ft == 'edit' ? $sd->b : old('b') }}">
                        <span class="text-danger">
                          @error('b')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                      <div class="form-group">
                        <label>Option C</label>
                        <input name="c" type="text" class="form-control" placeholder="Option C"
                          value="{{ $ft == 'edit' ? $sd->c : old('c') }}">
                        <span class="text-danger">
                          @error('c')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                      <div class="form-group">
                        <label>Option D</label>
                        <input name="d" type="text" class="form-control" placeholder="Option D"
                          value="{{ $ft == 'edit' ? $sd->d : old('d') }}">
                        <span class="text-danger">
                          @error('d')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                        <label>Answer</label>
                        <input name="answer" type="text" class="form-control" placeholder="Answer"
                          value="{{ $ft == 'edit' ? $sd->answer : old('answer') }}">
                        <span class="text-danger">
                          @error('answer')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                        <label>Image</label>
                        <input name="image" type="file" class="form-control" placeholder="Image">
                        <span class="text-danger">
                          @error('image')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                      <div class="form-group">
                        <label>Ilustration</label>
                        <textarea name="illustration" id="illustration" type="text" class="form-control" placeholder="Ilustration">{{ $ft == 'edit' ? $sd->illustration : old('illustration') }}</textarea>
                        <span class="text-danger">
                          @error('illustration')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                      <div class="form-group">
                        <label>Direction</label>
                        <textarea name="direction" id="direction" type="text" class="form-control" placeholder="Direction">{{ $ft == 'edit' ? $sd->direction : old('direction') }}</textarea>
                        <span class="text-danger">
                          @error('direction')
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
              <div class="box-body">
                <h4 class="box-title text-info"> Upload File</h4>
                <hr class="my-15">
                <form method="post" action="{{ url('admin/exam-question/import') }}" id="import_csv"
                  enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="exam_id" value="{{ Request::segment(3) }}">
                  <div class="row">
                    <div class="form-group col-md-4">
                      <label>Select CSV File</label>
                      <input type="file" name="file" id="file" required
                        class="form-control mb-2 mr-sm-2" />
                    </div>
                    <div class="form-group col-md-4">
                      <label>&nbsp;&nbsp;</label>
                      <button style="margin-top:28px" type="submit" name="import_csv" class="btn btn-info"
                        id="import_csv_btn">Import</button>
                      <a download href="{{ asset('format/exam-paper.xlsx') }}" style="margin-top:28px"
                        class="btn btn-primary">Formate</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          {{-- {{ printArray($dep) }} --}}
          <div class="col-lg-12 col-md-12 col-12">
            <div class="box">
              <div class="box-header">
                <h4 class="box-title">Exam Questions List</h4>
                <div style="float:right"><a href="{{ url('admin/exam-question/export/' . Request::segment(3)) }}"
                    class="btn btn-sm btn-success">Export</a></div>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr. No.</th>
                        <th>Subject</th>
                        <th>Question</th>
                        <th>Direction</th>
                        <th>answer</th>
                        <th>Image</th>
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
                          <td>
                            {!! $row->question !!} <br>
                            <b>A.</b> {{ $row->a }}<br>
                            <b>B.</b> {{ $row->b }}<br>
                            <b>C.</b> {{ $row->c }}<br>
                            <b>D.</b> {{ $row->d }}<br>
                          </td>
                          <td>{!! $row->direction !!}</td>
                          <td>
                            {!! $row->answer !!} <br>
                            {!! $row->illustration !!}
                          </td>
                          <td>
                            @if ($row->image != '')
                              <a href="{{ asset($row->image) }}" alt="{{ $row->question }}" target="_blank">
                                <img src="{{ asset($row->image) }}" alt="{{ $row->question }}" height="50"
                                  width="50">
                              </a>
                            @else
                              No file uploaded
                            @endif
                          </td>
                          <td>
                            <a href="javascript:void()" onclick="DeleteAjax('{{ $row->id }}')"
                              class="waves-effect waves-light btn btn-sm btn-outline btn-danger">
                              <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('admin/exam-question/' . $row->exam_id . '/update/' . $row->id) }}"
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
          url: "{{ url('admin/exam-question/delete') }}" + "/" + id,
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
