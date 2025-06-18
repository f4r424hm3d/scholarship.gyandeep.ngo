@php
  use App\Models\ExamQuestions;
  use App\Models\AnswerSheet;
  $ct = date('Y-m-d H:i:s');
@endphp
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
                  <table class="table table-striped mb-0">
                    <tr>
                      <th>Scholarship</th>
                      <td><a href="javascript:void()">{{ $row->getExamDet->getScholarship->name }}</a></td>
                      <th>Exam Date</th>
                      <td>{{ getFormattedDate($row->getExamDet->exam_date, 'd M Y') }}
                      </td>
                      <th>Attended At</th>
                      <td>{{ getFormattedDate($row->attended_at, 'd M Y  h:i A') }}
                      </td>
                      <th>Submitted At</th>
                      <td>{{ getFormattedDate($row->submitted_at, 'd M Y  h:i A') }}
                      </td>
                    </tr>
                  </table>
                  <table class="table table-striped mb-0">
                    <tr>
                      <th>No. of questions</th>
                      <td>{{ $total_question }}</td>
                      <th>Answered</th>
                      <td>{{ $answered_question }}</td>
                      <th>Not Answered</th>
                      <td>{{ $not_answered }}</td>
                    </tr>
                    <tr>
                      <th>Marked for review</th>
                      <td>{{ $marked_question }}</td>
                      <th>Marked and Answered</th>
                      <td>{{ $marked_and_answered }}</td>
                      <th>Not Visited</th>
                      <td>{{ $not_visited }}</td>
                    </tr>
                  </table>

                  <div class="box_general_3">
                    <h5>Section Wise Result</h5>
                    <p>Your detailed section performance is shown below.</p>
                    <div class="table-responsive">
                      <table class="table table-striped mb-0">
                        <thead>
                          <tr>
                            <th>Section</th>
                            <th>Attempted</th>
                            <th>Correct</th>
                            <th>accuracy</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php
                            $grandTotalAttempted = 0;
                            $grandTotalQuestion = 0;
                            $grandTotalCA = 0;
                            $grandTotalAccuracy = 0;
                          @endphp
                          @foreach ($sectionDet as $ed)
                            @php
                              $totalQuestion = ExamQuestions::where([
                                  'exam_id' => $row->exam_id,
                                  'subject_id' => $ed->subject_id,
                              ])->count();

                              $grandTotalQuestion = $grandTotalQuestion + $totalQuestion;

                              $totalAttempted = AnswerSheet::where([
                                  'student_id' => $student->id,
                                  'exam_id' => $row->exam_id,
                                  'subject_id' => $ed->subject_id,
                              ])
                                  ->where('answer', '!=', '')
                                  ->count();
                              $grandTotalAttempted = $grandTotalAttempted + $totalAttempted;

                              $anslist = AnswerSheet::with('getAnswer')
                                  ->where([
                                      'student_id' => $student->id,
                                      'exam_id' => $row->exam_id,
                                      'subject_id' => $ed->subject_id,
                                  ])
                                  ->where('answer', '!=', '')
                                  ->get();
                              //printArray($anslist->toArray());
                              $ca = 0;
                              foreach ($anslist as $ansd) {
                                  if ($ansd->answer == $ansd->getAnswer->answer) {
                                      $ca++;
                                  }
                              }

                              $grandTotalCA = $grandTotalCA + $ca;

                              $accuracy = $totalAttempted == 0 ? '0' : round(($ca * 100) / $totalAttempted, 2);
                              //$accuracy = 1;
                            @endphp
                            <tr>
                              <th>{{ $ed->getSubject->subject }}</th>
                              <td>{{ $totalAttempted }} / {{ $totalQuestion }}</td>
                              <td>{{ $ca }}</td>
                              <td>{{ $accuracy }} %</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="box_general_3">
                    <h5>Total Result</h5>
                    <div class="table-responsive">
                      <table class="table table-striped mb-0">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Attempted</th>
                            <th>Correct</th>
                            <th>accuracy</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th>Total</th>
                            <td>{{ $grandTotalAttempted }} / {{ $grandTotalQuestion }}</td>
                            <td>{{ $grandTotalCA }}</td>
                            @php
                              $finalAccuracy =
                                  $grandTotalAttempted == 0
                                      ? 0
                                      : round(($grandTotalCA * 100) / $grandTotalAttempted, 2);
                            @endphp
                            <td>{{ $finalAccuracy }} %</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <button class="btn btn-sm btn-info" type="button"
                onclick="sendResultToStudent('{{ $student->id }}','{{ $examId }}')">
                Send Result
              </button>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <script>
    function sendResultToStudent(studentId, examId) {
      //alert(studentId);
      var cd = confirm("Are you sure ?");
      if (cd == true) {
        $.ajax({
          url: "{{ url('common/send-result-to-student') }}" + "/" + studentId + "/" + examId,
          success: function(result) {
            if (result == '1') {
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
