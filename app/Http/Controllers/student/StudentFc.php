<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\AnswerSheet;
use App\Models\AppliedScholarship;
use App\Models\AsignExam;
use App\Models\Country;
use App\Models\CreateExams;
use App\Models\ExamQuestions;
use App\Models\Scholarship;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StudentFc extends Controller
{
  public function profile()
  {
    $id = session()->get('student_id');
    $student = Student::find($id);
    $countries = Country::all();
    $scholarships = Scholarship::where('deadline', '>=', date('Y-m-d'))->get();
    if (old('scholarship')) {
      $categories = CreateExams::where('scholarship_id', old('scholarship'))->groupBy('course_category_id')->inRandomOrder()->get();
    } else {
      $categories = null;
    }

    if ($student->photo_path != '') {
      $avatar = $student->photo_path;
    } else {
      if ($student->gender == 'Male' || $student->gender == 'male') {
        $avatar = 'front/avatars/male.png';
      }
      if ($student->gender == 'Female' || $student->gender == 'female') {
        $avatar = 'front/avatars/female.png';
      }
      if ($student->gender == '' || is_null($student->gender)) {
        $avatar = 'front/avatars/default.png';
      }
    }

    $data = compact('student', 'countries', 'scholarships', 'categories', 'avatar');
    return view('front.student.profile')->with($data);
  }
  public function editProfile()
  {
    $id = session()->get('student_id');
    $student = Student::find($id);
    $data = compact('student');
    return view('front.student.edit-profile')->with($data);
  }
  public function updateProfile(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'name' => 'required|regex:/^[a-zA-Z ]*$/',
        'c_code' => 'required|numeric',
        'mobile' => 'required|numeric',
        'father' => 'required|regex:/^[a-zA-Z ]*$/',
        'mother' => 'required|regex:/^[a-zA-Z ]*$/',
        'parents_mobile' => 'required|numeric',
        'nationality' => 'required',
        'gender' => 'required|in:male,female,other',
        'parents_occupation' => 'required|regex:/^[a-zA-Z ]*$/',
        'dob' => 'required|date',
        'first_language' => 'required|regex:/^[a-zA-Z ]*$/',
        'marital_status' => 'required|regex:/^[a-zA-Z ]*$/',
        'passport_number' => 'nullable|regex:/^[a-zA-Z0-9, ]*$/',
        'passport_expiry' => 'nullable|date',
        'religion' => 'required|regex:/^[a-zA-Z ]*$/',
        'address' => 'required|regex:/^[a-zA-Z0-9, ]*$/',
        'city' => 'required|regex:/^[a-zA-Z ]*$/',
        'state' => 'required|regex:/^[a-zA-Z ]*$/',
        'country' => 'required|regex:/^[a-zA-Z ]*$/',
        'zipcode' => 'required|numeric',
        // Newly added fields
        'passing_year_10' => 'required|numeric|digits:4',
        'result_10' => ['required', 'string', 'not_regex:/<script\b/i'],
        'passing_year_12' => 'required|numeric|digits:4',
        'result_12' => ['required', 'string', 'not_regex:/<script\b/i'],
        'neet_passing_year' => 'nullable|numeric|digits:4',
        'neet_result' => ['nullable', 'string', 'not_regex:/<script\b/i'],

        'marksheet_10_copy' => 'required|mimes:pdf,jpg,jpeg,png|max:1025',
        'marksheet_12_copy' => 'required|mimes:pdf,jpg,jpeg,png|max:1025',
        'aadhar_copy' => 'required|mimes:pdf,jpg,jpeg,png|max:1025',
        'photo_copy' => 'required|mimes:jpg,jpeg,png|max:1025',
        'neet_result_copy' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1025',
        'passport_copy' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1025',

        'scholarship' => 'required',
        'course_category' => 'required',
        'exam_date' => 'required|date',
      ]
    );
    $field = Student::find(session()->get('student_id'));
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
    $field->passport_expiry_date = $request['passport_expiry'];
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
    $token = Str::random(25);

    // Check if scholarship already applied
    $existingApplication = AppliedScholarship::where('std_id', $field->id)
      ->where('scholarship_id', $request['scholarship'])
      ->where('exam_id', $request['course_category'])
      ->first();

    if (!$existingApplication) {
      $appliedScholarship = new AppliedScholarship;
      $appliedScholarship->std_id = $field->id;
      $appliedScholarship->scholarship_id = $request['scholarship'];
      $appliedScholarship->exam_id = $request['course_category'];
      $appliedScholarship->status = 1;
      $appliedScholarship->token = $token;
      $appliedScholarship->payment_status = 'Free';
      $field->mode_of_exam = 'Online';
      $field->exam_date = $request['exam_date'];
      $appliedScholarship->save();

      // Check if exam assignment already exists
      $existingAssign = AsignExam::where('student_id', $field->id)
        ->where('exam_id', $request['course_category'])
        ->where('application_id', $appliedScholarship->id)
        ->first();

      if (!$existingAssign) {
        $assignExam = new AsignExam;
        $assignExam->student_id = $field->id;
        $assignExam->exam_id = $request['course_category'];
        $assignExam->application_id = $appliedScholarship->id;
        $assignExam->save();
      }
      $login_link = url('email-login/?uid=' . $field->id . '&token=' . $field->remember_token);
      $emaildata = [
        'name' => $field->name,
        'id' => $field->id,
        'remember_token' => $field->remember_token,
        'login_link' => $login_link,
        'exam_date' => $request['exam_date'],
        'scholarship_name' => $appliedScholarship->getScholarship->name,
        'start_time' => $assignExam->getExamDet->start_time,
        'end_time' => $assignExam->getExamDet->end_time,
        'duration' => $assignExam->getExamDet->duration
      ];

      $dd = ['to' => $field->email, 'to_name' => $field->name, 'subject' => 'Scholarship Exam Registration Successful – Please Read Instructions & Start Your Exam'];

      Mail::send(
        'mails.application-success-mail',
        $emaildata,
        function ($message) use ($dd) {
          $message->to($dd['to'], $dd['to_name']);
          $message->subject($dd['subject']);
          $message->priority(1);
        }
      );
    }

    session()->flash('smsg', 'Scholarship application has been submitted successfully.');
    return redirect('profile');
  }

  public function viewChangePassword()
  {
    $id = session()->get('student_id');
    $student = Student::find($id);
    if ($student->photo_path != '') {
      $avatar = $student->photo_path;
    } else {
      if ($student->gender == 'Male' || $student->gender == 'male') {
        $avatar = 'front/avatars/male.png';
      }
      if ($student->gender == 'Female' || $student->gender == 'female') {
        $avatar = 'front/avatars/female.png';
      }
      if ($student->gender == '' || is_null($student->gender)) {
        $avatar = 'front/avatars/default.png';
      }
    }
    $data = compact('student', 'avatar');
    return view('front.student.change-password')->with($data);
  }
  public function changePassword(Request $data)
  {
    $id = session()->get('student_id');
    $student = Student::find($id);

    $data->validate(
      [
        // 'old_password' => 'required|in:' . $student->password,
        'new_password' => 'required|min:8',
        'confirm_new_password' => 'required|min:8|same:new_password',
      ]
    );
    $field = Student::find($data['id']);
    $field->password = $data['new_password'];
    $field->save();
    session()->flash('smsg', 'Password has been changed.');
    return redirect('profile');
  }
  public function tests()
  {
    $id = session()->get('student_id');
    $student = Student::find($id);
    $where = ['student_id' => $id, 'attended' => 0];
    $rows = AsignExam::where($where)->with('getExamDet', 'getApplication')->get();
    //printArray($rows->toArray());
    $data = compact('student', 'rows');
    return view('front.student.tests')->with($data);
  }
  public function attendedTests()
  {
    $id = session()->get('student_id');
    $student = Student::find($id);
    $where = ['student_id' => $id, 'attended' => 1];
    $rows = AsignExam::where($where)->with('getExamDet', 'getApplication')->get();
    if ($student->photo_path != '') {
      $avatar = $student->photo_path;
    } else {
      if ($student->gender == 'Male' || $student->gender == 'male') {
        $avatar = 'front/avatars/male.png';
      }
      if ($student->gender == 'Female' || $student->gender == 'female') {
        $avatar = 'front/avatars/female.png';
      }
      if ($student->gender == '' || is_null($student->gender)) {
        $avatar = 'front/avatars/default.png';
      }
    }
    //printArray($rows->toArray());
    $data = compact('student', 'rows', 'avatar');
    return view('front.student.attended-tests')->with($data);
  }
  public function attendedTestDetails($id)
  {
    $student_id = session()->get('student_id');
    $student = Student::find($student_id);
    $where = ['student_id' => $student_id, 'id' => $id];
    $row = AsignExam::where($where)->with('getExamDet')->firstOrFail();

    $total_question = ExamQuestions::where(['exam_id' => $row->exam_id])->count();

    $total_visited = AnswerSheet::where(['student_id' => $student_id, 'exam_id' => $row->exam_id])->count();

    $answered_question = AnswerSheet::where(['student_id' => $student_id, 'exam_id' => $row->exam_id, 'marked' => 0])->where('answer', '!=', '')->count();

    $not_answered = AnswerSheet::where(['student_id' => $student_id, 'exam_id' => $row->exam_id, 'marked' => 0, 'answer' => null])->count();

    $marked_question = AnswerSheet::where(['student_id' => $student_id, 'exam_id' => $row->exam_id, 'marked' => 1, 'answer' => null])->count();

    $marked_and_answered = AnswerSheet::where(['student_id' => $student_id, 'exam_id' => $row->exam_id, 'marked' => 1])->where('answer', '!=', '')->count();

    $not_visited = $total_question - $total_visited;

    $sectionDet = ExamQuestions::with('getSubject')->where(['exam_id' => $row->exam_id])->groupBy('subject_id')->select('subject_id')->get();

    //printArray($user_info->toArray());
    $data = compact('student', 'row', 'total_question', 'answered_question', 'not_answered', 'not_visited', 'marked_question', 'marked_and_answered', 'sectionDet', 'student_id');
    return view('front.student.attended-test-details')->with($data);
  }
  public function success()
  {
    $id = session()->get('student_id');
    $student = Student::find($id);
    $data = compact('student');
    return view('front.student.test-complete')->with($data);
  }
  public function getCourseCategories_x($scholarshipId)
  {
    $now = Carbon::now();
    $categories = CreateExams::where('scholarship_id', $scholarshipId)->groupBy('course_category_id')->inRandomOrder()->get();


    $output = '<option value="">Select Course Category</option>';
    foreach ($categories as $category) {
      $output .= '<option value="' . $category->id . '">' . $category->getCourseCategory->category . '</option>';
    }
    return response()->json($output);
  }
  public function getCourseCategories($scholarshipId)
  {
    $categoryIds = CreateExams::where('scholarship_id', $scholarshipId)
      ->select('course_category_id')
      ->distinct()
      ->inRandomOrder()
      ->pluck('course_category_id');

    $categories = collect();

    foreach ($categoryIds as $categoryId) {
      $randomExam = CreateExams::where('scholarship_id', $scholarshipId)
        ->where('course_category_id', $categoryId)
        ->inRandomOrder()
        ->first();

      if ($randomExam) {
        $categories->push($randomExam);
      }
    }

    $output = '<option value="">Select Course Category</option>';
    foreach ($categories as $category) {
      $output .= '<option value="' . $category->id . '">' . $category->getCourseCategory->category . '</option>';
    }

    return response()->json($output);
  }
}
