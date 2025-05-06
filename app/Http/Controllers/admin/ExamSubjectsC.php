<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Subjects;
use Illuminate\Http\Request;

class ExamSubjectsC extends Controller
{
    public function index($id = null)
    {
        $rows = Subjects::all();
        // printArray($rows->toArray());
        // die;
        if ($id != null) {
            $sd = Subjects::find($id);
            if (!is_null($sd)) {
                $ft = 'edit';
                $url = url('admin/subjects/update/' . $id);
                $title = 'Update';
            } else {
                return redirect('admin/subjects/create');
            }
        } else {
            $ft = 'add';
            $url = url('admin/subjects/store');
            $title = 'Add New';
            $sd = '';
        }

        $data = compact('rows', 'sd', 'ft', 'url', 'title');
        return view('backend.create-subjects')->with($data);
    }
    public function store(Request $request)
    {
        // printArray($request->all());
        // die;
        $request->validate(
            [
                'subject' => 'required|unique:subjects,subject',
            ]
        );
        $field = new Subjects;
        $field->subject = $request['subject'];
        $field->subject_slug = slugify($request['subject']);
        $field->save();
        session()->flash('smsg', 'New record has been added successfully.');
        return redirect('admin/subjects/create');
    }
    public function delete($id)
    {
        //echo $id;
        echo $result = Subjects::find($id)->delete();
    }
    public function update($id, Request $request)
    {
        $request->validate(
            [
                'subject' => 'required|unique:subjects,subject,' . $id,
            ]
        );
        $field = Subjects::find($id);
        $field->subject = $request['subject'];
        $field->subject_slug = slugify($request['subject']);
        $field->save();
        session()->flash('smsg', 'Record has been updated successfully.');
        return redirect('admin/subjects/create');
    }
}
