<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Level;

class AdminLevel extends Controller
{
    public function index($id = null)
    {
        $dep = Level::all();
        if ($id != null) {
            $sd = Level::find($id);
            if (!is_null($sd)) {
                $ft = 'edit';
                $url = url('admin/levels/update/' . $id);
                $title = 'Update';
            } else {
                return redirect('admin/levels');
            }
        } else {
            $ft = 'add';
            $url = url('admin/levels/store');
            $title = 'Add New';
            $sd = '';
        }
        $data = compact('dep', 'sd', 'ft', 'url', 'title');
        return view('backend.levels')->with($data);
    }
    public function addLevel(Request $data)
    {
        //printArray($data->all());
        $data->validate(
            [
                'name' => 'required',
                'short_name' => 'required',
                'seo_name' => 'required'
            ]
        );
        $dep = new Level;
        $dep->name = $data['name'];
        $dep->slug = slugify($data['name']);
        $dep->short_name = $data['short_name'];
        $dep->short_name_slug = slugify($data['short_name']);
        $dep->seo_name = $data['seo_name'];
        $dep->seo_name_slug = slugify($data['seo_name']);
        $dep->save();
        session()->flash('smsg', 'New record has been added successfully.');
        return redirect('admin/levels');
    }
    public function deleteLevel($id)
    {
        //echo $id;
        echo $result = Level::find($id)->delete();
    }
    public function updateLevel($id, Request $data)
    {
        $data->validate(
            [
                'name' => 'required',
                'short_name' => 'required',
                'seo_name' => 'required'
            ]
        );
        $dep = Level::find($id);
        $dep->name = $data['name'];
        $dep->slug = slugify($data['name']);
        $dep->short_name = $data['short_name'];
        $dep->short_name_slug = slugify($data['short_name']);
        $dep->seo_name = $data['seo_name'];
        $dep->seo_name_slug = slugify($data['seo_name']);
        $dep->save();
        session()->flash('smsg', 'Record has been updated successfully.');
        return redirect('admin/levels');
    }
}
