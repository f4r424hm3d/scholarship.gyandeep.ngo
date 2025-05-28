<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CreateExams;
use App\Models\Scholarship;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentProfileC extends Controller
{
  public function index(Request $request, $studentId)
  {
    $countries = Country::all();
    $student = Student::find($studentId);
    $maritulStatuses = ['Single' => 'Single', 'Married' => 'Married'];
    $page_title = 'Student Profile';
    $ft = 'edit';
    $page_route = 'student';

    $scholarships = Scholarship::where('deadline', '>=', date('Y-m-d'))->get();
    if (old('scholarship')) {
      $categories = CreateExams::where('scholarship_id', old('scholarship'))->groupBy('course_category_id')->inRandomOrder()->get();
    } else {
      $categories = null;
    }
    $data = compact('student', 'page_title', 'ft', 'page_route', 'countries', 'maritulStatuses', 'scholarships', 'categories');
    return view('backend.student-profile', $data);
  }
}
