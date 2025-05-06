<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\ProviderType;
use Illuminate\Http\Request;

class ProviderC extends Controller
{
    public function index($id = null)
    {
        $rows = Provider::with('getProviderType', 'getCountry')->get();
        //printArray($rows->toArray());
        $pt = ProviderType::all();
        if ($id != null) {
            $sd = Provider::find($id);
            if (!is_null($sd)) {
                $ft = 'edit';
                $url = url('/') . '/admin/pr/update/' . $id;
                $title = 'Update';
            } else {
                return redirect('admin/providers');
            }
        } else {
            $ft = 'add';
            $url = url('/') . '/admin/pr/store';
            $title = 'Add New';
            $sd = '';
        }
        $data = compact('rows', 'sd', 'ft', 'url', 'title', 'pt');
        return view('backend.providers')->with($data);
    }
    public function store(Request $data)
    {
        // printArray($data->all());
        // die;
        $data->validate(
            [
                'provider_name' => 'required|regex:/^[a-zA-Z ]*$/',
                'provider_type_id' => 'required|numeric',
            ]
        );
        $field = new Provider;
        if ($data->hasFile('logo')) {
            $logoname = time() . '.' . $data->file('logo')->getClientOriginalExtension();
            $logopath = $data->file('logo')->move('uploads/logo/', $logoname);
            $field->logo_path = $logopath;
        }
        $field->provider_type_id = $data['provider_type_id'];
        $field->provider_name = $data['provider_name'];
        $field->name = $data['provider_name'];
        $field->slug = slugify($data['provider_name']);

        $field->global_rank = $data['global_rank'];
        $field->acceptance_rate = $data['acceptance_rate'];
        $field->university_type = $data['university_type'];
        $field->established = $data['established'];
        $field->website = $data['website'];
        $field->address = $data['address'];
        $field->city = $data['city'];
        $field->state = $data['state'];
        $field->country = $data['country'];
        $field->description = $data['description'];
        $field->source = 'added';

        $field->status = 1;
        $field->save();
        session()->flash('smsg', 'New record has been added successfully.');
        return redirect('admin/providers');
    }
    public function delete($id)
    {
        //echo $id;
        echo $result = Provider::find($id)->delete();
    }
    public function update($id, Request $data)
    {
        $data->validate(
            [
                'provider_name' => 'required|regex:/^[a-zA-Z ]*$/',
                'provider_type_id' => 'required|numeric',
            ]
        );
        $field = Provider::find($id);
        if ($data->hasFile('logo')) {
            $logoname = time() . '.' . $data->file('logo')->getClientOriginalExtension();
            $logopath = $data->file('logo')->move('uploads/logo/', $logoname);
            $field->logo_path = $logopath;
        }
        $field->provider_type_id = $data['provider_type_id'];
        $field->provider_name = $data['provider_name'];
        $field->slug = slugify($data['provider_name']);

        $field->global_rank = $data['global_rank'];
        $field->acceptance_rate = $data['acceptance_rate'];
        $field->university_type = $data['university_type'];
        $field->established = $data['established'];
        $field->website = $data['website'];
        $field->address = $data['address'];
        $field->city = $data['city'];
        $field->state = $data['state'];
        $field->country = $data['country'];
        $field->description = $data['description'];

        $field->save();
        session()->flash('smsg', 'Record has been updated successfully.');
        return redirect('admin/providers');
    }
}
