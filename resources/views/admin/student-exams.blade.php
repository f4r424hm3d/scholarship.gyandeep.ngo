@extends('admin.layouts.main')
@push('title')
  <title>{{ $page_title }}</title>
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
                  <li class="breadcrumb-item"><a href="{{ url('/admin/') }}"><i class="mdi mdi-home-outline"></i></a>
                  </li>
                  <li class="breadcrumb-item"><a href="{{ url('/admin/students/') }}">Students</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          @include('backend.student-profile-header')
          <div class="col-lg-12 col-md-12 col-12">
            <!-- NOTIFICATION FIELD START -->
            <x-result-notification-field />
            <!-- NOTIFICATION FIELD END -->
          </div>
          <div class="col-lg-12 col-md-12 col-12">
            <div class="box">
              <div class="box-body">
                <div class="table-responsive">
                  <table id="exampl" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Scholarship</th>
                        <th>Exam Date</th>
                        <th>Attended At</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $i = 1;
                      @endphp
                      @foreach ($rows as $row)
                        @php
                          $end_time = strtotime($row->attended_at . '+' . $row->getExamDet->duration . ' minutes');

                        @endphp
                        <tr>
                          <td><b><a href="javascript:void()">{{ $row->getExamDet->getScholarship->name }}</a></b></td>
                          <td><b>{{ getFormattedDate($row->getExamDet->exam_date, 'd M Y') }}</b></td>
                          <td><b>{{ getFormattedDate($row->attended_at, 'd M Y  h:i A') }}</b></td>
                          <td>
                            @if ($row->submitted == 1 || $row->getExamDet->end_time < $ct || $end_time < $ctp)
                              <span @class(['text-success', 'font-bold' => true])>Submitted</span>
                            @else
                              <span @class(['text-primary', 'font-bold' => true])>Attending</span>
                            @endif
                          </td>
                          <td>
                            <a href="{{ url('admin/student/' . $student->id . '/exams/' . $row->id) }}"
                              class="btn btn-sm btn-danger">View</a>
                          </td>
                        </tr>
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $('#scholarship').on('change', function() {
      var scholarshipId = $('#scholarship').val();
      if (scholarshipId) {
        $.ajax({
          url: "{{ url('common/get-course-categories') }}/" + scholarshipId,
          type: 'GET',
          success: function(data) {
            $('#course_category').html(data);
          },
          error: function() {
            alert('Unable to fetch course categories.');
          }
        });
      } else {
        $('#course_category').empty().append('<option value="">Select Category</option>');
      }
    });
  </script>
@endsection
