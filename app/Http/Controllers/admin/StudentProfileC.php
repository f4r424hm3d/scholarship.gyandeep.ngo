<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentProfileC extends Controller
{
  public function index(Request $request, $studentId)
  {
    $student = Student::find($studentId);
    $page_title = 'Student Profile';
    $ft = 'edit';
    $page_route = 'student';
    $data = compact('student', 'page_title', 'ft', 'page_route');
    return view('backend.student-profile', $data);
  }
}
