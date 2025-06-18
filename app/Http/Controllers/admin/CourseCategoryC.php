<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseCategory;

class CourseCategoryC extends Controller
{
  public function index($id = null)
  {
    $rows = CourseCategory::all();
    if ($id != null) {
      $sd = CourseCategory::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/cc/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/course-category');
      }
    } else {
      $ft = 'add';
      $url = url('admin/cc/store');
      $title = 'Add New';
      $sd = '';
    }
    $data = compact('rows', 'sd', 'ft', 'url', 'title');
    return view('admin.course-category')->with($data);
  }
  public function store(Request $data)
  {
    //printArray($data->all());
    $data->validate(
      [
        'category' => 'required'
      ]
    );
    $field = new CourseCategory;
    $field->category = $data['category'];
    $field->category_slug = slugify($data['category']);
    $field->status = 1;
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/course-category');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = CourseCategory::find($id)->delete();
  }
  public function update($id, Request $data)
  {
    $data->validate(
      [
        'category' => 'required'
      ]
    );
    $field = CourseCategory::find($id);
    $field->category = $data['category'];
    $field->category_slug = slugify($data['category']);
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/course-category');
  }
}
