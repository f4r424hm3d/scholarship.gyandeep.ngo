<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogC extends Controller
{
    public function index($id = null)
    {
        $rows = Blog::all();
        if ($id != null) {
            $sd = Blog::find($id);
            if (!is_null($sd)) {
                $ft = 'edit';
                $url = url('admin/blog/update/' . $id);
                $title = 'Update';
            } else {
                return redirect('admin/blog');
            }
        } else {
            $ft = 'add';
            $url = url('admin/blog/store');
            $title = 'Add New';
            $sd = '';
        }
        $bc = BlogCategory::all();
        $data = compact('rows', 'sd', 'ft', 'url', 'title', 'bc');
        return view('backend.blogs')->with($data);
    }
    public function store(Request $request)
    {
        // printArray($request->all());
        // die;
        $request->validate(
            [
                'file' => 'required|max:10000|mimes:jpg,jpeg,png,gif',
                'title' => 'required',
                'short_note' => 'required',
                'description' => 'required',
                'category_slug' => 'required',
            ],
            [
                'category_slug' => 'Category field is required.'
            ]
        );
        $field = new Blog;
        if ($request->hasFile('file')) {
            $image_name = time() . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->move('uploads/blogs/', $image_name);
            $image_path = 'uploads/blogs/' . $image_name;
            $field->image_path = $image_path;
            $field->image_name = $image_name;
        }
        $field->title = $request['title'];
        $field->slug = slugify($request['title']);
        $field->short_note = $request['short_note'];
        $field->description = $request['description'];
        $field->category_slug = $request['category_slug'];
        $field->save();
        session()->flash('smsg', 'New record has been added successfully.');
        return redirect('admin/blog');
    }
    public function delete($id)
    {
        //echo $id;
        echo $result = Blog::find($id)->delete();
    }
    public function update($id, Request $request)
    {
        $request->validate(
            [
                'file' => 'nullable|max:10000|mimes:jpg,jpeg,png,gif',
                'title' => 'required',
                'short_note' => 'required',
                'description' => 'required',
                'category_slug' => 'required',
            ],
            [
                'category_slug' => 'Category field is required.'
            ]
        );
        $field = Blog::find($id);
        if ($request->hasFile('file')) {
            $image_name = time() . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->move('uploads/blogs/', $image_name);
            $image_path = 'uploads/blogs/' . $image_name;
            $field->image_path = $image_path;
            $field->image_name = $image_name;
        }
        $field->title = $request['title'];
        $field->slug = slugify($request['title']);
        $field->short_note = $request['short_note'];
        $field->description = $request['description'];
        $field->category_slug = $request['category_slug'];
        $field->save();
        session()->flash('smsg', 'Record has been updated successfully.');
        return redirect('admin/blog');
    }
}
