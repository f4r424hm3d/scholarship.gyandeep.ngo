<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LeadStatus;
use App\Models\LeadSubStatus;
use Illuminate\Http\Request;

class LeadSubStatusC extends Controller
{
  public function index($id = null)
  {
    $rows = LeadSubStatus::with('getStatus')->get();
    if ($id != null) {
      $sd = LeadSubStatus::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/lead-sub-status/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/lead-sub-status');
      }
    } else {
      $ft = 'add';
      $url = url('admin/lead-sub-status/store');
      $title = 'Add New';
      $sd = '';
    }
    $ls = LeadStatus::all();
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'ls');
    return view('admin.lead-sub-status')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'status' => 'required|numeric',
        'sub_status' => 'required',
      ]
    );
    $field = new LeadSubStatus;
    $field->status_id = $request['status'];
    $field->sub_status = $request['sub_status'];
    $field->sub_status_slug = slugify($request['sub_status']);
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/lead-sub-status');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = LeadSubStatus::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'status' => 'required|numeric',
        'sub_status' => 'required',
      ]
    );
    $field = LeadSubStatus::find($id);
    $field->status_id = $request['status'];
    $field->sub_status = $request['sub_status'];
    $field->sub_status_slug = slugify($request['sub_status']);
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/lead-sub-status');
  }
}
