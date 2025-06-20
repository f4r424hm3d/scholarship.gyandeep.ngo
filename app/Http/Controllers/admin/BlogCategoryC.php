<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryC extends Controller
{
  public function index($id = null)
  {
    $rows = BlogCategory::all();
    if ($id != null) {
      $sd = BlogCategory::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/blog-category/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/blog-category');
      }
    } else {
      $ft = 'add';
      $url = url('admin/blog-category/store');
      $title = 'Add New';
      $sd = '';
    }
    $data = compact('rows', 'sd', 'ft', 'url', 'title');
    return view('admin.blog-category')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'category_name' => 'required',
      ]
    );
    $field = new BlogCategory;
    $field->category_name = $request['category_name'];
    $field->category_slug = slugify($request['category_name']);
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/blog-category');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = BlogCategory::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'category_name' => 'required',
      ]
    );

    $field = BlogCategory::find($id);
    $field->category_name = $request['category_name'];
    $field->category_slug = slugify($request['category_name']);
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/blog-category');
  }
}
