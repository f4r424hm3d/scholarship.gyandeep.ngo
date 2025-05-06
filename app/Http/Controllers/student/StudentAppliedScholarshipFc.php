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

        $as = AppliedScholarship::with('getScholarship', 'getLevel', 'getCat', 'getSubject')->where('std_id', $id)->get();
        $data = compact('student', 'as');
        return view('front.student.applied-scholarship')->with($data);
    }
}
