<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;

class ServicesC extends Controller
{
  public function index($id = null)
  {
    $rows = Services::all();
    if ($id != null) {
      $sd = Services::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/service/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/service');
      }
    } else {
      $ft = 'add';
      $url = url('admin/service/store');
      $title = 'Add New';
      $sd = '';
    }
    $data = compact('rows', 'sd', 'ft', 'url', 'title');
    return view('admin.services')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'file' => 'required|max:10000|mimes:jpg,jpeg,png,gif',
        'service_name' => 'required',
        'short_note' => 'required',
        'description' => 'required',
      ]
    );
    $field = new Services;
    if ($request->hasFile('file')) {
      $image_name = time() . '.' . $request->file('file')->getClientOriginalExtension();
      $request->file('file')->move('uploads/services/', $image_name);
      $image_path = 'uploads/services/' . $image_name;
      $field->image_path = $image_path;
      $field->image_name = $image_name;
    }
    $field->service_name = $request['service_name'];
    $field->slug = slugify($request['service_name']);
    $field->short_note = $request['short_note'];
    $field->description = $request['description'];
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/service');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = Services::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'file' => 'nullable|max:10000|mimes:jpg,jpeg,png,gif',
        'service_name' => 'required',
        'short_note' => 'required',
        'description' => 'required',
      ]
    );
    $field = Services::find($id);
    if ($request->hasFile('file')) {
      $image_name = time() . '.' . $request->file('file')->getClientOriginalExtension();
      $request->file('file')->move('uploads/services/', $image_name);
      $image_path = 'uploads/services/' . $image_name;
      $field->image_path = $image_path;
      $field->image_name = $image_name;
    }
    $field->service_name = $request['service_name'];
    $field->slug = slugify($request['service_name']);
    $field->short_note = $request['short_note'];
    $field->description = $request['description'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/service');
  }
}
