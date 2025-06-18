<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LeadStatus;
use App\Models\LeadType;
use Illuminate\Http\Request;

class LeadStatusC extends Controller
{
  public function index($id = null)
  {
    $rows = LeadStatus::with('getLeadType')->get();
    if ($id != null) {
      $sd = LeadStatus::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/lead-status/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/lead-status');
      }
    } else {
      $ft = 'add';
      $url = url('admin/lead-status/store');
      $title = 'Add New';
      $sd = '';
    }
    $lt = LeadType::all();
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'lt');
    return view('admin.lead-status')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'title' => 'required|unique:lead_statuses,title',
      ]
    );
    $field = new LeadStatus;
    $field->title = $request['title'];
    $field->slug = slugify($request['title']);
    $field->move_to = $request['move_to'];

    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/lead-status');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = LeadStatus::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'title' => 'required|unique:lead_statuses,title,' . $id,
      ]
    );

    $field = LeadStatus::find($id);

    $field->title = $request['title'];
    $field->slug = slugify($request['title']);
    $field->move_to = $request['move_to'];

    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/lead-status');
  }
}
