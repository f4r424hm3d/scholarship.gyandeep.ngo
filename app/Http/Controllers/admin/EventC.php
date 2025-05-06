<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventC extends Controller
{
    public function index($id = null)
    {
        $rows = Event::all();
        if ($id != null) {
            $sd = Event::find($id);
            if (!is_null($sd)) {
                $ft = 'edit';
                $url = url('admin/event/update/' . $id);
                $title = 'Update';
            } else {
                return redirect('admin/event');
            }
        } else {
            $ft = 'add';
            $url = url('admin/event/store');
            $title = 'Add New';
            $sd = '';
        }
        $data = compact('rows', 'sd', 'ft', 'url', 'title');
        return view('backend.events')->with($data);
    }
    public function store(Request $request)
    {
        // printArray($request->all());
        // die;
        $request->validate(
            [
                'post_by' => 'required',
                'event_date' => 'required|date',
                'time_start' => 'required',
                'time_end' => 'required',
                'file' => 'required|max:10000|mimes:jpg,jpeg,png,gif',
                'video_link' => 'url|nullable',
                'title' => 'required',
                'description' => 'required',
            ]
        );
        $field = new Event;
        if ($request->hasFile('file')) {
            $image_name = time() . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->move('uploads/events/', $image_name);
            $image_path = 'uploads/events/' . $image_name;
            $field->image_path = $image_path;
            $field->image_name = $image_name;
        }
        $field->post_by = $request['post_by'];
        $field->event_date = $request['event_date'];
        $field->time_start = $request['time_start'];
        $field->time_end = $request['time_end'];
        $field->video_link = $request['video_link'];
        $field->description = $request['description'];
        $field->title = $request['title'];
        $field->slug = slugify($request['title']);
        $field->save();
        session()->flash('smsg', 'New record has been added successfully.');
        return redirect('admin/event');
    }
    public function delete($id)
    {
        //echo $id;
        echo $result = Event::find($id)->delete();
    }
    public function update($id, Request $request)
    {
        $request->validate(
            [
                'post_by' => 'required',
                'event_date' => 'required|date',
                'time_start' => 'required',
                'time_end' => 'required',
                'file' => 'nullable|max:10000|mimes:jpg,jpeg,png,gif',
                'video_link' => 'url|nullable',
                'title' => 'required',
                'description' => 'required',
            ]
        );
        $field = Event::find($id);
        if ($request->hasFile('file')) {
            $image_name = time() . '.' . $request->file('file')->getClientOriginalExtension();
            $image_path = $request->file('file')->move('uploads/events/', $image_name);
            $field->image_path = $image_path;
        }
        $field->post_by = $request['post_by'];
        $field->event_date = $request['event_date'];
        $field->time_start = $request['time_start'];
        $field->time_end = $request['time_end'];
        $field->video_link = $request['video_link'];
        $field->description = $request['description'];
        $field->title = $request['title'];
        $field->slug = slugify($request['title']);
        $field->save();
        session()->flash('smsg', 'Record has been updated successfully.');
        return redirect('admin/event');
    }
}
