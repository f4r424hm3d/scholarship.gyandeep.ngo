<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use App\Models\AnswerSheet;
use App\Models\AsignExam;
use App\Models\CreateExams;
use App\Models\ExamInstruction;
use App\Models\ExamQuestions;
use App\Models\QuestionReport;
use App\Models\Student;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StudentTestFc extends Controller
{
  public function instruction($token)
  {
    $ct = date('Y-m-d H:i:s');
    $exam = CreateExams::with('getScholarship')->where('token', $token)->firstOrFail();
    // printArray($exam->toArray());
    // die;
    $student_id = session()->get('student_id');
    $ae = AsignExam::where(['exam_id' => $exam->id, 'student_id' => $student_id])->first();
    $finish_time = date('Y-m-d H:i:s', strtotime($ae->attended_at . '+' . $exam->duration . ' minutes'));
    if ($ae->attended == 0 && $ae->submitted == 0) {
      if ($ct > $exam->start_time && $ct < $exam->end_time) {
        $data = compact('exam');
        return view('test.instruction')->with($data);
      } else {
        if ($ct < $exam->start_time) {
          session()->flash('emsg', 'The test will start at ' . getFormattedDate($exam->start_time, 'd M Y - h:i A') . ' and end at ' . getFormattedDate($exam->end_time, 'd M Y - h:i A') . ' .');
          return redirect('student/tests');
        } else if ($ct > $exam->end_time) {
          session()->flash('emsg', 'This test has been expired.');
          return redirect('student/tests');
        }
        // session()->flash('emsg', 'The test will start at ' . getFormattedDate($exam->start_time, 'd M Y - h:i A') . ' and end at ' . getFormattedDate($exam->end_time, 'd M Y - h:i A') . ' .');
        // return redirect('profile/success');
      }
    } else if (($ae->attended == 1 && $ae->submitted == 1) || ($ae->attended == 1 && $ct > $finish_time)) {
      session()->flash('emsg', 'You already attended this test.');
      return redirect('student/attended-test/' . $ae->id);
    } else {
      $data = compact('exam');
      return view('test.instruction')->with($data);
    }
  }
  public function startTest($token)
  {
    $student_id = session()->get('student_id');

    $exam = CreateExams::with('getScholarship')->where('token', $token)->firstOrFail();
    $examsub = ExamQuestions::with('getSubject')->where('exam_id', $exam->id)->select('subject_id')->distinct('subject_id')->get();

    $ei = ExamInstruction::where('exam_id', $exam->id)->get();
    $ae = AsignExam::where(['exam_id' => $exam->id, 'student_id' => $student_id])->first();

    if (session()->has('student_test_start')) {
      return redirect('test/' . $token . '/' . $examsub[0]->getSubject->id);
    } else {
      // printArray($examsub->toArray());
      // die;
      if ($ae->attended == 0) {
        $data = compact('exam', 'examsub', 'ei');
        return view('test.start-test')->with($data);
      } else {
        session()->flash('emsg', 'You already attended this test.');
        return redirect('student/attended-test/' . $ae->id);
      }
    }
  }
  public function submitStartTest(Request $request)
  {
    // printArray($request->all());
    // die;
    $student_id = session()->get('student_id');

    $exam = CreateExams::with('getScholarship')->where('token', $request->token)->first();
    $duration = '+' . $exam->duration . ' Minutes';
    $examsub = ExamQuestions::with('getSubject')->where('exam_id', $exam->id)->select('subject_id')->distinct('subject_id')->first();

    $ae = AsignExam::where(['exam_id' => $exam->id, 'student_id' => $student_id])->first();
    if ($ae->attended == 0) {
      session()->put('student_test_start', true);
      $end_time = date("Y-m-d H:i:s", strtotime($duration));
      session()->put('end_time', $end_time);
      $ae->attended = 1;
      $ae->attended_at = date("Y-m-d H:i:s");
      $ae->save();
      return redirect('test/' . $request->token . '/' . $examsub->getSubject->id);
    } else {
      session()->flash('emsg', 'You already attended this test.');
      return redirect('student/attended-test/' . $ae->id);
    }
  }
  public function submitStartTesta(Request $request)
  {
    // printArray($request->all());
    // die;
    $student_id = session()->get('student_id');

    $exam = CreateExams::with('getScholarship')->where('token', $request->token)->first();
    $duration = '+' . $exam->duration . ' Minutes';
    $examsub = ExamQuestions::with('getSubject')->where('exam_id', $exam->id)->select('subject_id')->distinct('subject_id')->first();

    $ae = AsignExam::where(['exam_id' => $exam->id, 'student_id' => $student_id])->first();
    if ($ae->attended == 0) {
      session()->put('student_test_start', true);
      $end_time = date("Y-m-d H:i:s", strtotime($duration));
      session()->put('end_time', $end_time);
      $ae->attended = 1;
      $ae->attended_at = date("Y-m-d H:i:s");
      $ae->save();
      $url = 'test/' . $request->token . '/' . $examsub->getSubject->id;
      return response()->json(['status' => 'start', 'url' => $url]);
    } else {
      session()->flash('emsg', 'You already attended this test.');
      $url = 'student/attended-test/' . $ae->id;
      return response()->json(['status' => 'attended', 'url' => $url]);
    }
  }
  public function test($token, $section_id = null, $question_id = null)
  {
    $ct = date('Y-m-d H:i:s');
    if (session()->has('student_test_start')) {
      // $end_time = date("Y-m-d H:i:s", strtotime(" +10 Minutes"));
      // session()->put('end_time', $end_time);
      $student_id = session()->get('student_id');
      $student = Student::find($student_id);

      $exam = CreateExams::with('getScholarship')->where('token', $token)->firstOrFail();
      // printArray($exam->toArray());
      // die;
      $ae = AsignExam::where(['exam_id' => $exam->id, 'student_id' => $student_id])->first();

      $examsub = ExamQuestions::with('getSubject')->where('exam_id', $exam->id)->select('subject_id')->distinct('subject_id')->orderBy('id', 'asc')->get();
      if ($section_id == null) {
        $lastVisitQuestion = AnswerSheet::where(['exam_id' => $exam->id, 'student_id' => $student_id])->orderBy('id', 'desc')->first();
        if ($lastVisitQuestion) {
          $section_id = $lastVisitQuestion->subject_id;
          $questionId = $lastVisitQuestion->question_id;
          return redirect('test/' . $exam->token . '/' . $section_id . '/' . $questionId);
        } else {
          $section_id = $examsub[0]->getSubject->id;
          return redirect('test/' . $exam->token . '/' . $section_id);
        }
      }
      $currentSubject = Subjects::find($section_id);
      $ques_num = ExamQuestions::where(['exam_id' => $exam->id, 'subject_id' => $section_id])->get();
      $q_id = $ques_num[0]->id;
      if ($question_id == null) {
        $q_id = $ques_num[0]->id;
      } else {
        $q_id = $question_id;
      }
      $ques_det = ExamQuestions::find($q_id);
      // get previous user id
      $previous = ExamQuestions::where('exam_id', $exam->id)->where('id', '<', $q_id)->max('id');

      // get next user id
      $next = ExamQuestions::where('exam_id', $exam->id)->where('id', '>', $q_id)->min('id');
      if ($next === NULL) {
        $next = ExamQuestions::where('exam_id', $exam->id)->where('id', '<', $q_id)->min('id');
      }

      $nqd = ExamQuestions::where('id', $next)->select('subject_id')->first();
      // printArray($next);
      // printArray($nqd->toArray());
      // die;

      $where = [
        'student_id' => $student_id,
        'exam_id' => $exam->id,
        'question_id' => $q_id,
      ];
      $arr = [
        'student_id' => $student_id,
        'exam_id' => $exam->id,
        'subject_id' => $section_id,
        'question_id' => $q_id,
        'last_visit_at' => date('Y-m-d H:i:s'),
        'total_time_taken' => 0,
      ];
      $AnswerSheet = AnswerSheet::updateOrCreate($where, $arr);

      $total_question = ExamQuestions::where(['exam_id' => $exam->id])->count();

      $total_visited = AnswerSheet::where(['student_id' => $student_id, 'exam_id' => $exam->id])->count();

      $answered_question = AnswerSheet::where(['student_id' => $student_id, 'exam_id' => $exam->id, 'marked' => 0])->where('answer', '!=', '')->count();

      $not_answered = AnswerSheet::where(['student_id' => $student_id, 'exam_id' => $exam->id, 'marked' => 0, 'answer' => null])->count();

      $marked_question = AnswerSheet::where(['student_id' => $student_id, 'exam_id' => $exam->id, 'marked' => 1, 'answer' => null])->count();

      $marked_and_answered = AnswerSheet::where(['student_id' => $student_id, 'exam_id' => $exam->id, 'marked' => 1])->where('answer', '!=', '')->count();

      //$not_visited = $total_question - $not_answered;
      $not_visited = $total_question - $total_visited;

      $data = compact('exam', 'examsub', 'ques_num', 'ques_det', 'student_id', 'q_id', 'next', 'nqd', 'student', 'section_id', 'AnswerSheet', 'answered_question', 'not_answered', 'not_visited', 'marked_question', 'marked_and_answered', 'ae', 'currentSubject');

      //if (session()->get('end_time') < $ct) {
      if ($ct > $exam->start_time && $ct < $exam->end_time) {
        return view('test.test')->with($data);
      } else {
        session()->flash('emsg', 'The test will start at ' . getFormattedDate($exam->start_time, 'd M Y - h:i A') . ' and end at ' . getFormattedDate($exam->end_time, 'd M Y - h:i A') . ' .');
        return redirect('profile/success');
      }
      // } else {
      //     return redirect('run-test/complete?asign=' . $ae->id);
      // }
    } else {
      //return "Faraz";
      return redirect('test/' . $token . '/instruction');
    }
  }
  public function saveAnswer(Request $request)
  {
    // printArray($request->all());
    // die;
    $student_id = session()->get('student_id');
    $where = ['exam_id' => $request['exam_id'], 'student_id' => $student_id, 'subject_id' => $request['subject_id'], 'question_id' => $request['question_id']];

    $ae = AnswerSheet::where($where)->first();
    $ae->answer = $request['answer'];
    if ($request['type'] == 'save') {
      if ($request['answer'] != '') {
        $ae->marked = 0;
      }
    }
    if ($request['type'] == 'mark') {
      $ae->marked = 1;
    }
    if (session()->has('student_test_start') && session()->has('end_time')) {
      return $ae->save();
    } else {
      return 'failed';
    }
  }
  public function complete(Request $request)
  {
    // printArray($request->all());
    // die;
    $ae = AsignExam::find($request->asign);
    $ae->submitted = 1;
    $ae->submitted_at = date('Y-m-d H:i:s');
    $ae->save();

    $emaildata = [
      'name' => $ae->getStudent->name,
    ];

    $dd = ['to' => $ae->getStudent->email, 'to_name' => $ae->getStudent->name, 'subject' => 'MBBS Scholarship 2025 – Exam Completed Successfully'];

    Mail::send(
      'mails.exam-complete-mail',
      $emaildata,
      function ($message) use ($dd) {
        $message->to($dd['to'], $dd['to_name']);
        $message->subject($dd['subject']);
        $message->priority(1);
      }
    );

    session()->forget('student_test_start');
    session()->forget('end_time');
    session()->flash('smsg', 'Test ended. We will send your result on your registred email id. Thank You.');
    return redirect('student/attended-test/' . $request->asign);
  }
  public function report(Request $request)
  {
    $where = ['exam_id' => $request['exam_id'], 'question_id' => $request['question_id'], 'student_id' => $request['student_id']];
    $chk = QuestionReport::where($where)->count();
    if ($chk == 0) {
      $ae = new QuestionReport;
      $ae->exam_id = $request['exam_id'];
      $ae->question_id = $request['question_id'];
      $ae->student_id = $request['student_id'];
      $ae->error_type = $request['error_type'];
      $ae->report = $request['report'];
      return $ae->save();
    } else {
      return 0;
    }
  }
}
