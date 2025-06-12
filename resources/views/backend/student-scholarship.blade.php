@extends('backend.layouts.main')
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
                        <th>Applied For</th>
                        <th>Exam Detail</th>
                        {{-- <th>Status</th> --}}
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $i = 1;
                      @endphp
                      @foreach ($as as $as)
                        <tr>
                          <td>
                            {{ $as->getScholarship->name }}
                          </td>
                          <td>
                            Category - <b>{{ $as->getExam->getCourseCategory->category ?? '' }}</b><br>
                          </td>
                          <td>
                            @if ($as->getAsignExam->attended == 1 && $as->getAsignExam->submitted == 1)
                              <span class="text-success">Exam Attended</span><br>
                            @else
                              Start at - <b>{{ getFormattedDate($as->getExam->start_time, 'd M Y - h:i A') }}</b><br>
                              End at - <b>{{ getFormattedDate($as->getExam->end_time, 'd M Y - h:i A') }}</b><br>
                              @php
                                $current_time = date('Y-m-d H:i:s');
                                $start_time = getFormattedDate($as->getExam->start_time, 'd M Y - h:i A');
                                //$current_time = '2022-07-20 12:00:00';
                              @endphp
                              @if ($current_time > $as->getExam->end_time)
                                <span class='text-danger'>Exam expired</span>
                              @endif
                            @endif
                          </td>
                          {{-- <td>
                            @if ($row->submitted == 1 || $row->getExamDet->end_time < $ct || $end_time < $ctp)
                              <span class="text-success">Completed</span>
                            @else
                              <span class="text-danger">Pending</span>
                            @endif
                          </td> --}}
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
