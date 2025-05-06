<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Scholarship;
use App\Models\Provider;


class ScholarshipC extends Controller
{
    public function index($id = null)
    {
        $rows = Scholarship::with('getProvider')->where('source', 'self')->get();
        if ($id != null) {
            $sd = Scholarship::find($id);
            if (!is_null($sd)) {
                $ft = 'edit';
                $url = url('admin/scholarship/update/' . $id);
                $title = 'Update';
            } else {
                return redirect('admin/scholarship');
            }
        } else {
            $ft = 'add';
            $url = url('admin/scholarship/store');
            $title = 'Add New';
            $sd = '';
        }
        $data = compact('rows', 'sd', 'ft', 'url', 'title');
        return view('backend.scholarship')->with($data);
    }
    public function store(Request $data)
    {
        // printArray($data->all());
        // die;
        $data->validate(
            [
                'name' => 'required',
                'eligibility' => 'required',
                'deadline' => 'required|date',
                'covers' => 'required',
                'provider' => 'required|numeric',
                'provider_type_id' => 'required|numeric',
                'exam_type' => 'required|in:Paid,Free',
                'exam_fees' => 'numeric|nullable',
            ]
        );
        $token = Str::random(45);
        $field = new Scholarship;
        $field->name = $data['name'];
        $field->slug = slugify($data['name']);
        $field->eligibility = $data['eligibility'];
        $field->deadline = $data['deadline'];
        $field->covers = $data['covers'];
        $field->covers_notes = $data['covers_notes'];
        $field->provider_type_id = $data['provider_type_id'];
        $field->provider_id = $data['provider'];
        $field->description = $data['description'];
        $field->instruction = $data['instruction'];
        $field->exam_type = $data['exam_type'];
        $field->exam_fees = $data['exam_fees'];
        $field->token = $token;
        $field->status = 1;
        $field->source = 'self';
        $field->save();
        session()->flash('smsg', 'New record has been added successfully.');
        return redirect('admin/scholarship');
    }
    public function delete($id)
    {
        //echo $id;
        echo $result = Scholarship::find($id)->delete();
    }
    public function update($id, Request $data)
    {
        $data->validate(
            [
                'name' => 'required',
                'eligibility' => 'required',
                'deadline' => 'required|date',
                'covers' => 'required',
                'provider' => 'required|numeric',
                'provider_type_id' => 'required|numeric',
                'exam_type' => 'required|in:Paid,Free',
                'exam_fees' => 'numeric|nullable',
            ]
        );
        $field = Scholarship::find($id);
        $field->name = $data['name'];
        $field->slug = slugify($data['name']);
        $field->eligibility = $data['eligibility'];
        $field->deadline = $data['deadline'];
        $field->covers = $data['covers'];
        $field->covers_notes = $data['covers_notes'];
        $field->provider_type_id = $data['provider_type_id'];
        $field->provider_id = $data['provider'];
        $field->description = $data['description'];
        $field->instruction = $data['instruction'];
        $field->exam_type = $data['exam_type'];
        $field->exam_fees = $data['exam_fees'];
        $field->save();
        session()->flash('smsg', 'Record has been updated successfully.');
        return redirect('admin/scholarship');
    }
    public function getProvider(Request $data)
    {
        //echo $id;
        $field = Provider::where('provider_type_id', $data['id'])->get();
        $output = '<option value="">Select Provider</option>';
        foreach ($field as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->provider_name . '</option>';
        }
        echo $output;
    }
}
