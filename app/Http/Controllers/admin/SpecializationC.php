<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Imports\SpecializationImport;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Models\CourseCategory;
use Maatwebsite\Excel\Facades\Excel;

class SpecializationC extends Controller
{
    public function index($id = null)
    {
        $rows = Specialization::all();
        $cc = CourseCategory::all();
        if ($id != null) {
            $sd = Specialization::find($id);
            if (!is_null($sd)) {
                $ft = 'edit';
                $url = url('admin/cs/update/' . $id);
                $title = 'Update';
            } else {
                return redirect('admin/course-specialization');
            }
        } else {
            $ft = 'add';
            $url = url('admin/cs/store');
            $title = 'Add New';
            $sd = '';
        }
        $data = compact('rows', 'sd', 'ft', 'url', 'title', 'cc');
        return view('backend.course-specialization')->with($data);
    }
    public function store(Request $data)
    {
        // printArray($data->all());
        // die;
        $data->validate(
            [
                'specialization' => 'required',
                'category_id' => 'required|numeric'
            ]
        );
        $field = new Specialization;
        $field->category_id = $data['category_id'];
        $field->specialization = $data['specialization'];
        $field->specialization_slug = slugify($data['specialization']);
        $field->status = 1;
        $field->save();
        session()->flash('smsg', 'New record has been added successfully.');
        return redirect('admin/course-specialization');
    }
    public function delete($id)
    {
        //echo $id;
        echo $result = Specialization::find($id)->delete();
    }
    public function update($id, Request $data)
    {
        $data->validate(
            [
                'specialization' => 'required',
                'category_id' => 'required|numeric'
            ]
        );
        $field = Specialization::find($id);
        $field->category_id = $data['category_id'];
        $field->specialization = $data['specialization'];
        $field->specialization_slug = slugify($data['specialization']);
        $field->save();
        session()->flash('smsg', 'Record has been updated successfully.');
        return redirect('admin/course-specialization');
    }
    public function getSpcByCat(Request $data)
    {
        //echo $id;
        $field = Specialization::where('category_id', $data['id'])->get();
        $output = '<option value="">Select Specialization</option>';
        foreach ($field as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->specialization . '</option>';
        }
        echo $output;
    }

    public function Import(Request $request)
    {
        // printArray($data->all());
        // die;
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);
        $file = $request->file;
        if ($file) {
            try {
                $result = Excel::import(new SpecializationImport, $file);
                // session()->flash('smsg', 'Data has been imported succesfully.');
                return redirect('admin/course-specialization');
            } catch (\Exception $ex) {
                dd($ex);
            }
        }
    }
}
