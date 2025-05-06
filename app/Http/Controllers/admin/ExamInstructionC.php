<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CreateExams;
use App\Models\ExamInstruction;
use App\Models\Subjects;
use Illuminate\Http\Request;

class ExamInstructionC extends Controller
{
    public function index($exam_id, $id = null)
    {
        $rows = ExamInstruction::where('exam_id', $exam_id)->get();
        $exam = CreateExams::find($exam_id);
        if ($id != null) {
            $sd = ExamInstruction::find($id);
            if (!is_null($sd)) {
                $ft = 'edit';
                $url = url('admin/exam-instruction/' . $exam_id . '/update/' . $id);
                $title = 'Update';
            } else {
                return redirect('admin/exam-instruction/' . $exam_id);
            }
        } else {
            $ft = 'add';
            $url = url('admin/exam-instruction/' . $exam_id . '/store');
            $title = 'Add New';
            $sd = '';
        }
        $subjects = Subjects::all();
        $examDet = CreateExams::find($exam_id);
        $data = compact('rows', 'sd', 'ft', 'url', 'title', 'subjects', 'examDet');
        return view('backend.exam-instruction')->with($data);
    }
    public function store($exam_id, Request $request)
    {
        // printArray($request->all());
        // die;
        $request->validate(
            [
                'subject_id' => 'required|array',
                'subject_id.*' => 'required|numeric|distinct',
                'noq' => 'required|numeric',
                'max_marks' => 'required|numeric',
                'p_marks' => 'required|numeric',
                'n_marks' => 'required|numeric',
            ]
        );
        $subject_id = $request['subject_id'];
        for ($i = 0; $i < count($subject_id); $i++) {
            $field = new ExamInstruction;
            $field->exam_id = $exam_id;
            $field->subject_id = $subject_id[$i];
            $field->noq = $request['noq'];
            $field->max_marks = $request['max_marks'];
            $field->p_marks = $request['p_marks'];
            $field->n_marks = $request['n_marks'];
            $field->save();
        }
        session()->flash('smsg', 'New record has been added successfully.');
        return redirect('admin/exam-instruction/' . $exam_id);
    }
    public function delete($id)
    {
        //echo $id;
        echo $result = ExamInstruction::find($id)->delete();
    }
    public function update($exam_id, $id, Request $request)
    {
        $request->validate(
            [
                'subject_id' => 'required|numeric',
                'noq' => 'required|numeric',
                'max_marks' => 'required|numeric',
                'p_marks' => 'required|numeric',
                'n_marks' => 'required|numeric',
            ]
        );
        $field = ExamInstruction::find($id);
        $field->subject_id = $request['subject_id'];
        $field->noq = $request['noq'];
        $field->max_marks = $request['max_marks'];
        $field->p_marks = $request['p_marks'];
        $field->n_marks = $request['n_marks'];
        $field->save();
        session()->flash('smsg', 'Record has been updated successfully.');
        return redirect('admin/exam-instruction/' . $exam_id);
    }
}
