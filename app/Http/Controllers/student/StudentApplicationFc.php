<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\AppliedScholarship;
use App\Models\AsignExam;
use App\Models\CreateExams;
use App\Models\Scholarship;
use App\Models\ScholarshipLevel;
use App\Models\ScholarshipSubject;
use App\Models\Student;
use App\Models\StudentAcademicsDetails;
use App\Models\StudentDocuments;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentApplicationFc extends Controller
{
  public function shortlist(Request $request)
  {
    $request->validate(
      [
        'scholarship_id' => 'numeric',
        'std_id' => 'numeric',
      ]
    );
    $chk = AppliedScholarship::where('std_id', '=', $request['std_id'])
      ->where('scholarship_id', '=', $request['scholarship_id'])->first();
    if ($chk != false) {
      echo $msg = 'shortlisted';
    } else {
      $field = new AppliedScholarship;
      $field->scholarship_id = $request['scholarship_id'];
      $field->std_id = $request['std_id'];
      $field->status = 0;
      $field->save();
      echo $msg = 'success';
    }
  }
  public function checkEligibility(Request $request)
  {
    //printArray($request->all());
    $totaleligibility = count($request->question);
    //echo "<br>";
    $totalPass = 0;
    foreach ($request->question as $key) {
      $totalPass += $key;
    }
    if ($totaleligibility == $totalPass) {
      session()->flash('smsg', 'Congratulation , You are eligibile to this scholarship. Proceed to apply.');
      return redirect('scholarship/' . $request->scholarship_id . '/' . $request->slug . '/apply');
    } else {
      session()->flash('emsg', 'Sorry , You are not eligible for this scholarship..');
      return redirect($request->back_url);
    }
  }
  public function apply(Request $request)
  {
    //return "Helo";
    //return view('front.student.student-full-details');
    $student_id = session()->get('student_id');
    $scholarship_id = $request->segment(2);
    $chksch = Scholarship::find($scholarship_id);
    if (is_null($chksch)) {
      return redirect('scholarships');
    } else {
      $where = ['scholarship_id' => $scholarship_id, 'std_id' => $student_id, 'status' => 1];
      $chkapp = AppliedScholarship::where($where)->first();
      if (is_null($chkapp)) {
        $slvl = ScholarshipLevel::with('getLevel')->where('scholarship_id', '=', $scholarship_id)->get();
        $scat = ScholarshipSubject::with('getCourse')->where('scholarship_id', '=', $scholarship_id)->select('course_id')->distinct()->get();
        $step = 1;
        $data = compact('step', 'slvl', 'scat');
        return view('front.student.examination-detail-form')->with($data);
      } else {
        session()->flash('smsg', 'Scholarship already applied.');
        return redirect('scholarship/' . $scholarship_id . '/' . $chksch->slug);
      }
    }
  }
  public function applyScholarship(Request $request)
  {
    $request->validate(
      [
        'level' => 'required|numeric',
        'category' => 'required|numeric',
        // 'subject' => 'required|numeric',
        'exam_date' => 'required|date',
        'mode_of_exam' => 'required',
      ]
    );
    $exam_id = $request['exam_id'];
    $token = Str::random(25);
    $chksch = Scholarship::find($request['scholarship_id']);
    if ($chksch->exam_type == 'Free') {
      $payment_status = 'Free';
    } else {
      $payment_status = 'Pending';
    }
    $chk = AppliedScholarship::where('std_id', '=', session()->get('student_id'))
      ->where('scholarship_id', '=', $request['scholarship_id'])->first();
    if (is_null($chk)) {
      $field = new AppliedScholarship;
    } else {
      if ($chk->status == 1) {
        session()->flash('smsg', 'Scholarship already applied.');
        return redirect('scholarship/' . $chksch->slug);
      } else {
        $field = AppliedScholarship::find($chk->id);
      }
    }
    $field->scholarship_id = $request['scholarship_id'];
    $field->exam_id = $exam_id;
    $field->std_id = session()->get('student_id');
    $field->status = 1;
    $field->level = $request['level'];
    $field->category = $request['category'];
    $field->subject = $request['subject'];
    $field->exam_date = $request['exam_date'];
    $field->mode_of_exam = $request['mode_of_exam'];
    $field->token = $token;
    $field->payment_status = $payment_status;
    $field->save();

    $asignexam = new AsignExam;
    $asignexam->student_id = session()->get('student_id');
    $asignexam->exam_id = $exam_id;
    $asignexam->application_id = $field->id;
    $asignexam->save();

    session()->flash('smsg', 'Scholarship applied succesfully. Please fill all the information');
    return redirect('scholarship/personal-details');
  }
  public function personalDetails(Request $request)
  {
    $student_id = session()->get('student_id');
    $student = Student::find($student_id);
    $step = 2;
    $data = compact('student', 'step');
    if ($student->pd == 0) {
      return view('front.student.student-personal-details')->with($data);
    } else {
      return view('front.student.student-personal-details')->with($data);
      //return redirect('scholarship/contact-details');
    }
  }
  public function addPersonalDetails(Request $request)
  {
    //printArray($request->all());die;
    $request->validate(
      [
        'name' => 'required|regex:/^[a-zA-Z ]*$/',
        'father' => 'required',
        'father_occupation' => 'required',
        'father_income' => 'required',
        'mother' => 'required',
        'mother_occupation' => 'required',
        'mother_income' => 'required',
        'gender' => 'required|in:Male,Female,Other',
        'dob' => 'required|date',
        'cast_category' => 'required|in:SC/ST,OBC,GENRAL',
        'handicaped' => 'required|in:Yes,No',
        'nationality' => 'required',
        'aadhar' => 'required|numeric',
      ]
    );
    $student_id = session()->get('student_id');
    $field = Student::find($student_id);
    $field->name = $request['name'];
    $field->father = $request['father'];
    $field->father_occupation = $request['father_occupation'];
    $field->father_income = $request['father_income'];
    $field->mother = $request['mother'];
    $field->mother_occupation = $request['mother_occupation'];
    $field->mother_income = $request['mother_income'];
    $field->gender = $request['gender'];
    $field->dob = $request['dob'];
    $field->cast_category = $request['cast_category'];
    $field->handicaped = $request['handicaped'];
    $field->nationality = $request['nationality'];
    $field->aadhar = $request['aadhar'];
    $field->passport_number = $request['passport_number'];
    $field->passport_expiry_date = $request['passport_expiry_date'];
    $field->pd = 1;
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('scholarship/contact-details');
  }
  public function contactDetails(Request $request)
  {
    $student_id = session()->get('student_id');
    $student = Student::find($student_id);
    $step = 3;
    $data = compact('student', 'step');
    if ($student->cd == 0) {
      return view('front.student.student-contact-details')->with($data);
    } else {
      return view('front.student.student-contact-details')->with($data);
      //return redirect('scholarship/academics-details');
    }
  }
  public function addContactDetails(Request $request)
  {
    $request->validate(
      [
        'c_code' => 'required|numeric',
        'mobile' => 'required|numeric',
        'parents_mobile' => 'required|numeric',
        'address' => 'required',
        'city' => 'required',
        'state' => 'required',
        'country' => 'required',
        'zipcode' => 'required|numeric',
        'parmanent_address' => 'required',
        'parmanent_city' => 'required',
        'parmanent_state' => 'required',
        'parmanent_country' => 'required',
        'parmanent_zipcode' => 'required|numeric',
        'alternative_mobile' => 'nullable|numeric',
      ]
    );
    $student_id = session()->get('student_id');
    $field = Student::find($student_id);
    $field->c_code = $request['c_code'];
    $field->mobile = $request['mobile'];
    $field->alternative_mobile = $request['alternative_mobile'];
    $field->parents_mobile = $request['parents_mobile'];
    $field->address = $request['address'];
    $field->city = $request['city'];
    $field->state = $request['state'];
    $field->country = $request['country'];
    $field->zipcode = $request['zipcode'];
    $field->parmanent_address = $request['parmanent_address'];
    $field->parmanent_city = $request['parmanent_city'];
    $field->parmanent_state = $request['parmanent_state'];
    $field->parmanent_country = $request['parmanent_country'];
    $field->parmanent_zipcode = $request['parmanent_zipcode'];
    $field->cd = 1;
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('scholarship/academics-details');
  }
  public function academicsDetails(Request $request)
  {
    $student_id = session()->get('student_id');
    $student = Student::find($student_id);

    $sad = StudentAcademicsDetails::where('student_id', '=', $student_id)->get();
    if ($sad->isEmpty()) {
      $csad = 0;
    } else {
      $csad = count($sad);
    }
    $step = 4;
    $data = compact('student', 'step', 'sad', 'csad');
    if ($student->ad == 0) {
      return view('front.student.student-academics-details')->with($data);
    } else {
      return view('front.student.student-academics-details')->with($data);
      //return redirect('scholarship/documents');
    }
  }
  public function addAcademicsDetails(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'class' => 'required',
        'board' => 'required',
        'passing_year' => 'required|numeric',
        'max_marks' => 'required|numeric',
        'obtained_marks' => 'required|numeric',
        'score' => 'required|numeric',
      ]
    );

    $student_id = session()->get('student_id');

    //$field = Student::find($student_id);
    $field = new StudentAcademicsDetails;

    $field->student_id = $student_id;
    $field->class = $request['class'];
    $field->board = $request['board'];
    $field->passing_year = $request['passing_year'];
    $field->max_marks = $request['max_marks'];
    $field->obtained_marks = $request['obtained_marks'];
    $field->score = $request['score'];
    //$field->ad = 1;
    $result = $field->save();
    if ($result) {
      $f = Student::find($student_id);
      $f->ad = 1;
      $f->save();
    }
    session()->flash('smsg', 'Record has been added successfully.');
    return redirect('scholarship/academics-details');
  }
  public function updateAcademicsDetails(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'class' => 'required',
        'board' => 'required',
        'passing_year' => 'required|numeric',
        'max_marks' => 'required|numeric',
        'obtained_marks' => 'required|numeric',
        'score' => 'required|numeric',
      ]
    );

    //$student_id = session()->get('student_id');

    //$field = Student::find($student_id);
    $field = StudentAcademicsDetails::find($request->id);

    //$field->student_id = $student_id;
    $field->class = $request['class'];
    $field->board = $request['board'];
    $field->passing_year = $request['passing_year'];
    $field->max_marks = $request['max_marks'];
    $field->obtained_marks = $request['obtained_marks'];
    $field->score = $request['score'];
    //$field->ad = 1;
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('scholarship/academics-details');
  }
  public function documents(Request $request)
  {
    $student_id = session()->get('student_id');
    $student = Student::find($student_id);

    $psp = StudentDocuments::where('student_id', $student_id)->where('document_name', '=', 'Passport Size Photograph')->get();
    $nid = StudentDocuments::where('student_id', $student_id)->where('document_name', '=', 'National Id')->get();
    $pp = StudentDocuments::where('student_id', $student_id)->where('document_name', '=', 'Passport')->get();
    $cast = StudentDocuments::where('student_id', $student_id)->where('document_name', '=', 'Cast Certificate')->get();
    $income = StudentDocuments::where('student_id', $student_id)->where('document_name', '=', 'Income Certificate')->get();
    $leveldoc = [];
    $sad = StudentAcademicsDetails::where('student_id', '=', $student_id)->get();
    foreach ($sad as $sad) {
      array_push($leveldoc, $sad->class);
    }
    $step = 5;
    $data = compact('student', 'step', 'sad', 'psp', 'nid', 'pp', 'cast', 'income', 'leveldoc');

    if ($student->ad == 0) {
      return view('front.student.student-documents')->with($data);
    } else {
      return view('front.student.student-documents')->with($data);
      //return redirect('scholarship/documents');
    }
  }
  public function uploadDocuments(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'document_name' => 'required',
        'file' => 'required|max:10000|mimes:jpg,jpeg,png,gif,pdf',
      ]
    );

    $student_id = session()->get('student_id');

    $field = new StudentDocuments;
    if ($request->hasFile('file')) {
      $file_name = time() . '.' . $request->file('file')->getClientOriginalExtension();
      $file_path = $request->file('file')->move('uploads/documents/', $file_name);
      $field->file_path = $file_path;
      $field->file_name = $file_name;
    }
    $field->document_name = $request->document_name;
    $field->student_id = $student_id;
    $res = $field->save();
    if ($res) {
      $student = Student::find($student_id);
      $student->doc = 1;
      $student->save();
    }
    session()->flash('smsg', 'File uploaded successfully.');
    return redirect('scholarship/documents');
  }
  public function getSpcByCatSch(Request $request)
  {
    //echo $id;
    $where = ['course_id' => $request['course_id'], 'scholarship_id' => $request['scholarship_id']];
    $field = ScholarshipSubject::with('getSubject')->where($where)->select('spc_id')->distinct()->get();
    $output = '<option value="">Select Subject</option>';
    foreach ($field as $row) {
      $output .= '<option value="' . $row->getSubject->id . '">' . $row->getSubject->specialization . '</option>';
    }
    echo $output;
  }
  public function getExamDateSchedule(Request $request)
  {
    //echo $id;
    $where = ['course_category_id' => $request['course_id'], 'scholarship_id' => $request['scholarship_id']];
    $today = date('Y-m-d');
    $field = CreateExams::where($where)->where('exam_date', '>=', $today)->get();
    $output = '<option value="">Select Date</option>';
    foreach ($field as $row) {
      $output .= '<option value="' . $row->exam_date . '">' . getFormattedDate($row->exam_date, 'd-M-Y') . '</option>';
    }
    echo $output;
  }
  public function getExamIdForStudent(Request $request)
  {
    //echo $id;
    $where = ['course_category_id' => $request['course_id'], 'scholarship_id' => $request['scholarship_id'], 'exam_date' => $request['exam_date']];
    $field = CreateExams::where($where)->first();
    echo $field->id;
  }
}
