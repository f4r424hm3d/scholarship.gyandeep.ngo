<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\ProviderVideoGallery;

class ProviderVideoGalleryC extends Controller
{
    public function index($provider_id, $id = null)
    {
        $rows = ProviderVideoGallery::where('provider_id', $provider_id)->get();
        $pro = Provider::find($provider_id);
        if ($id != null) {
            $sd = ProviderVideoGallery::find($id);
            if (!is_null($sd)) {
                $ft = 'edit';
                $url = url('/') . '/admin/provideo/update/' . $id;
                $title = 'Update';
            } else {
                return redirect('admin/provider-video/' . $provider_id);
            }
        } else {
            $ft = 'add';
            $url = url('/') . '/admin/provideo/store';
            $title = 'Add New';
            $sd = '';
        }
        $data = compact('rows', 'sd', 'ft', 'url', 'title', 'pro');
        return view('backend.provider-video')->with($data);
    }
    public function store(Request $request)
    {
        //printArray($request->all());
        $request->validate(
            [
                'provider_id' => 'required|numeric',
                'video_path' => 'required'
            ]
        );
        $field = new ProviderVideoGallery;
        $field->provider_id = $request['provider_id'];
        $field->video_path = $request['video_path'];
        $field->save();
        session()->flash('smsg', 'New record has been added successfully.');
        return redirect('admin/provider-video/' . $request->provider_id);
    }
    public function delete($id)
    {
        //echo $id;
        echo $result = ProviderVideoGallery::find($id)->delete();
    }
    public function update($id, Request $request)
    {
        // printArray($request->all());
        // die;
        $request->validate(
            [
                'provider_id' => 'required|numeric',
                'video_path' => 'required'
            ]
        );
        $field = ProviderVideoGallery::find($id);
        $field->provider_id = $request['provider_id'];
        $field->video_path = $request['video_path'];
        $field->save();
        session()->flash('smsg', 'Record has been updated successfully.');
        return redirect('admin/provider-video/' . $request->provider_id);
    }
}
