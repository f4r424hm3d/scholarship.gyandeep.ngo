<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use App\Models\AnswerSheet;
use App\Models\AsignExam;
use App\Models\ExamQuestions;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StudentResultController extends Controller
{
  public function index(Request $request, $studentId, $examId)
  {
    $student = Student::find($studentId);
    $where = ['student_id' => $studentId, 'id' => $examId];
    $row = AsignExam::where($where)->with('getExamDet')->firstOrFail();

    $total_question = ExamQuestions::where(['exam_id' => $row->exam_id])->count();

    $total_visited = AnswerSheet::where(['student_id' => $studentId, 'exam_id' => $row->exam_id])->count();

    $answered_question = AnswerSheet::where(['student_id' => $studentId, 'exam_id' => $row->exam_id, 'marked' => 0])->where('answer', '!=', '')->count();

    $not_answered = AnswerSheet::where(['student_id' => $studentId, 'exam_id' => $row->exam_id, 'marked' => 0, 'answer' => null])->count();

    $marked_question = AnswerSheet::where(['student_id' => $studentId, 'exam_id' => $row->exam_id, 'marked' => 1, 'answer' => null])->count();

    $marked_and_answered = AnswerSheet::where(['student_id' => $studentId, 'exam_id' => $row->exam_id, 'marked' => 1])->where('answer', '!=', '')->count();

    $not_visited = $total_question - $total_visited;

    $sectionDet = ExamQuestions::with('getSubject')->where(['exam_id' => $row->exam_id])->groupBy('subject_id')->select('subject_id')->get();

    $scores = [];

    $grandTotal = 0;
    $grandCorrect = 0;

    foreach ($sectionDet as $ed) {
      $totalQuestion = ExamQuestions::where([
        'exam_id' => $row->exam_id,
        'subject_id' => $ed->subject_id,
      ])->count();

      $attempted = AnswerSheet::with('getAnswer')
        ->where([
          'student_id' => $studentId,
          'exam_id' => $row->exam_id,
          'subject_id' => $ed->subject_id,
        ])
        ->where('answer', '!=', '')->get();

      $correct = 0;

      foreach ($attempted as $ansd) {
        if ($ansd->answer == $ansd->getAnswer->answer) {
          $correct++;
        }
      }

      $scores[] = [
        'subject' => $ed->getSubject->subject,
        'total' => $totalQuestion,
        'attempted' => count($attempted),
        'correct' => $correct,
      ];

      $grandTotal += $totalQuestion;
      $grandCorrect += $correct;
    }

    $emaildata = [
      'name'        => $student->name,
      'scores'      => $scores,
      'grandTotal'  => $grandTotal,
      'grandCorrect' => $grandCorrect,
    ];

    $dd = ['to' => $student->email, 'to_name' => $student->name, 'subject' => '🎓 Your MBBS Scholarship Exam Result – 2025'];

    Mail::send(
      'mails.exam-result-mail',
      $emaildata,
      function ($message) use ($dd) {
        $message->to($dd['to'], $dd['to_name']);
        $message->subject($dd['subject']);
        $message->priority(1);
      }
    );
    return 1;
  }
}
