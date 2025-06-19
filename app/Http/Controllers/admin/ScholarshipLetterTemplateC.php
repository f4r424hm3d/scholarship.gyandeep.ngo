<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ScholarshipLetterTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

class ScholarshipLetterTemplateC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'scholarship-letter-templates';
  }
  public function index($id = null)
  {
    $page_no = $_GET['page'] ?? 1;
    $rows = ScholarshipLetterTemplate::get();
    if ($id != null) {
      $sd = ScholarshipLetterTemplate::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/' . $this->page_route . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/' . $this->page_route);
      }
    } else {
      $ft = 'add';
      $url = url('admin/' . $this->page_route . '/store');
      $title = 'Add New';
      $sd = '';
    }

    $page_title = "Url Redirections";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'page_no');
    return view('admin.scholarship-letter-templates')->with($data);
  }
  public function getData(Request $request)
  {
    $rows = ScholarshipLetterTemplate::where('id', '!=', '0');
    $rows = $rows->paginate(10)->withPath('/admin/' . $this->page_route);
    $i = 1;
    $output = '<table id="" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Template Name</th>
        <th>Template</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    if ($rows->count() > 0) {
      foreach ($rows as $row) {
        $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>' . $row->template_name . '</td>
      <td>' . Blade::render('<x-content-view-modal :row="$row" field="template" title="Template" />', ['row' => $row]) . '</td>
      <td>
        ' . Blade::render('<x-delete-button :id="$id" />', ['id' => $row->id]) . '
        ' . Blade::render('<x-edit-button :url="$url" />', ['url' => url("admin/" . $this->page_route . "/update/" . $row->id)]) . '
      </td>
    </tr>';
        $i++;
      }
    } else {
      $output .= '<tr><td colspan="4"><center>No data found</center></td></tr>';
    }
    $output .= '</tbody></table>';
    $output .= '<div>' . $rows->links('pagination::bootstrap-5') . '</div>';
    return $output;
  }
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'template_name' => 'required',
      'template' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new ScholarshipLetterTemplate;
    $field->template_name = $request['template_name'];
    $field->template = $request['template'];
    $field->save();
    return response()->json(['success' => 'Record has been added successfully.']);
  }
  public function delete($id)
  {
    if ($id) {
      $row = ScholarshipLetterTemplate::findOrFail($id);
      //   if ($row->photo_path != null) {
      //     unlink($row->photo_path);
      //   }
      $result = $row->delete();
      return response()->json(['success' => true]);
    }
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'template_name' => 'required',
        'template' => 'required',
      ]
    );
    $field = ScholarshipLetterTemplate::find($id);
    $field->template_name = $request['template_name'];
    $field->template = $request['template'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route);
  }
}
