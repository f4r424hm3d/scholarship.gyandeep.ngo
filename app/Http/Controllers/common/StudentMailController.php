<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use App\Models\AnswerSheet;
use App\Models\AsignExam;
use App\Models\ExamQuestions;
use App\Models\ScholarshipLetterTemplate;
use App\Models\Student;
use App\Models\StudentExamOfferLatter;
use App\Models\StudentMail;
use App\Models\StudentScholarshipLetter;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class StudentMailController extends Controller
{
  public function index(Request $request, $role, $studentId)
  {
    $student = Student::find($studentId);
    $where = ['student_id' => $studentId];
    $rows = StudentMail::where($where)->orderBy('created_at', 'desc')->get();
    $templates = ScholarshipLetterTemplate::all();
    $page_title = 'Student Mails';
    $ft = 'add';
    $sd = '';
    $page_route = 'mails';
    $data = compact('student', 'page_title', 'ft', 'page_route', 'rows', 'role', 'sd', 'templates');
    return view('common.student-mails', $data);
  }
  public function sendMail(Request $request)
  {
    $request->validate(
      [
        'sent_to' => 'required|email',
        'cc' => 'nullable|email',
        'attach' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx|max:2048',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
      ]
    );
    $field = new StudentMail;
    $field->student_id = $request['student_id'];
    if ($request->role == 'admin') {
      $field->sender = session('adminLoggedIn')['user_id'];
    } else {
      $field->sender = session('userLoggedIn')['user_id'];
    }
    $field->sent_to = $request['sent_to'];
    $field->cc = $request['cc'];
    $field->subject = $request['subject'];
    $field->message = $request['message'];
    $field->token = Str::random(20);
    $field->save();

    $emaildata = [
      'mailMessage' => $request->message,
    ];
    $student = Student::find($request->student_id);

    $dd = ['to' => $request->sent_to, 'to_name' => $student->name, 'cc' => $request->cc, 'subject' => $request->subject];

    Mail::send(
      'mails.blank-template',
      $emaildata,
      function ($message) use ($dd) {
        $message->to($dd['to'], $dd['to_name']);
        if (!empty($dd['cc'])) {
          $message->cc($dd['cc']);
        }
        $message->subject($dd['subject']);
        $message->priority(1);
        if (request()->hasFile('attach')) {
          $message->attach(request()->file('attach'), [
            'as' => request()->file('attach')->getClientOriginalName(),
            'mime' => request()->file('attach')->getMimeType(),
          ]);
        }
      }
    );

    session()->flash('smsg', 'Mail has been sent successfully.');
    return redirect($request->role . '/student/' . $student->id . '/mails');
  }

  public function sendLetter(Request $request)
  {
    $request->validate(
      [
        'sent_to' => 'required|email',
        'cc' => 'nullable|email',
        'attach' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx|max:2048',
      ]
    );
    $field = new StudentExamOfferLatter();
    $field->exam_id = $request['exam_id'];
    // if ($request->role == 'admin') {
    //   $field->sender = session('adminLoggedIn')['user_id'];
    // } else {
    //   $field->sender = session('userLoggedIn')['user_id'];
    // }
    //$field->sent_to = $request['sent_to'];
    // $field->cc = $request['cc'];
    // $field->subject = $request['subject'];
    // $field->message = $request['message'];
    // $field->token = Str::random(20);


    $examId = $request->input('exam_id');
    $row = AsignExam::find($examId);
    $student = Student::find($row->student_id);
    $studentId = $student->id;

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

    $dd = ['to' => $student->email, 'to_name' => $student->name, 'cc' => $request->cc, 'subject' => '🎓 Your MBBS Scholarship Exam Result – 2025'];

    Mail::send(
      'mails.exam-result-mail',
      $emaildata,
      function ($message) use ($dd) {
        $message->to($dd['to'], $dd['to_name']);
        if (!empty($dd['cc'])) {
          $message->cc($dd['cc']);
        }
        $message->subject($dd['subject']);
        $message->priority(1);
        if (request()->hasFile('attach')) {
          $message->attach(request()->file('attach'), [
            'as' => request()->file('attach')->getClientOriginalName(),
            'mime' => request()->file('attach')->getMimeType(),
          ]);
        }
      }
    );

    if ($request->hasFile('attach')) {
      $file = $request->file('attach');
      $filename = slugify($student->name) . '_letter_' . time() . '.' . $file->getClientOriginalExtension();
      $file->move('uploads/scholarship/letters/', $filename);
      $field->letter_path = 'uploads/scholarship/letters/' . $filename;
    }
    $field->is_sent = 1;
    $field->save();
    return redirect($request->role . '/student/' . $student->id . '/exams/' . $request->exam_id)->with('smsg', 'Letter has been sent successfully.');
  }
}
