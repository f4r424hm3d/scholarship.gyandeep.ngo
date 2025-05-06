@extends('backend.layouts.main')
@push('title')
  <title>Create Exams - Gyandeep NGO</title>
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
                  <li class="breadcrumb-item active" aria-current="page">Expired Exams</li>
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
          {{-- {{ printArray($dep) }} --}}
          <div class="col-lg-12 col-md-12 col-12">
            <div class="box">
              <div class="box-header">
                <h4 class="box-title">Expired Exams List</h4>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr. No.</th>
                        <th>Id</th>
                        <th>Scholarship</th>
                        <th>Course Category</th>
                        <th>Exam Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Duration</th>
                        <th>Question Paper</th>
                        <th>Result</th>
                        {{-- <th>Action</th> --}}
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $i = 1;
                      @endphp
                      @foreach ($rows as $row)
                        <tr id="row{{ $row->id }}">
                          <td>{{ $i }}</td>
                          <td>{{ $row->id }}</td>
                          <td>{{ $row->getScholarship->name }}</td>
                          <td>{{ $row->getCourseCategory->category }}</td>
                          <td>{{ getFormattedDate($row->exam_date, 'd M Y') }}</td>
                          <td>{{ getFormattedDate($row->start_time, 'd M Y - h:i A') }}</td>
                          <td>{{ getFormattedDate($row->end_time, 'd M Y - h:i A') }}</td>
                          <td>{{ $row->duration }} minutes</td>
                          <td>
                            <span @class(['badge badge-dark'])
                              title="{{ $row->getQuestions->count() }} questions added.">{{ $row->getQuestions->count() }}</span>
                            <a title="Add more" href="{{ url('admin/exam-question/export/' . $row->id) }}"
                              class="waves-effect waves-light btn btn-xs btn-info">Download</a>
                            {{-- <a title="Add more" target="_blank"
                                                    href="{{ url('admin/exam-question/' . $row->id) }}"
                                                    class="waves-effect waves-light btn btn-xs btn-info">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </a> --}}
                          </td>
                          <td id="statustd{{ $row->id }}">
                            <span id="asts{{ $row->id }}"
                              class="badge badge-success {{ $row->show_result == 1 ? '' : 'hide-this' }}"
                              onclick="changeStatus('{{ $row->id }}','0')">Active</span>
                            <span id="ists{{ $row->id }}"
                              class="badge badge-danger {{ $row->show_result == 0 ? '' : 'hide-this' }}"
                              onclick="changeStatus('{{ $row->id }}','1')">Inactive</span>
                          </td>
                          {{-- <td>
                                                <a title="Delete" href="javascript:void()"
                                                    onclick="DeleteAjax('{{ $row->id }}')"
                                                    class="waves-effect waves-light btn btn-xs btn-danger">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </td> --}}
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
      var tbl = 'create_exams';
      var col = 'show_result';
      $.ajax({
        url: "{{ url('common/update-field') }}",
        method: "GET",
        data: {
          id: id,
          val: val,
          col: col,
          tbl: tbl
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
          url: "{{ url('admin/exams/delete') }}" + "/" + id,
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
