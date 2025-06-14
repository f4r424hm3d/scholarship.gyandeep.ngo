<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\AppliedScholarship;
use App\Models\Student;

class StudentAppliedScholarshipFc extends Controller
{
  public function appliedScholarship()
  {

    $id = session()->get('student_id');

    $student = Student::find($id);

    $rows = AppliedScholarship::with('getExam')->where('std_id', $id)->get();
    // printArray($rows);
    // die();
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
    $ct = date('Y-m-d H:i:s');
    $ctp = strtotime(date('Y-m-d H:i:s'));
    $data = compact('student', 'rows', 'avatar', 'ct', 'ctp');
    return view('front.student.applied-scholarship')->with($data);
  }
}
