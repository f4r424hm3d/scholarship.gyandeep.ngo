<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AnswerSheet;
use App\Models\AppliedScholarship;
use App\Models\AsignExam;
use App\Models\Country;
use App\Models\CreateExams;
use App\Models\ExamQuestions;
use App\Models\Scholarship;
use App\Models\Student;
use App\Models\StudentExamOfferLatter;
use Illuminate\Http\Request;

class StudentProfileC extends Controller
{
  public function index(Request $request, $role, $studentId)
  {
    $countries = Country::all();
    $student = Student::find($studentId);
    $maritulStatuses = ['Single' => 'Single', 'Married' => 'Married'];
    $page_title = 'Student Profile';
    $ft = 'edit';
    $page_route = 'profile';

    $scholarships = Scholarship::where('deadline', '>=', date('Y-m-d'))->get();
    if (old('scholarship')) {
      $categories = CreateExams::where('scholarship_id', old('scholarship'))->groupBy('course_category_id')->inRandomOrder()->get();
    } else {
      $categories = null;
    }
    $data = compact('student', 'page_title', 'ft', 'page_route', 'countries', 'maritulStatuses', 'scholarships', 'categories', 'role');
    return view('common.student-profile', $data);
  }
  public function update(Request $request, $role)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'name' => 'required',
        'email' => 'required|email|unique:students,email,' . $request['id'],
        'c_code' => 'required|numeric',
        'mobile' => 'required|numeric',
        'marksheet_10_copy' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1025',
        'marksheet_12_copy' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1025',
        'aadhar_copy' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1025',
        'photo_copy' => 'nullable|mimes:jpg,jpeg,png|max:1025',
        'neet_result_copy' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1025',
        'passport_copy' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1025',
      ]
    );
    $field = Student::find($request['id']);
    $field->name = $request['name'];
    $field->c_code = $request['c_code'];
    $field->mobile = $request['mobile'];
    $field->father = $request['father'];
    $field->mother = $request['mother'];
    $field->parents_mobile = $request['parents_mobile'];
    $field->nationality = $request['nationality'];
    $field->gender = $request['gender'];
    $field->parents_occupation = $request['parents_occupation'];
    $field->dob = $request['dob'];
    $field->first_language = $request['first_language'];
    $field->marital_status = $request['marital_status'];
    $field->passport_number = $request['passport_number'];
    $field->passport_expiry_date = $request['passport_expiry_date'];
    $field->religion = $request['religion'];
    $field->address = $request['address'];
    $field->city = $request['city'];
    $field->state = $request['state'];
    $field->country = $request['country'];
    $field->zipcode = $request['zipcode'];

    $field->passing_year_10 = $request['passing_year_10'];
    $field->result_10 = $request['result_10'];
    $field->passing_year_12 = $request['passing_year_12'];
    $field->result_12 = $request['result_12'];
    $field->neet_passing_year = $request['neet_passing_year'];
    $field->neet_result = $request['neet_result'];

    if ($request->hasFile('marksheet_10_copy')) {
      $file = $request->file('marksheet_10_copy');
      $filename = time() . '_marksheet_10.' . $file->getClientOriginalExtension();
      $file->move('uploads/marksheet/', $filename);
      $field->marksheet_10_path = 'uploads/marksheet/' . $filename;
    }
    if ($request->hasFile('marksheet_12_copy')) {
      $file = $request->file('marksheet_12_copy');
      $filename = time() . '_marksheet_12.' . $file->getClientOriginalExtension();
      $file->move('uploads/marksheet/', $filename);
      $field->marksheet_12_path = 'uploads/marksheet/' . $filename;
    }
    if ($request->hasFile('aadhar_copy')) {
      $file = $request->file('aadhar_copy');
      $filename = time() . '_aadhar.' . $file->getClientOriginalExtension();
      $file->move('uploads/aadhar/', $filename);
      $field->aadhar_path = 'uploads/aadhar/' . $filename;
    }

    if ($request->hasFile('passport_copy')) {
      $file = $request->file('passport_copy');
      $filename = time() . '_passport.' . $file->getClientOriginalExtension();
      $file->move('uploads/passport/', $filename);
      $field->passport_path = 'uploads/passport/' . $filename;
    }
    if ($request->hasFile('neet_result_copy')) {
      $file = $request->file('neet_result_copy');
      $filename = time() . '_neet_result.' . $file->getClientOriginalExtension();
      $file->move('uploads/neet_result/', $filename);
      $field->neet_result_path = 'uploads/neet_result/' . $filename;
    }
    if ($request->hasFile('photo_copy')) {
      $file = $request->file('photo_copy');
      $filename = time() . '_photo.' . $file->getClientOriginalExtension();
      $file->move('uploads/student/', $filename);
      $field->photo_path = 'uploads/student/' . $filename;
    }
    $field->submit_application = 1;
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect($role . '/student/' . $field->id . '/profile');
  }
  public function scholarship(Request $request, $role, $studentId)
  {
    $student = Student::find($studentId);
    $as = AppliedScholarship::with('getExam')->where('std_id', $studentId)->get();
    $scholarships = Scholarship::where('deadline', '>=', date('Y-m-d'))->get();
    if (old('scholarship')) {
      $categories = CreateExams::where('scholarship_id', old('scholarship'))->groupBy('course_category_id')->inRandomOrder()->get();
    } else {
      $categories = null;
    }
    $ct = date('Y-m-d H:i:s');
    $ctp = strtotime(date('Y-m-d H:i:s'));
    $page_title = 'Student Scholarship';
    $ft = 'edit';
    $page_route = 'scholarship';
    $data = compact('student', 'page_title', 'ft', 'page_route', 'scholarships', 'categories', 'as', 'ct', 'ctp', 'role');
    return view('common.student-scholarship', $data);
  }
  public function exams(Request $request, $role, $studentId)
  {
    $student = Student::find($studentId);
    $where = ['student_id' => $studentId, 'attended' => 1];
    $rows = AsignExam::where($where)->with('getExamDet', 'getApplication')->get();
    $ct = date('Y-m-d H:i:s');
    $ctp = strtotime(date('Y-m-d H:i:s'));
    $page_title = 'Student Exams';
    $ft = 'edit';
    $page_route = 'exams';
    $data = compact('student', 'page_title', 'ft', 'page_route', 'rows', 'ct', 'ctp', 'role');
    return view('common.student-exams', $data);
  }
  public function examDetails(Request $request, $role, $studentId, $examId)
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

    $page_title = 'Attended Test Details';
    $ft = 'edit';
    $page_route = 'exams';

    $studentExamOfferLetter = StudentExamOfferLatter::where('exam_id', $examId)->get();

    //printArray($user_info->toArray());
    $data = compact('student', 'row', 'total_question', 'answered_question', 'not_answered', 'not_visited', 'marked_question', 'marked_and_answered', 'sectionDet', 'studentId', 'page_title', 'ft', 'page_route', 'examId', 'role', 'studentExamOfferLetter');
    return view('common.attended-test-details')->with($data);
  }
  public function updateScholarship(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'name' => 'required',
        'email' => 'required|email|unique:students,email,' . $request['id'],
        'c_code' => 'required|numeric',
        'mobile' => 'required|numeric',
        'marksheet_10_copy' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1025',
        'marksheet_12_copy' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1025',
        'aadhar_copy' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1025',
        'photo_copy' => 'nullable|mimes:jpg,jpeg,png|max:1025',
        'neet_result_copy' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1025',
        'passport_copy' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1025',
      ]
    );
    $field = Student::find($request['id']);
    $field->name = $request['name'];
    $field->c_code = $request['c_code'];
    $field->mobile = $request['mobile'];
    $field->father = $request['father'];
    $field->mother = $request['mother'];
    $field->parents_mobile = $request['parents_mobile'];
    $field->nationality = $request['nationality'];
    $field->gender = $request['gender'];
    $field->parents_occupation = $request['parents_occupation'];
    $field->dob = $request['dob'];
    $field->first_language = $request['first_language'];
    $field->marital_status = $request['marital_status'];
    $field->passport_number = $request['passport_number'];
    $field->passport_expiry_date = $request['passport_expiry_date'];
    $field->religion = $request['religion'];
    $field->address = $request['address'];
    $field->city = $request['city'];
    $field->state = $request['state'];
    $field->country = $request['country'];
    $field->zipcode = $request['zipcode'];

    $field->passing_year_10 = $request['passing_year_10'];
    $field->result_10 = $request['result_10'];
    $field->passing_year_12 = $request['passing_year_12'];
    $field->result_12 = $request['result_12'];
    $field->neet_passing_year = $request['neet_passing_year'];
    $field->neet_result = $request['neet_result'];

    if ($request->hasFile('marksheet_10_copy')) {
      $file = $request->file('marksheet_10_copy');
      $filename = time() . '_marksheet_10.' . $file->getClientOriginalExtension();
      $file->move('uploads/marksheet/', $filename);
      $field->marksheet_10_path = 'uploads/marksheet/' . $filename;
    }
    if ($request->hasFile('marksheet_12_copy')) {
      $file = $request->file('marksheet_12_copy');
      $filename = time() . '_marksheet_12.' . $file->getClientOriginalExtension();
      $file->move('uploads/marksheet/', $filename);
      $field->marksheet_12_path = 'uploads/marksheet/' . $filename;
    }
    if ($request->hasFile('aadhar_copy')) {
      $file = $request->file('aadhar_copy');
      $filename = time() . '_aadhar.' . $file->getClientOriginalExtension();
      $file->move('uploads/aadhar/', $filename);
      $field->aadhar_path = 'uploads/aadhar/' . $filename;
    }

    if ($request->hasFile('passport_copy')) {
      $file = $request->file('passport_copy');
      $filename = time() . '_passport.' . $file->getClientOriginalExtension();
      $file->move('uploads/passport/', $filename);
      $field->passport_path = 'uploads/passport/' . $filename;
    }
    if ($request->hasFile('neet_result_copy')) {
      $file = $request->file('neet_result_copy');
      $filename = time() . '_neet_result.' . $file->getClientOriginalExtension();
      $file->move('uploads/neet_result/', $filename);
      $field->neet_result_path = 'uploads/neet_result/' . $filename;
    }
    if ($request->hasFile('photo_copy')) {
      $file = $request->file('photo_copy');
      $filename = time() . '_photo.' . $file->getClientOriginalExtension();
      $file->move('uploads/student/', $filename);
      $field->photo_path = 'uploads/student/' . $filename;
    }
    $field->submit_application = 1;
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect($request->role . '/student/' . $field->id . '/profile');
  }
}
