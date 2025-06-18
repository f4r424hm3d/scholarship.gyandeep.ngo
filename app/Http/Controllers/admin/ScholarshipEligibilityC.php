<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Scholarship;
use App\Models\ScholarshipEligibility;

class ScholarshipEligibilityC extends Controller
{
  public function index($s_id, $id = null)
  {
    $rows = ScholarshipEligibility::where('scholarship_id', $s_id)->get();
    $sch = Scholarship::find($s_id);
    if ($id != null) {
      $sd = ScholarshipEligibility::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/scholarship/eligibility/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/scholarship/eligibility/' . $s_id);
      }
    } else {
      $ft = 'add';
      $url = url('admin/scholarship/eligibility/store');
      $title = 'Add New';
      $sd = '';
    }
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'sch');
    return view('admin.scholarship-eligibility')->with($data);
  }
  public function store(Request $request)
  {
    //printArray($request->all());
    foreach ($request->country as $key => $value) {
      $allRecord[] = [
        'scholarship_id' => $request->scholarship_id,
        'country' => $request->country[$key],
        'created_at' => now()
      ];
    }
    // printArray($allRecord);
    // die;
    ScholarshipEligibility::insert($allRecord);
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/scholarship/eligibility/' . $request->scholarship_id);
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = ScholarshipEligibility::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'scholarship_id' => 'required|numeric',
        'country' => 'required'
      ]
    );
    $field = ScholarshipEligibility::find($id);
    $field->scholarship_id = $request['scholarship_id'];
    $field->country = $request['country'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/scholarship/eligibility/' . $request->scholarship_id);
  }
}
