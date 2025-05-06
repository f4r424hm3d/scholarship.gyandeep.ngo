<?php

namespace App\Http\Controllers\provider;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Scholarship;
use App\Models\ScholarshipCustomEligibility;
use App\Models\ScholarshipEligibility;
use App\Models\ScholarshipLevel;
use App\Models\ScholarshipSubject;

class PostScholarshipFc extends Controller
{
  public function index()
  {
    $id = session()->get('provider_id');
    $provider = Provider::find($id);

    $where = ['provider_id' => $id];
    $rows = Scholarship::where($where)->get();

    $data = compact('rows', 'provider');
    return view('front.provider.scholarship')->with($data);
  }
  public function add()
  {
    $id = session()->get('provider_id');
    $provider = Provider::find($id);
    $ft = 'add';
    $data = compact('provider', 'ft');
    return view('front.provider.scholarship-add')->with($data);
  }
  public function store(Request $request)
  {
    $id = session()->get('provider_id');
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'name' => 'required',
        'eligibility' => 'required',
        'deadline' => 'required|date',
        'covers' => 'required',
      ]
    );
    $token = Str::random(45);
    $field = new Scholarship;
    $field->name = $request['name'];
    $field->slug = slugify($request['name']);
    $field->eligibility = $request['eligibility'];
    $field->deadline = $request['deadline'];
    $field->covers = $request['covers'];
    $field->covers_notes = $request['covers_notes'];
    $field->provider_id = $id;
    $field->provider_type_id = $request['provider_type_id'];
    $field->description = $request['description'];
    $field->instruction = $request['instruction'];
    // $field->exam_type = $request['exam_type'];
    // $field->exam_fees = $request['exam_fees'];
    $field->token = $token;
    $field->source = 'external';
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('provider/scholarship');
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = Scholarship::find($id)->delete();
  }
  public function viewFullScholarship($id)
  {
    $provider_id = session()->get('provider_id');
    $where = ['id' => $id, 'provider_id' => $provider_id];
    $row = Scholarship::where($where)->firstOrFail();
    if ($row != null) {
      $provider = Provider::find($provider_id);
      $ft = "edit";
      $sl = ScholarshipLevel::with('getLevel')->where('scholarship_id', $id)->get();
      $ss = ScholarshipSubject::with('getSubject', 'getCourse')->where('scholarship_id', $id)->get();
      $sc = ScholarshipEligibility::with('getCountry')->where('scholarship_id', $id)->get();
      $sce = ScholarshipCustomEligibility::where('scholarship_id', $id)->get();
      $data = compact('row', 'provider', 'ft', 'sl', 'ss', 'sc', 'sce');
      return view('front.provider.scholarship-details')->with($data);
    } else {
      session()->flash('emsg', 'No record found.');
      return redirect('provider/scholarship');
    }
  }
  public function update(Request $request)
  {
    $request->validate(
      [
        'name' => 'required',
        'eligibility' => 'required',
        'deadline' => 'required|date',
        'covers' => 'required',
      ]
    );
    $field = Scholarship::find($request['id']);
    $field->name = $request['name'];
    $field->slug = slugify($request['name']);
    $field->eligibility = $request['eligibility'];
    $field->deadline = $request['deadline'];
    $field->covers = $request['covers'];
    $field->covers_notes = $request['covers_notes'];
    $field->description = $request['description'];
    $field->instruction = $request['instruction'];
    // $field->exam_type = $request['exam_type'];
    // $field->exam_fees = $request['exam_fees'];
    $field->source = 'external';
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('provider/scholarship/' . $request['id']);
  }
  public function storeLevel(Request $request)
  {
    // printArray($request->all());
    // die;
    $level_id = $request['level_id'];
    for ($i = 0; $i < count($level_id); $i++) {
      $field = new ScholarshipLevel();
      $field->scholarship_id = $request['scholarship_id'];
      $field->level_id = $request['level_id'][$i];
      $field->save();
    }


    session()->flash('smsg', 'Record has been added successfully.');
    return redirect('provider/scholarship/' . $request->scholarship_id);
  }
  public function deleteLevel($id)
  {
    //echo $id;
    echo $result = ScholarshipLevel::find($id)->delete();
  }
  public function storeSubject(Request $request)
  {
    // printArray($request->all());
    // die;
    $spc_id = $request['spc_id'];
    for ($i = 0; $i < count($spc_id); $i++) {
      $field = new ScholarshipSubject();
      $field->scholarship_id = $request['scholarship_id'];
      $field->course_id = $request['course_id'];
      $field->spc_id = $request['spc_id'][$i];
      $field->save();
    }


    session()->flash('smsg', 'Record has been added successfully.');
    return redirect('provider/scholarship/' . $request->scholarship_id);
  }
  public function deleteSubject($id)
  {
    //echo $id;
    echo $result = ScholarshipSubject::find($id)->delete();
  }
  public function storeCountry(Request $request)
  {
    // printArray($request->all());
    // die;
    $country = $request['country'];
    for ($i = 0; $i < count($country); $i++) {
      $field = new ScholarshipEligibility();
      $field->scholarship_id = $request['scholarship_id'];
      $field->country = $request['country'][$i];
      $field->save();
    }


    session()->flash('smsg', 'Record has been added successfully.');
    return redirect('provider/scholarship/' . $request->scholarship_id);
  }
  public function deleteCountry($id)
  {
    //echo $id;
    echo $result = ScholarshipEligibility::find($id)->delete();
  }
  public function storeCustomEligibility(Request $request)
  {
    // printArray($request->all());
    // die;
    $field = new ScholarshipCustomEligibility();
    $field->scholarship_id = $request['scholarship_id'];
    $field->question = $request['question'];
    $field->save();
    session()->flash('smsg', 'Record has been added successfully.');
    return redirect('provider/scholarship/' . $request->scholarship_id);
  }
  public function deleteCustomEligibility($id)
  {
    //echo $id;
    echo $result = ScholarshipCustomEligibility::find($id)->delete();
  }
}
