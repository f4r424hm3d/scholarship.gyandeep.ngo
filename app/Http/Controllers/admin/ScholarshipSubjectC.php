<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use App\Models\ScholarshipSubject;
use Illuminate\Http\Request;

class ScholarshipSubjectC extends Controller
{
  public function index($s_id, $id = null)
  {
    $rows = ScholarshipSubject::where('scholarship_id', $s_id)->get();
    $sch = Scholarship::find($s_id);
    if ($id != null) {
      $sd = ScholarshipSubject::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/scholarship/subject/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/scholarship/subject/' . $s_id);
      }
    } else {
      $ft = 'add';
      $url = url('admin/scholarship/subject/store');
      $title = 'Add New';
      $sd = '';
    }
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'sch');
    return view('backend.scholarship-subject')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    foreach ($request->spc_id as $key => $value) {
      $allRecord[] = [
        'scholarship_id' => $request->scholarship_id,
        'course_id' => $request->course_id,
        'spc_id' => $request->spc_id[$key],
        'created_at' => now(),
      ];
    }
    // printArray($allRecord);
    // die;
    ScholarshipSubject::insert($allRecord);
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/scholarship/subject/' . $request->scholarship_id);
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = ScholarshipSubject::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'scholarship_id' => 'required|numeric',
        'course_id' => 'required|numeric',
        'spc_id' => 'required|numeric',
      ]
    );
    $field = ScholarshipSubject::find($id);
    $field->scholarship_id = $request['scholarship_id'];
    $field->course_id = $request['course_id'];
    $field->spc_id = $request['spc_id'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/scholarship/subject/' . $request->scholarship_id);
  }
}
