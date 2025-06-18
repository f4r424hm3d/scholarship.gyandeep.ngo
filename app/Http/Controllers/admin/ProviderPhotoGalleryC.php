<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\ProviderPhotoGallery;

class ProviderPhotoGalleryC extends Controller
{
  public function index($provider_id, $id = null)
  {
    $rows = ProviderPhotoGallery::where('provider_id', $provider_id)->get();
    $pro = Provider::find($provider_id);
    if ($id != null) {
      $sd = ProviderPhotoGallery::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('/') . '/admin/prophoto/update/' . $id;
        $title = 'Update';
      } else {
        return redirect('admin/provider-photo/' . $provider_id);
      }
    } else {
      $ft = 'add';
      $url = url('/') . '/admin/prophoto/store';
      $title = 'Add New';
      $sd = '';
    }
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'pro');
    return view('admin.provider-photo')->with($data);
  }
  public function store(Request $request)
  {
    //printArray($request->all());
    $request->validate(
      [
        'provider_id' => 'required|numeric',
        'photo' => 'required|max:10000|mimes:jpg,jpeg,png,gif'
      ]
    );
    $field = new ProviderPhotoGallery;
    if ($request->hasFile('photo')) {
      $photo_name = time() . '.' . $request->file('photo')->getClientOriginalExtension();
      $photo_path = $request->file('photo')->move('uploads/provider/', $photo_name);
      $field->photo_path = $photo_path;
    }
    $field->provider_id = $request['provider_id'];
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/provider-photo/' . $request->provider_id);
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = ProviderPhotoGallery::find($id)->delete();
  }
  public function update($id, Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'provider_id' => 'required|numeric',
        'photo' => 'required|max:10000|mimes:jpg,jpeg,png,gif'
      ]
    );
    $field = ProviderPhotoGallery::find($id);
    if ($request->hasFile('photo')) {
      $photo_name = time() . '.' . $request->file('photo')->getClientOriginalExtension();
      $photo_path = $request->file('photo')->move('uploads/provider/', $photo_name);
      $field->photo_path = $photo_path;
    }
    $field->provider_id = $request['provider_id'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/provider-photo/' . $request->provider_id);
  }
}
