<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Scholarship;
use App\Models\ScholarshipLevel;

class ScholarshipLevelC extends Controller
{
  public function index($s_id, $id = null)
  {
    $rows = ScholarshipLevel::where('scholarship_id', $s_id)->get();
    $sch = Scholarship::find($s_id);
    if ($id != null) {
      $sd = ScholarshipLevel::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/scholarship/level/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/scholarship/level/' . $s_id);
      }
    } else {
      $ft = 'add';
      $url = url('admin/scholarship/level/store');
      $title = 'Add New';
      $sd = '';
    }
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'sch');
    return view('backend.scholarship-level')->with($data);
  }
  public function store(Request $request)
  {
    //printArray($request->all());
    foreach ($request->level_id as $key => $value) {
      $allRecord[] = [
        'scholarship_id' => $request->scholarship_id,
        'level_id' => $request->level_id[$key],
        'created_at' => now()
      ];
    }
    // printArray($allRecord);
    // die;
    ScholarshipLevel::insert($allRecord);
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/scholarship/level/' . $request->scholarship_id);
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = ScholarshipLevel::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'scholarship_id' => 'required|numeric',
        'level_id' => 'required|numeric'
      ]
    );
    $field = ScholarshipLevel::find($id);
    $field->scholarship_id = $request['scholarship_id'];
    $field->level_id = $request['level_id'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/scholarship/level/' . $request->scholarship_id);
  }
}
