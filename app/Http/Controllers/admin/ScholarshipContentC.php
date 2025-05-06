<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\Request;

class ScholarshipContentC extends Controller
{
    public function index($id = null)
    {
        $rows = PageContent::where('page_name', 'scholarship')->get();
        if ($id != null) {
            $sd = PageContent::find($id);
            if (!is_null($sd)) {
                $ft = 'edit';
                $url = url('admin/scholarship/content/update/' . $id);
                $title = 'Update';
            } else {
                return redirect('admin/scholarship/content');
            }
        } else {
            $ft = 'add';
            $url = url('admin/scholarship/content/store');
            $title = 'Add New';
            $sd = '';
        }
        $data = compact('rows', 'sd', 'ft', 'url', 'title');
        return view('backend.scholarship-content')->with($data);
    }
    public function store(Request $request)
    {
        // printArray($request->all());
        // die;
        $request->validate(
            [
                'page_name' => 'required',
                'title' => 'required',
                'description' => 'required',
            ]
        );
        $field = new PageContent;
        $field->page_name = $request['page_name'];
        $field->title = $request['title'];
        $field->description = $request['description'];
        $field->save();
        session()->flash('smsg', 'New record has been added successfully.');
        return redirect('admin/scholarship/content');
    }
    public function delete($id)
    {
        //echo $id;
        echo $result = PageContent::find($id)->delete();
    }
    public function update($id, Request $request)
    {
        $request->validate(
            [
                'page_name' => 'required',
                'title' => 'required',
                'description' => 'required',
            ]
        );
        $field = PageContent::find($id);
        $field->page_name = $request['page_name'];
        $field->title = $request['title'];
        $field->description = $request['description'];
        $field->save();
        session()->flash('smsg', 'Record has been updated successfully.');
        return redirect('admin/scholarship/content');
    }
}
