<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FollowUpType;
use Illuminate\Http\Request;

class FollowUpTypeC extends Controller
{
  public function index($id = null)
  {
    $rows = FollowUpType::all();
    // printArray($rows->toArray());
    // die;
    if ($id != null) {
      $sd = FollowUpType::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/follow-up-type/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/follow-up-type');
      }
    } else {
      $ft = 'add';
      $url = url('admin/follow-up-type/store');
      $title = 'Add New';
      $sd = '';
    }
    $data = compact('rows', 'sd', 'ft', 'url', 'title');
    return view('admin.follow-up-type')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'followup_type' => 'required|unique:follow_up_types,followup_type',
      ]
    );
    $field = new FollowUpType;
    $field->followup_type = $request['followup_type'];
    $field->followup_type_slug = slugify($request['followup_type']);
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/follow-up-type');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = FollowUpType::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'followup_type' => 'required|unique:follow_up_types,followup_type,' . $id,
      ]
    );
    $field = FollowUpType::find($id);
    $field->followup_type = $request['followup_type'];
    $field->followup_type_slug = slugify($request['followup_type']);
    $res = $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/follow-up-type');
  }
}
