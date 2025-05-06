<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Models\ExamDateSchedule;
use App\Models\Scholarship;
use Illuminate\Http\Request;

class ExamDateScheduleC extends Controller
{
    public function index($id = null)
    {
        $rows = ExamDateSchedule::with('getScholarship', 'getCourseCategory')->get();
        if ($id != null) {
            $sd = ExamDateSchedule::find($id);
            if (!is_null($sd)) {
                $ft = 'edit';
                $url = url('admin/exam-schedule/update/' . $id);
                $title = 'Update';
            } else {
                return redirect('admin/exam-schedule');
            }
        } else {
            $ft = 'add';
            $url = url('admin/exam-schedule/store');
            $title = 'Add New';
            $sd = '';
        }
        $scholarships = Scholarship::all();
        $cc = CourseCategory::all();
        $data = compact('rows', 'sd', 'ft', 'url', 'title', 'scholarships', 'cc');
        return view('backend.exam-schedules')->with($data);
    }
    public function store(Request $request)
    {
        // printArray($request->all());
        // die;
        $request->validate(
            [
                'exam_date' => 'required|date',
                'scholarship' => 'required|numeric',
                "course_category" => "required|array",
                "course_category.*" => "required|numeric|distinct",
            ]
        );
        $cc = $request->course_category;
        for ($i = 0; $i < count($cc); $i++) {
            $field = new ExamDateSchedule;
            $field->scholarship_id = $request['scholarship'];
            $field->course_category_id = $cc[$i];
            $field->exam_date = $request['exam_date'];
            $field->save();
        }
        session()->flash('smsg', 'New record has been added successfully.');
        return redirect('admin/exam-schedule');
    }
    public function delete($id)
    {
        //echo $id;
        echo $result = ExamDateSchedule::find($id)->delete();
    }
    public function update($id, Request $request)
    {
        $request->validate(
            [
                'exam_date' => 'required|date',
                'scholarship' => 'required|numeric',
                "course_category" => "required|numeric",
            ]
        );
        $field = ExamDateSchedule::find($id);
        $field->scholarship_id = $request['scholarship'];
        $field->course_category_id = $request['course_category'];
        $field->exam_date = $request['exam_date'];
        $field->save();
        session()->flash('smsg', 'Record has been updated successfully.');
        return redirect('admin/exam-schedule');
    }
}
