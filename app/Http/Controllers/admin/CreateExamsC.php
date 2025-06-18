<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Models\CreateExams;
use App\Models\Scholarship;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CreateExamsC extends Controller
{
  public function index($id = null)
  {
    $today = date('Y-m-d h:i:s');
    $rows = CreateExams::where('end_time', '>=', $today)->get();
    // printArray($rows->toArray());
    // die;
    if ($id != null) {
      $sd = CreateExams::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/exams/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/exams/create');
      }
    } else {
      $ft = 'add';
      $url = url('admin/exams/store');
      $title = 'Add New';
      $sd = '';
    }
    $scholarships = Scholarship::all();
    $cc = CourseCategory::all();

    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'scholarships', 'cc');
    return view('admin.create-exams')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'scholarship' => 'required|numeric',
        'duration' => 'required|numeric',
        "course_category" => "required|array",
        "course_category.*" => "required|numeric|distinct",
        'exam_date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required',
      ]
    );
    $cc = $request->course_category;
    for ($i = 0; $i < count($cc); $i++) {
      $field = new CreateExams;
      $field->duration = $request['duration'];
      $field->scholarship_id = $request['scholarship'];
      $field->course_category_id = $cc[$i];
      $field->exam_date = $request['exam_date'];
      $field->start_time = $request['start_time'];
      $field->end_time = $request['end_time'];
      $field->token = Str::random(10);
      $field->save();
    }
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/exams/create');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = CreateExams::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'exam_date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required',
        'scholarship' => 'required|numeric',
        'course_category' => 'required|numeric',
        'duration' => 'required|numeric',
      ]
    );
    $field = CreateExams::find($id);
    $field->duration = $request['duration'];
    $field->scholarship_id = $request['scholarship'];
    $field->course_category_id = $request['course_category'];
    $field->exam_date = $request['exam_date'];
    $field->start_time = $request['start_time'];
    $field->end_time = $request['end_time'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/exams/create');
  }
  public function expiredExams()
  {
    $today = date('Y-m-d h:i:s');
    $rows = CreateExams::where('end_time', '<', $today)->get();
    $data = compact('rows');
    return view('admin.expired-exams')->with($data);
  }
}
