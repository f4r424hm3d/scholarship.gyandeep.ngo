<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\LevelDocument;

class LevelDocumentC extends Controller
{
    public function index($level_id, $id = null)
    {
        $rows = LevelDocument::where('level_id', $level_id)->get();
        $level = Level::find($level_id);
        $dn = LevelDocument::select('document_name')->distinct()->get();
        if ($id != null) {
            $sd = LevelDocument::find($id);
            if (!is_null($sd)) {
                $ft = 'edit';
                $url = url('/') . '/admin/level/document/update/' . $id;
                $title = 'Update';
            } else {
                return redirect('admin/level/document/' . $level_id);
            }
        } else {
            $ft = 'add';
            $url = url('/') . '/admin/level/document/store';
            $title = 'Add New';
            $sd = '';
        }
        $data = compact('rows', 'sd', 'ft', 'url', 'title', 'level', 'dn',);
        return view('backend.level-document')->with($data);
    }
    public function store(Request $request)
    {
        //printArray($request->all());
        $request->validate(
            [
                'level_id' => 'required|numeric',
                'document_name' => 'required'
            ]
        );
        $de = LevelDocument::where('level_id', '=', $request->level_id)->where('document_name', '=', $request->document_name)->count();
        if ($de > 0) {
            session()->flash('emsg', 'Record already exist.');
        } else {
            $field = new LevelDocument;
            $field->level_id = $request['level_id'];
            $field->document_name = $request['document_name'];
            $field->save();
            session()->flash('smsg', 'New record has been added successfully.');
        }

        return redirect('admin/level/document/' . $request->level_id);
    }
    public function delete($id)
    {
        //echo $id;
        echo $result = LevelDocument::find($id)->delete();
    }
    public function update($id, Request $request)
    {
        // printArray($request->all());
        // die;
        $request->validate(
            [
                'level_id' => 'required|numeric',
                'document_name' => 'required'
            ]
        );

        $de = LevelDocument::where('level_id', '!=', $request->level_id)->where('document_name', '=', $request->document_name)->count();
        if ($de > 0) {
            session()->flash('emsg', 'Record already exist.');
        } else {
            $field = LevelDocument::find($id);
            $field->level_id = $request['level_id'];
            $field->document_name = $request['document_name'];
            $field->save();
            session()->flash('smsg', 'Record has been updated successfully.');
        }
        return redirect('admin/level/document/' . $request->level_id);
    }
}
