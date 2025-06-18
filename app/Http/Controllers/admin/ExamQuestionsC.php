<?php

namespace App\Http\Controllers\admin;

use App\Exports\ExamQuestionsExport;
use App\Http\Controllers\Controller;
use App\Imports\ExamQuestionsImport;
use App\Models\CreateExams;
use App\Models\ExamQuestions;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class ExamQuestionsC extends Controller
{
  public function index($exam_id, $id = null)
  {
    $rows = ExamQuestions::where('exam_id', $exam_id)->get();
    $exam = CreateExams::find($exam_id);
    if ($id != null) {
      $sd = ExamQuestions::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/exam-question/' . $exam_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/exam-question/' . $exam_id);
      }
    } else {
      $ft = 'add';
      $url = url('admin/exam-question/' . $exam_id . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $subjects = Subjects::all();
    $examDet = CreateExams::find($exam_id);
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'subjects', 'examDet');
    return view('admin.exam-questions')->with($data);
  }
  public function store($exam_id, Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'subject_id' => 'required|numeric',
        'question' => 'required',
        'a' => 'required',
        'b' => 'required',
        'c' => 'required',
        'd' => 'required',
        'answer' => 'required',
      ]
    );
    $field = new ExamQuestions;
    if ($request->hasFile('image')) {
      $imagename = time() . '.' . $request->file('image')->getClientOriginalExtension();
      $request->file('image')->move('uploads/exam/', $imagename);
      $image_path = 'uploads/exam/' . $imagename;
      $field->image = $image_path;
    }
    $field->exam_id = $exam_id;
    $field->subject_id = $request['subject_id'];
    $field->question = $request['question'];
    $field->a = $request['a'];
    $field->b = $request['b'];
    $field->c = $request['c'];
    $field->d = $request['d'];
    $field->answer = $request['answer'];
    $field->illustration = $request['illustration'];
    $field->direction = $request['direction'];
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/exam-question/' . $exam_id);
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = ExamQuestions::find($id)->delete();
  }
  public function update($exam_id, $id, Request $request)
  {
    $request->validate(
      [
        'subject_id' => 'required|numeric',
        'question' => 'required',
        'a' => 'required',
        'b' => 'required',
        'c' => 'required',
        'd' => 'required',
        'answer' => 'required',
      ]
    );
    $field = ExamQuestions::find($id);
    if ($request->hasFile('image')) {
      $imagename = time() . '.' . $request->file('image')->getClientOriginalExtension();
      $request->file('image')->move('uploads/exam/', $imagename);
      $image_path = 'uploads/exam/' . $imagename;
      $field->image = $image_path;
    }
    $field->subject_id = $request['subject_id'];
    $field->question = $request['question'];
    $field->a = $request['a'];
    $field->b = $request['b'];
    $field->c = $request['c'];
    $field->d = $request['d'];
    $field->answer = $request['answer'];
    $field->illustration = $request['illustration'];
    $field->direction = $request['direction'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/exam-question/' . $exam_id);
  }
  public function Import_x(Request $request)
  {
    // printArray($data->all());
    // die;
    $request->validate([
      'file' => 'required|mimes:xlsx,csv,xls',
      'exam_id' => 'required',
    ]);
    $file = $request->file;
    $exam_id = $request->exam_id;

    if ($file) {
      try {
        $result = Excel::import(new ExamQuestionsImport($exam_id), $file);
        // session()->flash('smsg', 'Data has been imported succesfully.');
        return redirect('admin/exam-question/' . $exam_id);
      } catch (\Exception $ex) {
        dd($ex);
      }
    }
  }

  public function import(Request $request)
  {
    $request->validate([
      'file' => 'required|mimes:xlsx,csv,xls',
      'exam_id' => 'required|exists:create_exams,id',
    ]);

    $file = $request->file('file');
    $exam_id = $request->input('exam_id');

    if ($file) {
      try {
        Excel::import(new ExamQuestionsImport($exam_id), $file);
        return redirect('admin/exam-question/' . $exam_id);
      } catch (\Exception $ex) {
        Log::error('Exam Import Error: ' . $ex->getMessage());
        session()->flash('emsg', 'An error occurred during import. Please check the file format and try again.');
        return back();
      }
    }

    session()->flash('emsg', 'No file selected.');
    return back();
  }


  public function Export($exam_id)
  {
    // printArray($data->all());
    // die;

    $exam_id = $exam_id;

    //$result = Excel::import(new ExamQuestionsImport($exam_id), $file);
    return Excel::download(new ExamQuestionsExport($exam_id), 'exam-papper-questions.xlsx');
    //return (new ExamQuestionsExport($exam_id))->download('exam-papper.xlsx');

    // session()->flash('smsg', 'Data has been imported succesfully.');
    //return redirect('admin/exam-question/' . $exam_id);


  }
}
