<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\ScholarshipLetterTemplate;
use App\Models\Student;
use App\Models\StudentScholarshipLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

class StudentScholarshipLetterC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'student-scholarship-letters';
  }
  public function index(Request $request, $company_id, $id = null)
  {
    $company = CompanyProfile::find($company_id);
    $page_no = $_GET['page'] ?? 1;
    $rows = StudentScholarshipLetter::where('company_id', $company_id)->get();
    $students = Student::all();
    $templates = ScholarshipLetterTemplate::all();
    if ($id != null) {
      $sd = StudentScholarshipLetter::find($id);
      if (!is_null($sd)) {
        $ft = 'edit';
        $url = url('admin/' . $this->page_route . '/' . $company_id . '/update/' . $id);
        $title = 'Update';
      } else {
        return redirect('admin/' . $this->page_route . '/' . $company_id);
      }
    } else {
      $ft = 'add';
      $url = url('admin/' . $this->page_route . '/store');
      $title = 'Add New';
      $sd = '';
    }
    $page_title = "Student Scholarship Letters";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'title', 'page_title', 'page_route', 'page_no', 'url', 'company_id',  'company', 'students', 'templates');
    return view('admin.student-scholarship-letters')->with($data);
  }
  public function store(Request $request)
  {
    //return $request;
    $validator = Validator::make(
      $request->all(),
      [
        'company_id' => 'required',
        'student_id' => 'required',
        'letter_description' => 'required',
      ]
    );

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new StudentScholarshipLetter();
    $field->company_id = $request['company_id'];
    $field->student_id = $request['student_id'];
    $field->created_by = session('adminLoggedIn')['user_id'];
    $field->letter_to = $request['student_id'];
    $field->letter_description = $request['letter_description'];
    $field->signature = $request->has('signature') ? 1 : 0;
    $field->stamped = $request->has('stamped') ? 1 : 0;

    $field->save();

    return response()->json(['success' => 'Records inserted successfully.']);
  }
  public function update($company_id, $id, Request $request)
  {
    $request->validate(
      [
        'student_id' => 'required',
        'letter_description' => 'required',
      ]
    );
    $field = StudentScholarshipLetter::find($id);
    $field->student_id = $request['student_id'];
    $field->letter_to = $request['student_id'];
    $field->letter_description = $request['letter_description'];
    $field->signature = $request->has('signature') ? 1 : 0;
    $field->stamped = $request->has('stamped') ? 1 : 0;

    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route . '/' . $company_id);
  }
  public function getData(Request $request)
  {
    // return $request;
    // die;
    $rows = StudentScholarshipLetter::where('company_id', $request->company_id)->paginate(10)->withPath('/admin/' . $this->page_route . '/' . $request->company_id);
    $i = 1;
    $output = '<table id="" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Student</th>
        <th>Description</th>
        <th>Signature</th>
        <th>Stamp</th>
        <th></th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    foreach ($rows as $row) {
      $output .= '<tr id="row' . $row->id . '">
            <td>' . $i . '</td>
            <td>' . $row->student->name . '</td>
            <td>' . Blade::render('<x-content-view-modal :row="$row" field="letter_description" title="Description" />', ['row' => $row]) . '</a>
            </td>
            <td>' . ($row->signature == 1 ? '<span class="badge bg-success">On</span>' : '<span class="badge bg-danger">Off</span>') . '</td>
            <td>' . ($row->stamped == 1 ? '<span class="badge bg-success">On</span>' : '<span class="badge bg-danger">Off</span>') . '</td>
            <td>
              <a target="_blank" href="' . url('admin/view-scholarship-letter/' . $row->id) . '" data-toggle="tooltip" class="btn btn-info btn-xs" title="Preview">Preview</a>
              <a target="_blank" href="' . url('admin/view-scholarship-letter/' . $row->id . '?download') . '" data-toggle="tooltip" class="btn btn-info btn-xs" title="Download">Download</a>
            </td>
            <td>
              ' . Blade::render('<x-delete-button :id="$id" />', ['id' => $row->id]) . '
              ' . Blade::render('<x-edit-button :url="$url" />', ['url' => url('admin/' . $this->page_route . '/' . $request->company_id . '/update/' . $row->id)]) . '
            </td>
          </tr>';
      $i++;
    }
    $output .= '</tbody></table>';
    $output .= '<div>' . $rows->links('pagination::bootstrap-5') . '</div>';
    return $output;
  }
  public function delete($id)
  {
    if ($id) {
      $row = StudentScholarshipLetter::findOrFail($id);

      $row->delete();
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }
  public function getTemplate(Request $request)
  {
    $id = $request->template_id;
    $template = ScholarshipLetterTemplate::find($id);
    if ($template) {
      $output = $template->template;
      return response()->json(['success' => true, 'output' => $output]);
    } else {
      return response()->json(['success' => false]);
    }
  }
}
