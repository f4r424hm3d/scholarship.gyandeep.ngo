<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialC extends Controller
{
    public function index($id = null)
    {
        $rows = Testimonial::all();
        if ($id != null) {
            $sd = Testimonial::find($id);
            if (!is_null($sd)) {
                $ft = 'edit';
                $url = url('admin/testimonial/update/' . $id);
                $title = 'Update';
            } else {
                return redirect('admin/testimonial');
            }
        } else {
            $ft = 'add';
            $url = url('admin/testimonial/store');
            $title = 'Add New';
            $sd = '';
        }
        $data = compact('rows', 'sd', 'ft', 'url', 'title');
        return view('backend.testimonials')->with($data);
    }
    public function store(Request $request)
    {
        // printArray($request->all());
        // die;
        $request->validate(
            [
                'name' => 'required',
                'rating' => 'required|numeric',
                'designation' => 'required',
                'title' => 'required',
                'review' => 'required',
                'file' => 'required|max:10000|mimes:jpg,jpeg,png,gif',
            ]
        );
        $field = new Testimonial;
        if ($request->hasFile('file')) {
            $image_name = time() . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->move('uploads/testimonials/', $image_name);
            $image_path = 'uploads/testimonials/' . $image_name;
            $field->image_path = $image_path;
            $field->image_name = $image_name;
        }
        $field->name = $request['name'];
        $field->rating = $request['rating'];
        $field->designation = $request['designation'];
        $field->review = $request['review'];
        $field->title = $request['title'];
        $field->save();
        session()->flash('smsg', 'New record has been added successfully.');
        return redirect('admin/testimonial');
    }
    public function delete($id)
    {
        //echo $id;
        echo $result = Testimonial::find($id)->delete();
    }
    public function update($id, Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'rating' => 'required|numeric',
                'designation' => 'required',
                'title' => 'required',
                'review' => 'required',
                'file' => 'nullable|max:10000|mimes:jpg,jpeg,png,gif',
            ]
        );
        $field = Testimonial::find($id);
        if ($request->hasFile('file')) {
            $image_name = time() . '.' . $request->file('file')->getClientOriginalExtension();
            $image_path = $request->file('file')->move('uploads/testimonials/', $image_name);
            $field->image_path = $image_path;
        }
        $field->name = $request['name'];
        $field->rating = $request['rating'];
        $field->designation = $request['designation'];
        $field->review = $request['review'];
        $field->title = $request['title'];
        $field->save();
        session()->flash('smsg', 'Record has been updated successfully.');
        return redirect('admin/testimonial');
    }
}
