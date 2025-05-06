<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProviderFaq;
use App\Models\Provider;

class ProviderFaqC extends Controller
{
    public function index($provider_id, $id = null)
    {
        $rows = ProviderFaq::where('provider_id', $provider_id)->get();
        $pro = Provider::find($provider_id);
        if ($id != null) {
            $sd = ProviderFaq::find($id);
            if (!is_null($sd)) {
                $ft = 'edit';
                $url = url('/') . '/admin/profaq/update/' . $id;
                $title = 'Update';
            } else {
                return redirect('admin/provider-faq/' . $provider_id);
            }
        } else {
            $ft = 'add';
            $url = url('/') . '/admin/profaq/store';
            $title = 'Add New';
            $sd = '';
        }
        $data = compact('rows', 'sd', 'ft', 'url', 'title', 'pro');
        return view('backend.provider-faq')->with($data);
    }
    public function store(Request $request)
    {
        //printArray($request->all());
        $request->validate(
            [
                'provider_id' => 'required|numeric',
                'question' => 'required',
                'answer' => 'required'
            ]
        );
        $field = new ProviderFaq;
        $field->provider_id = $request['provider_id'];
        $field->question = $request['question'];
        $field->answer = $request['answer'];
        $field->save();
        session()->flash('smsg', 'New record has been added successfully.');
        return redirect('admin/provider-faq/' . $request->provider_id);
    }
    public function delete($id)
    {
        //echo $id;
        echo $result = ProviderFaq::find($id)->delete();
    }
    public function update($id, Request $request)
    {
        // printArray($data->all());
        // die;
        $request->validate(
            [
                'provider_id' => 'required|numeric',
                'question' => 'required',
                'answer' => 'required'
            ]
        );
        $field = ProviderFaq::find($id);
        $field->provider_id = $request['provider_id'];
        $field->question = $request['question'];
        $field->answer = $request['answer'];
        $field->save();
        session()->flash('smsg', 'Record has been updated successfully.');
        return redirect('admin/provider-faq/' . $request->provider_id);
    }
}
