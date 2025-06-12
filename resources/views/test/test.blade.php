@php
use App\Models\AnswerSheet;
$section_id = Request::segment(3);
$ques_id = Request::segment(4);
$ct = strtotime(date('Y-m-d H:i:s'));
//echo '<br>';
$et = strtotime(session()->get('end_time'));
//echo '<br>';
$jqendt = ($et - $ct) * 1000;
@endphp
@extends('test.layouts.main')
@push('title')
<title>{{ $exam->getScholarship->name }} - Gyandeep NGO</title>
@endpush
@section('main-section')
<style>
    .qnt {
        border-radius: 100% !important;
    }
</style>
<script>
    // $(document).ready(function() {
    //   $(window).on('beforeunload', function() {
    //     return 'Are you sure ?';
    //   });
    // });
</script>
<!-- Button trigger modal -->
<marquee class="marque-moved" behavior="" direction="right">
        <ul class="new-offers">
            <li>Recording in progress: <span class="new-spns">video</span><span class="new-spns">audio, and screen</span> </li>
        </ul>
        
    </marquee>





<section class="contenwrapper my-3">

    <div class="container">
        <!-- <section class="content"> -->
        <div class="row flex-column flex-md-row
         ">
            <div class="col-lg-8 col-md-12 col-sm-12 col-12 mb-4">
                <div class="content-instructions">
                    <div class="box">
                        <div id="tp">
                            <div class="head">
                                <ul class="nav nav-tabs customtab2" role="tablist">
                                    <li class="pl-10 pr-15 new-sections">Sections :</li>
                                    <ul class="main-flexs">
                                        @foreach ($examsub as $row)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $row->getSubject->id == $section_id ? 'active' : '' }}"
                                                href="{{ url('test/' . $exam->token . '/' . $row->getSubject->id) }}">{{
                                                $row->getSubject->subject }}</a>
                                        </li>
                                        @endforeach
                                    </ul>


                                </ul>
                            </div>

                            <div class="box-body p-3 p-sm-auto">
                                <!-- Tab panes -->
                                @if ($section_id != '')
                                <div class="tab-content">
                                    <div class="tab-pane active">
                                        <h4 class="border-bottom pb-10 main-questions">
                                            Question: <span id="qn_span"></span>
                                            <span class="time-btn2 d-lg-inline-flex float-right">Marks: +1: -0</span>
                                            {{-- <span class="time-btn2 d-lg-inline-flex float-right">Time :
                                                00:00</span> --}}
                                        </h4>
                                        <div class="row">
                                            @if ($ques_det->direction != '')
                                            <div class="col-md-12">
                                                <div class="tpb">
                                                    <h5>Comprehension:</h5>
                                                    <div class="com-scrl-bar">
                                                        <p>
                                                            {{ $ques_det->direction }}
                                                        </p>
                                                        @if ($ques_det->image != '')
                                                        <p><b>Image </b></p>
                                                        <img src="{{ asset($ques_det->image) }}" class="shadow" />
                                                        @endif

                                                        {{-- <p><b>Image 2</b></p>
                                                        <img src="images/q.jpg" class="shadow" />

                                                        <p><b>Image 3</b></p>
                                                        <img src="images/q.jpg" class="shadow" /> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="tpb">

                                                    <h5>Question:</h5>
                                                    <p>
                                                        {{ $ques_det->question }}
                                                    </p>

                                                    <div class="demo-radio-button">
                                                        <div class="d-block">
                                                            <input name="answer" type="radio" id="a" class="with-gap"
                                                                value="{{ $ques_det->a }}" {{ $ques_det->a ==
                                                            $AnswerSheet->answer ? 'checked' : '' }}><label for="a">{{
                                                                $ques_det->a }}</label>
                                                        </div>
                                                        <div class="d-block mt-5">
                                                            <input name="answer" type="radio" id="b" class="with-gap"
                                                                value="{{ $ques_det->b }}" {{ $ques_det->b ==
                                                            $AnswerSheet->answer ? 'checked' : '' }}><label for="b">{{
                                                                $ques_det->b }}</label>
                                                        </div>
                                                        <div class="d-block mt-5">
                                                            <input name="answer" type="radio" id="c" class="with-gap"
                                                                value="{{ $ques_det->c }}" {{ $ques_det->c ==
                                                            $AnswerSheet->answer ? 'checked' : '' }}><label for="c">{{
                                                                $ques_det->c }}</label>
                                                        </div>
                                                        <div class="d-block mt-5">
                                                            <input name="answer" type="radio" id="d" class="with-gap"
                                                                value="{{ $ques_det->d }}" {{ $ques_det->d ==
                                                            $AnswerSheet->answer ? 'checked' : '' }}><label for="d">{{
                                                                $ques_det->d }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @if ($section_id != '')
                        <div class="box-footer">
                            <div class="btn-footer">
                                <button onclick="saveAndNext('mark','{{ $next }}')" type="button"
                                    class="waves-effect waves-light btn btn-light footer-btn">
                                    Mark for Review & Next
                                </button>
                                <button onclick="clearAnswer()" type="button"
                                    class="waves-effect footer-btn waves-light btn btn-danger">
                                    Clear
                                </button>
                                <a class="popup-with-form btn btn-success waves-effect footer-btn waves-light btn btn-warning"
                                    href="#report-form">Report</a>
                            </div>
                            {{-- <button type="button" class="waves-effect waves-light btn btn-light">
                                Save & Mark for Review
                            </button> --}}

                            {{-- <button type="button" class="waves-effect waves-light btn btn-light">
                                Skip
                            </button> --}}
                            <div class="pull-right">
                                @if ($next == '')
                                <a href="#yes-no"
                                    class="popup-with-form waves-effect waves-light btn btn-success img-fluid">
                                    Submit Test
                                </a>
                                @else
                                <a href="javascript:void()" onclick="saveAndNext('save','{{ $next }}')">
                                    <button type="button" class="waves-effect waves-light btn btn-success">
                                        Save & Next <i class="ti-arrow-right"></i>
                                    </button>
                                </a>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

            </div>

            <div class="col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                <div class="rside">
                    <div class="d-flex justify-content-center align-items-center mt-2">
                        <!-- <div class="user-img"><img src="{{ url('testapp') }}/images/user.png" /></div> -->
                        <div class="user-name">{{ $student->name }}</div>
                    </div>
                    <ul>
                        <li>
                            <div class="b1">{{ $answered_question }}</div>
                            <p>Attempeted</p>
                        </li>
                        <li>
                            <div class="b3">{{ $marked_question }}</div>
                            <p>Marked</p>
                        </li>
                        <li>
                            <div class="b5">{{ $not_visited }}</div>
                            <p>Not Visited</p>
                        </li>
                        <li>
                            <div class="b2">{{ $not_answered }}</div>
                            <p>Not answered</p>
                        </li>
                        <li>
                            <div class="b4">{{ $marked_and_answered }}<i class="fa fa-check"></i></div>
                            <p>Marked & answered</p>
                        </li>
                    </ul>
                    @if ($section_id != '')
                    <div class="all-borsection">
                        <div class="sec">Section: {{ $row->getSubject->subject }}</div>
                        <div class="num">
                            <div class="ps-scrl-bar">
                                {{-- <a href="#" class="attemp">1</a>
                                <a href="#" class="not-ans">2</a>
                                <a href="#" class="marked">3</a>
                                <a href="#" class="marked-ans">4</a> --}}
                                @php
                                $qsn = 1;
                                @endphp
                                @foreach ($ques_num as $row)
                                @php
                                $where = [
                                'student_id' => $student_id,
                                'exam_id' => $exam->id,
                                'question_id' => $row->id,
                                ];
                                $sqd = AnswerSheet::where($where)->first();
                                if (!is_null($sqd)) {
                                if ($sqd->answer == null && $sqd->marked == 0) {
                                $q_class = 'not-ans';
                                }
                                if ($sqd->answer != null && $sqd->marked == 0) {
                                $q_class = 'attemp';
                                }
                                if ($sqd->answer != null && $sqd->marked == 1) {
                                $q_class = 'marked-ans';
                                }
                                if ($sqd->answer == null && $sqd->marked == 1) {
                                $q_class = 'marked';
                                }
                                } else {
                                $q_class = '';
                                }
                                @endphp
                                <a href="{{ url('test/' . $exam->token . '/' . $section_id . '/' . $row->id) }}"
                                    class="{{ $q_class }} {{ $row->id == $q_id ? 'qnt' : '' }}">{{ $qsn }}</a>
                                @php
                                $qsn++;
                                @endphp
                                @endforeach
                                {{-- <a href="#" class="">0</a>
                                <a href="#" class="">0</a> --}}
                            </div>
                        </div>
                        <div class="rside-footer">
                            <!-- <a href="{{ url('test/' . $exam->token . '/instruction') }}"
                      class="waves-effect waves-light btn btn-light img-fluid mb-5">Instructions</a> -->
                            <a href="#yes-no"
                                class="popup-with-form waves-effect waves-light btn btn-success img-fluid">Submit
                                Test</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- </section> -->
    </div>
</section>




<!-- report form -->
<form id="report-form" class="mfp-hide white-popup-block w-400">
    <div id="errSpanReport">

    </div>
    <input type="hidden" name="student_id" value="{{ Session::get('student_id') }}">
    <input type="hidden" name="exam_id" value="{{ $exam->id }}">
    <input type="hidden" name="question_id" value="{{ $q_id }}">
    <div class="form-group">
        <label>Type of Error</label>
        <select name="error_type" class="form-control select2" style="width: 100%" required>
            <option value="">Select Type</option>
            <option value="Wrong Question">Wrong Question</option>
            <option value="Wrong Option">Wrong Option</option>
            <option value="Incomplete Question">Incomplete Question</option>
            <option value="Incorrect Grammer">Incorrect Grammer</option>
            <option value="Question out of Syllabus">Question out of Syllabus</option>
            <option value="Question on old pattern">Question on old pattern</option>
        </select>
    </div>
    <div class="form-group">
        <label class="control-label" for="textarea">Report here</label>
        <textarea name="report" class="form-control" id="textarea" rows="5"
            placeholder="Please write your reporte here..."></textarea>
    </div>
    <button type="submit" class="waves-effect waves-light btn btn-primary mb-5 img-fluid">
        Submit Report
    </button>
</form>

<!-- yes no -->
<form id="yes-no" class="mfp-hide white-popup-block text-center pb-35 w-450">
    <h3 class="mb-20" style="font-weight: 500">
        Are you sure to submit your test?
    </h3>
    <a onclick="saveAndNext('save','')" href="javascript:void()"
        class="btn btn-success mr-2">Yes</a>
    <a class="btn btn-danger" style="opacity: 1">No</a>
</form>

<!-- summary -->
<form id="summary" class="mfp-hide white-popup-block pb-35 w-500">
    <h2 class="text-center" style="font-weight: 500">Test Summary</h2>
    <p class="text-center mb-20 pl-35 pr-35">
        Your answer have been saved successfully please take fev moments to
        review this summary.
    </p>
    <div class="row test-summary-text pl-35 pr-35">
        <div class="col-8">No. of questions</div>
        <div class="col-4 gray">100</div>
        <div class="col-8">Answered</div>
        <div class="col-4 gray">6</div>
        <div class="col-8">Not Answered</div>
        <div class="col-4 gray">4</div>
        <div class="col-8">Marked for review</div>
        <div class="col-4 gray">0</div>
        <div class="col-8">Marked and Answered</div>
        <div class="col-4 gray">0</div>
        <div class="col-8">Not Visited</div>
        <div class="col-4 gray">90</div>
        <a href="performance-report.html" class="waves-effect waves-light btn btn-success">Proceed</a>
        <a class="mfp-close waves-effect waves-light btn btn-danger d-inline-block w-auto h-auto"
            style="opacity:0">x</a>
    </div>
</form>
<script>
    $(document).ready(function() {
      $('#report-form').on('submit', function(event) {
        event.preventDefault();
        //alert(student_id);
        $.ajax({
          url: "{{ url('run-test/report') }}",
          method: "GET",
          data: $(this).serialize(),
          success: function(result) {
            //alert(result);
            if (result == '1') {
              $('#errSpanReport').html('<div class="alert alert-success alert-dismissable">Success</div>');
            } else {
              $('#errSpanReport').html(
                '<div class="alert alert-danger alert-dismissable">You have already reported</div>');
            }
            $('#report-form')[0].reset();
            //$("#report-form").attr('class', 'mfp-hide');
          }
        })
      });
    });

    function clearAnswer() {
      //alert('hello');
      //$("input:radio").removeAttr("checked");
      //$("input:radio").attr("checked", false);
      $("input[type='radio'][name='answer']").attr("checked", false);
    }

    function saveAndNext(type, next) {
      var next_section = '{{ $nqd->subject_id ?? $section_id }}';
      var next_q = '{{ $next ?? $ques_id }}';
      //var next = '{{ $next }}';
      var exam_id = '{{ $exam->id }}';
      var subject_id = '{{ $section_id }}';
      var question_id = '{{ $q_id }}';
      var answer = '';
      var selected = $("input[type='radio'][name='answer']:checked");
      if (selected.length > 0) {
        answer = selected.val();
      }
      if (next == '') {
        //var cd = confirm("Are you sure to submit you test?");
        //$('#yes-no').show();
        var cd = true;
        var path = "{{ url('run-test/complete?asign=' . $ae->id) }}";
      } else {
        var cd = true;
        var path = "{{ url('test/') }}" + "/{{ $exam->token }}/" + next_section + "/" + next_q;
      }
      if (cd == true) {
        //alert(next_section + ' , ' + next_q + ' , ' + answer + ' , ' + exam_id + ' , ' + subject_id + ' , ' + question_id);
        $.ajax({
          url: "{{ url('run-test/save-answer') }}",
          method: "GET",
          data: {
            exam_id: exam_id,
            subject_id: subject_id,
            question_id: question_id,
            answer: answer,
            type: type,
          },
          success: function(data) {
            //alert(data);
            if (data == '1') {
              if (next == '') {
                window.open(path, 'test', 'toolbars=0,width=100%');
              } else {
                window.open(path, "_self");
              }
            } else {
              window.open("{{ url('run-test/complete?asign=' . $ae->id) }}", "_self");
            }
          }
        });
      }
    }

    $(document).ready(function() {
      var question_no = $('.qnt').text();
      $('#qn_span').text(question_no);
      //alert(question_no);
    });

    $(document).ready(function() {
      setTimeout(function() {
        window.open("{{ url('run-test/complete?asign=' . $ae->id) }}", "_self");
      }, {{ $jqendt }});
    })
</script>
<script>
    // window.onbeforeunload = function() {
    //   return "Are you sure?";
    // };
    // window.addEventListener('beforeunload', function(e) {
    //   saveAndNext('save', '');
    //   // You can customize the confirmation message if you want
    //   var confirmationMessage = 'Are you sure you want to leave this page? Your progress may not be saved.';
    //   (e || window.event).returnValue = confirmationMessage; // Gecko and Trident
    //   return confirmationMessage; // Gecko and WebKit
    // });
</script>
@endsection
