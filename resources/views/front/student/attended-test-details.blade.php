@php
  use App\Models\ExamQuestions;
  use App\Models\AnswerSheet;
  $ct = date('Y-m-d H:i:s');
@endphp
@extends('front.layouts.main')
@push('title')
  <title>
    Attended Test - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>
    <section class="main-profile py-sm-5">
      <div class="container-fluid px-sm-5">
        <div class="row">

          @include('front.student.profile-sidebar')

          <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 mb-4">
            @if (session()->has('smsg'))
              <div class="alert alert-success alert-dismissable">
                {{ session()->get('smsg') }}
              </div>
            @endif
            @if (session()->has('emsg'))
              <div class="alert alert-danger alert-dismissable">
                {{ session()->get('emsg') }}
              </div>
            @endif
            <div style="clear:both"></div>
            <div class="pb-2">
              <div class="box_general_3">
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

                      <td>
                        @if ($row->submitted == 1)
                          {{ getFormattedDate($row->submitted_at, 'd M Y  h:i A') }}
                        @else
                          <span class="text-danger">Not Submitted</span>
                        @endif
                      </td>

                    </tr>
                  </table>
                </div>
              </div>
              <div class="box_general_3">
                <div class="table-responsive">
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
                </div>
              </div>

              @if ($row->getExamDet->show_result == 1)
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
                                'student_id' => $student_id,
                                'exam_id' => $row->exam_id,
                                'subject_id' => $ed->subject_id,
                            ])
                                ->where('answer', '!=', '')
                                ->count();
                            $grandTotalAttempted = $grandTotalAttempted + $totalAttempted;

                            $anslist = AnswerSheet::with('getAnswer')
                                ->where([
                                    'student_id' => $student_id,
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
                                $grandTotalAttempted == 0 ? 0 : round(($grandTotalCA * 100) / $grandTotalAttempted, 2);
                          @endphp
                          <td>{{ $finalAccuracy }} %</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              @endif
            </div>
          </div>

        </div>
      </div>
    </section>
  </main>
  <script>
    function showMessage(time) {
      $('#messSpan').html('Exam will start on <b>' + time + '</b>.');
    }

    function showMessage2() {
      $('#messSpan2').html("<span class='text-danger'>Payment pending , You can't joined</span>");
    }
  </script>
@endsection
