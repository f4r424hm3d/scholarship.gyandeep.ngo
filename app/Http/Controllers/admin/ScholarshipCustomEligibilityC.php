<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Scholarship;
use App\Models\ScholarshipCustomEligibility;

class ScholarshipCustomEligibilityC extends Controller
{
    public function index($s_id, $id = null)
    {
        $rows = ScholarshipCustomEligibility::where('scholarship_id', $s_id)->get();
        $sch = Scholarship::find($s_id);
        if ($id != null) {
            $sd = ScholarshipCustomEligibility::find($id);
            if (!is_null($sd)) {
                $ft = 'edit';
                $url = url('/') . '/admin/scholarship/custom-eligibility/update/' . $id;
                $title = 'Update';
            } else {
                return redirect('admin/scholarship/custom-eligibility/' . $s_id);
            }
        } else {
            $ft = 'add';
            $url = url('/') . '/admin/scholarship/custom-eligibility/store';
            $title = 'Add New';
            $sd = '';
        }
        $data = compact('rows', 'sd', 'ft', 'url', 'title', 'sch');
        return view('backend.scholarship-custom-eligibility')->with($data);
    }
    public function store(Request $request)
    {
        //printArray($request->all());
        $request->validate(
            [
                'question' => 'required'
            ]
        );
        $field = new ScholarshipCustomEligibility;
        $field->scholarship_id = $request['scholarship_id'];
        $field->question = $request['question'];
        $field->save();
        session()->flash('smsg', 'New record has been added successfully.');
        return redirect('admin/scholarship/custom-eligibility/' . $request->scholarship_id);
    }
    public function delete($id)
    {
        //echo $id;
        echo $result = ScholarshipCustomEligibility::find($id)->delete();
    }
    public function update($id, Request $request)
    {
        // printArray($request->all());
        // die;
        $request->validate(
            [
                'question' => 'required'
            ]
        );
        $field = ScholarshipCustomEligibility::find($id);
        $field->scholarship_id = $request['scholarship_id'];
        $field->question = $request['question'];
        $field->save();
        session()->flash('smsg', 'Record has been updated successfully.');
        return redirect('admin/scholarship/custom-eligibility/' . $request->scholarship_id);
    }
}
