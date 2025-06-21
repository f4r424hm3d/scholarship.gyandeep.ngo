<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use App\Models\AnswerSheet;
use App\Models\AsignExam;
use App\Models\ExamQuestions;
use App\Models\Student;
use App\Models\StudentScholarshipLetter;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StudentResultController extends Controller
{
  public function index(Request $request, $studentId, $examId)
  {
    $student = Student::find($studentId);
    $where = ['student_id' => $studentId, 'id' => $examId];
    $row = AsignExam::where($where)->with('getExamDet')->firstOrFail();

    $letter = StudentScholarshipLetter::where('student_id', $studentId)->first();
    // echo asset($letter->company->logo_path);
    // die;
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
    $pdfPath = null;
    if ($letter) {
      // Build the PDF
      $pdf = Pdf::loadView('pdf.scholarship-letter', [
        'letter' => $letter,
      ])->setPaper('A4', 'portrait');

      // Save PDF to a file
      $pdfPath = storage_path("app/public/scholarship_letter_{$student->id}.pdf");
      $pdf->save($pdfPath);
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
      function ($message) use ($dd, $pdfPath) {
        $message->to($dd['to'], $dd['to_name']);
        $message->subject($dd['subject']);
        $message->priority(1);
        if ($pdfPath && file_exists($pdfPath)) {
          $message->attach($pdfPath, [
            'as' => 'Scholarship-Letter.pdf',
            'mime' => 'application/pdf',
          ]);
        }
      }
    );
    // Clean up file if created
    if ($pdfPath && file_exists($pdfPath)) {
      unlink($pdfPath);
    }
    return 1;
  }
  public function test(Request $request, $studentId, $examId)
  {
    $student = Student::find($studentId);
    $where = ['student_id' => $studentId, 'id' => $examId];
    $row = AsignExam::where($where)->with('getExamDet')->firstOrFail();

    $letter = StudentScholarshipLetter::where('student_id', $studentId)->first();
    // echo asset($letter->company->logo_path);
    // die;
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
    $pdfPath = null;
    if ($letter) {
      // Build the PDF
      $pdf = Pdf::loadView('pdf.scholarship-letter', [
        'letter' => $letter,
      ])->setPaper('A4', 'portrait');

      // Save PDF to a file
      $pdfPath = storage_path("app/public/scholarship_letter_{$student->id}.pdf");
      $pdf->save($pdfPath);
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
      function ($message) use ($dd, $pdfPath) {
        $message->to($dd['to'], $dd['to_name']);
        $message->subject($dd['subject']);
        $message->priority(1);
        if ($pdfPath && file_exists($pdfPath)) {
          $message->attach($pdfPath, [
            'as' => 'Scholarship-Letter.pdf',
            'mime' => 'application/pdf',
          ]);
        }
      }
    );
    // Clean up file if created
    // if ($pdfPath && file_exists($pdfPath)) {
    //   unlink($pdfPath);
    // }
    echo "<img src=\"" . asset($letter->company->logo_path) . "\" />";
    echo "<br>";
    echo $dd['to'];
    return 1;
  }
}
