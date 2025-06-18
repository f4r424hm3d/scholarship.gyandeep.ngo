<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LeadType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeadTypeC extends Controller
{
  public function index($id = null)
  {
    $rows = LeadType::with('getLeadCount')->get();
    // printArray($rows->toArray());
    // die;
    if ($id != null) {
      $sd = LeadType::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/lead-type/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/lead-type');
      }
    } else {
      $ft = 'add';
      $url = url('admin/lead-type/store');
      $title = 'Add New';
      $sd = '';
    }
    $data = compact('rows', 'sd', 'ft', 'url', 'title');
    return view('admin.lead-type')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'title' => 'required|unique:lead_types,title',
      ]
    );
    $field = new LeadType;
    $field->created_by = session()->get('adminLoggedIn')['user_id'];

    $field->title = $request['title'];
    $field->slug = slugify($request['title']);
    $field->quick_view = 0;

    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/lead-type');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = LeadType::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'title' => 'required|unique:lead_types,title,' . $id,
      ]
    );

    $field = LeadType::find($id);
    $old_lt = $field->slug;
    //die;
    $field->title = $request['title'];
    $field->slug = slugify($request['title']);
    $res = $field->save();
    if ($res) {
      $field = DB::table('students')->where('lead_type', $old_lt)->update(['lead_type' => slugify($request['title'])]);
    }
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/lead-type');
  }
}
