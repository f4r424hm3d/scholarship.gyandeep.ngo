<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\AnswerSheet;
use App\Models\AsignExam;
use App\Models\ExamQuestions;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentFc extends Controller
{
    public function profile()
    {
        $id = session()->get('student_id');
        $student = Student::find($id);
        $data = compact('student');
        return view('front.student.profile')->with($data);
    }
    public function editProfile()
    {
        $id = session()->get('student_id');
        $student = Student::find($id);
        $data = compact('student');
        return view('front.student.edit-profile')->with($data);
    }
    public function updateProfile(Request $data)
    {
        $data->validate(
            [
                'name' => 'required|regex:/^[a-zA-Z ]*$/',
                'gender' => 'required|in:Male,Female,Other',
                'c_code' => 'required|numeric',
                'mobile' => 'required|numeric',
                'dob' => 'required|date',
                'nationality' => 'required',
                'city' => 'regex:/^[a-zA-Z ]*$/',
                'state' => 'regex:/^[a-zA-Z ]*$/',
                'country' => 'regex:/^[a-zA-Z ]*$/',
            ]
        );
        $field = Student::find($data['id']);
        $field->name = $data['name'];
        $field->gender = $data['gender'];
        $field->dob = $data['dob'];
        $field->nationality = $data['nationality'];
        $field->c_code = $data['c_code'];
        $field->mobile = $data['mobile'];
        $field->city = $data['city'];
        $field->state = $data['state'];
        $field->country = $data['country'];
        $field->save();
        session()->flash('smsg', 'Record has been updated successfully.');
        return redirect('profile');
    }
    public function viewChangePassword()
    {
        $id = session()->get('student_id');
        $student = Student::find($id);
        $data = compact('student');
        return view('front.student.change-password')->with($data);
    }
    public function changePassword(Request $data)
    {
        $id = session()->get('student_id');
        $student = Student::find($id);

        $data->validate(
            [
                'old_password' => 'required|in:' . $student->password,
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
        //printArray($rows->toArray());
        $data = compact('student', 'rows');
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
        $data = compact('student', 'row', 'total_question', 'answered_question', 'not_answered', 'not_visited', 'marked_question', 'marked_and_answered','sectionDet','student_id');
        return view('front.student.attended-test-details')->with($data);
    }
    public function success()
    {
        $id = session()->get('student_id');
        $student = Student::find($id);
        $data = compact('student');
        return view('front.student.test-complete')->with($data);
    }
}
