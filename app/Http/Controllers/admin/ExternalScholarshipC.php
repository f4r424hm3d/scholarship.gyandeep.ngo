<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Scholarship;
use App\Models\Provider;

class ExternalScholarshipC extends Controller
{
    public function index($id = null)
    {
        $rows = Scholarship::with('getProvider')->where(['source' => 'external', 'status' => '1'])->get();
        if ($id != null) {
            $sd = Scholarship::find($id);
            if (!is_null($sd)) {
                $ft = 'edit';
                $url = url('admin/external-scholarship/update/' . $id);
                $title = 'Update';
            } else {
                return redirect('admin/external-scholarship');
            }
        } else {
            $ft = 'add';
            $url = url('admin/external-scholarship/store');
            $title = 'Add New';
            $sd = '';
        }
        $data = compact('rows', 'sd', 'ft', 'url', 'title');
        return view('backend.external-scholarship')->with($data);
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
        $field->source = 'external';
        $field->save();
        session()->flash('smsg', 'New record has been added successfully.');
        return redirect('admin/external-scholarship');
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
        return redirect('admin/external-scholarship');
    }


    public function request($id = null)
    {
        $rows = Scholarship::with('getProvider')->where(['source' => 'external', 'status' => '0'])->get();
        if ($id != null) {
            $sd = Scholarship::find($id);
            if (!is_null($sd)) {
                $ft = 'post';
                $url = url('admin/external-scholarship/post/' . $id);
                $title = 'Update';
            } else {
                return redirect('admin/external-scholarship/request');
            }
        } else {
            $ft = 'add';
            $url = url('admin/external-scholarship/store');
            $title = 'Add New';
            $sd = '';
        }
        $data = compact('rows', 'sd', 'ft', 'url', 'title');
        return view('backend.external-scholarship')->with($data);
    }
    public function post($id, Request $request)
    {
        // printArray($data->all());
        // die;
        $request->validate(
            [
                'exam_type' => 'required|in:Paid,Free',
                'exam_fees' => 'numeric|nullable',
            ]
        );
        $field = Scholarship::find($id);
        $field->exam_type = $request['exam_type'];
        $field->exam_fees = $request['exam_fees'];
        $field->status = 1;
        $field->save();
        session()->flash('smsg', 'Scholarship has been posted.');
        return redirect('admin/external-scholarship/request');
    }
}
