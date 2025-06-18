<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProviderType;

class ProviderTypeC extends Controller
{
  public function index($id = null)
  {
    // $p = ProviderType::all();
    // //return ProviderType::find(2)->getProvider;
    // echo $p->provider_name;
    // echo "<br>";
    // printArray($p->toArray());
    // die;
    $rows = ProviderType::all();
    if ($id != null) {
      $sd = ProviderType::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('/') . '/admin/pt/update/' . $id;
        $title = 'Update';
      } else {
        return redirect('admin/provider-type');
      }
    } else {
      $ft = 'add';
      $url = url('/') . '/admin/pt/store';
      $title = 'Add New';
      $sd = '';
    }
    $data = compact('rows', 'sd', 'ft', 'url', 'title');
    return view('admin.provider-type')->with($data);
  }
  public function store(Request $data)
  {
    //printArray($data->all());
    $data->validate(
      [
        'provider_type' => 'required|regex:/^[a-zA-Z ]*$/'
      ]
    );
    $field = new ProviderType;
    $field->provider_type = $data['provider_type'];
    $field->provider_slug = slugify($data['provider_type']);
    $field->status = 1;
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/provider-type');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = ProviderType::find($id)->delete();
  }
  public function update($id, Request $data)
  {
    $data->validate(
      [
        'provider_type' => 'required|regex:/^[a-zA-Z ]*$/'
      ]
    );
    $field = ProviderType::find($id);
    $field->provider_type = $data['provider_type'];
    $field->provider_slug = slugify($data['provider_type']);
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/provider-type');
  }
}
