<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FollowUpStatus;
use Illuminate\Http\Request;

class FollowUpStatusC extends Controller
{
    public function index($id = null)
    {
        $rows = FollowUpStatus::all();
        // printArray($rows->toArray());
        // die;
        if ($id != null) {
            $sd = FollowUpStatus::find($id);
            if (!is_null($sd)) {
                $ft = 'edit';
                $url = url('admin/follow-up-status/update/' . $id);
                $title = 'Update';
            } else {
                return redirect('admin/follow-up-status');
            }
        } else {
            $ft = 'add';
            $url = url('admin/follow-up-status/store');
            $title = 'Add New';
            $sd = '';
        }
        $data = compact('rows', 'sd', 'ft', 'url', 'title');
        return view('backend.follow-up-status')->with($data);
    }
    public function store(Request $request)
    {
        // printArray($request->all());
        // die;
        $request->validate(
            [
                'followup_status' => 'required|unique:follow_up_statuses,followup_status',
            ]
        );
        $field = new FollowUpStatus;
        $field->followup_status = $request['followup_status'];
        $field->followup_status_slug = slugify($request['followup_status']);
        $field->save();
        session()->flash('smsg', 'New record has been added successfully.');
        return redirect('admin/follow-up-status');
    }
    public function delete($id)
    {
        //echo $id;
        echo $result = FollowUpStatus::find($id)->delete();
    }
    public function update($id, Request $request)
    {
        $request->validate(
            [
                'followup_status' => 'required|unique:follow_up_statuses,followup_status,' . $id,
            ]
        );
        $field = FollowUpStatus::find($id);
        $field->followup_status = $request['followup_status'];
        $field->followup_status_slug = slugify($request['followup_status']);
        $res = $field->save();
        session()->flash('smsg', 'Record has been updated successfully.');
        return redirect('admin/follow-up-status');
    }
}
