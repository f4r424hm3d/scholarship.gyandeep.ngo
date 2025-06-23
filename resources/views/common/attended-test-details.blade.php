@php
  use App\Models\ExamQuestions;
  use App\Models\AnswerSheet;
  $ct = date('Y-m-d H:i:s');
@endphp
@extends($role . '.layouts.main')
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
                  <li class="breadcrumb-item"><a href="{{ url($role) }}"><i class="mdi mdi-home-outline"></i></a>
                  </li>
                  <li class="breadcrumb-item"><a href="{{ url($role . '/students/') }}">Students</a></li>
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
          @include('common.student-profile-header')
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

              {{-- <button class="btn btn-sm btn-info" type="button"
                onclick="sendResultToStudent('{{ $student->id }}','{{ $examId }}')">
                Send Result
              </button> --}}

              {{-- <a href="javascript:void()" class="btn btn-xs btn-info" data-toggle="modal"
                data-target="#updateScholarshipModal">Update</a> --}}
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-12">
            <div class="box">
              <div class="box-body">
                <form action="{{ url('common/student/send-letter') }}" class="needs-validation" method="post"
                  enctype="multipart/form-data" novalidate>
                  @csrf
                  <input type="hidden" name="exam_id" value="{{ $examId }}">
                  <input type="hidden" name="role" value="{{ $role }}">
                  <div class="row">
                    <div class="col-md-4 col-sm-12 mb-3">
                      <div class="form-group">
                        <label>Sent to</label>
                        <input name="sent_to" id="sent_to" type="text" class="form-control"
                          placeholder="Enter recipient email" value="{{ old('sent_to') ?? $student->email }}" required />
                        <span class="text-danger" id="sent_to-err">
                          @error('sent_to')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12 mb-3">
                      <label>CC</label>
                      <input name="cc" id="cc" type="text" class="form-control"
                        placeholder="Enter recipient email" value="{{ old('cc') }}" />
                      <span class="text-danger" id="cc-err">
                        @error('cc')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="col-md-3 col-sm-12 mb-3">
                      <label>Attach File</label>
                      <input name="attach" id="attach" type="file" class="form-control" placeholder="Attach File"
                        required />
                      <span class="text-danger" id="attach-err">
                        @error('attach')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  @if ($ft == 'add')
                    <button type="reset" class="btn btn-sm btn-warning  mr-1"><i class="ti-trash"></i>
                      Reset</button>
                  @endif
                  @if ($ft == 'edit')
                    <a href="{{ aurl($page_route) }}" class="btn btn-sm btn-info "><i class="ti-trash"></i> Cancel</a>
                  @endif
                  <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-12">
            <div class="box">
              <div class="box-body">
                <div class="table-responsive">
                  <table id="exampl" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr. No</th>
                        <th>Date</th>
                        <th>Letter</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $i = 1;
                      @endphp
                      @foreach ($studentExamOfferLetter as $row)
                        <tr>
                          <td>{{ $i }}</td>
                          <td>{{ getFormattedDate($row->created_at, 'd M Y - h:i A') }}</td>
                          <td>
                            @if ($row->letter_path)
                              <a href="{{ asset($row->letter_path) }}" target="_blank">View Letter</a>
                            @else
                              No Letter
                            @endif
                          </td>
                          <td>{{ $row->is_sent == 1 ? 'Sent' : 'Not Sent' }}</td>
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
  {{-- @include('common.update-scholarship') --}}
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
