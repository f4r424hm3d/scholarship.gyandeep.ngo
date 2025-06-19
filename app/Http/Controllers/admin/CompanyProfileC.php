<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

class CompanyProfileC extends Controller
{
  protected $page_route;
  public function __construct()
  {
    $this->page_route = 'company-profiles';
  }
  public function index($id = null)
  {
    $page_no = $_GET['page'] ?? 1;
    $rows = CompanyProfile::get();
    if ($id != null) {
      $sd = CompanyProfile::find($id);
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

    $page_title = "Company Profile";
    $page_route = $this->page_route;
    $data = compact('rows', 'sd', 'ft', 'url', 'title', 'page_title', 'page_route', 'page_no');
    return view('admin.company-profiles')->with($data);
  }
  public function getData(Request $request)
  {
    $rows = CompanyProfile::where('id', '!=', '0');
    $rows = $rows->paginate(10)->withPath('/admin/' . $this->page_route);
    $i = 1;
    $output = '<table id="" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Company</th>
        <th>Address</th>
        <th>Files</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    if ($rows->count() > 0) {
      foreach ($rows as $row) {
        $output .= '<tr id="row' . $row->id . '">
      <td>' . $i . '</td>
      <td>
        Name : ' . $row->company_name . ' <br>
        Email : ' . $row->email . ' <br>
        Mobile : ' . $row->mobile . ' <br>
        website : ' . $row->website_address . ' <br>
      </td>
      <td>' . $row->address . '</td>
      <td>
        Logo : ' . (!empty($row->logo_path) ? '<a href="' . url($row->logo_path) . '" target="_blank">Logo</a>' : 'N/A') . '<br>
        Stamp : ' . (!empty($row->stamp_path) ? '<a href="' . url($row->stamp_path) . '" target="_blank">Stamp</a>' : 'N/A') . '<br>
        Signature : ' . (!empty($row->signature_path) ? '<a href="' . url($row->signature_path) . '" target="_blank">Signature</a>' : 'N/A') . '
      </td>
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
      'company_name' => 'required',
      'email' => 'required',
      'mobile' => 'required',
      'website_address' => 'required',
      'address' => 'required',
      'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
      'stamp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      'signature' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ]);
    }

    $field = new CompanyProfile;
    $field->company_name = $request['company_name'];
    $field->email = $request['email'];
    $field->mobile = $request['mobile'];
    $field->website_address = $request['website_address'];
    $field->address = $request['address'];
    if ($request->hasFile('logo')) {
      $fileOriginalName = $request->file('logo')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('logo')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('logo')->move('uploads/logo/', $file_name);
      if ($move) {
        $field->logo_path = 'uploads/logo/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    if ($request->hasFile('stamp')) {
      $fileOriginalName = $request->file('stamp')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('stamp')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('stamp')->move('uploads/stamp/', $file_name);
      if ($move) {
        $field->stamp_path = 'uploads/stamp/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    if ($request->hasFile('signature')) {
      $fileOriginalName = $request->file('signature')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('signature')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('signature')->move('uploads/signature/', $file_name);
      if ($move) {
        $field->signature_path = 'uploads/signature/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->save();
    return response()->json(['success' => 'Record has been added successfully.']);
  }
  public function delete($id)
  {
    if ($id) {
      $row = CompanyProfile::findOrFail($id);
      if ($row->logo_path != null) {
        unlink($row->logo_path);
      }
      if ($row->stamp_path != null) {
        unlink($row->stamp_path);
      }
      if ($row->signature_path != null) {
        unlink($row->signature_path);
      }
      $result = $row->delete();
      return response()->json(['success' => true]);
    }
  }
  public function update($id, Request $request)
  {
    $request->validate(
      [
        'company_name' => 'required',
        'email' => 'required',
        'mobile' => 'required',
        'website_address' => 'required',
        'address' => 'required',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'stamp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'signature' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      ]
    );
    $field = CompanyProfile::find($id);
    $field->company_name = $request['company_name'];
    $field->email = $request['email'];
    $field->mobile = $request['mobile'];
    $field->website_address = $request['website_address'];
    $field->address = $request['address'];
    if ($request->hasFile('logo')) {
      $fileOriginalName = $request->file('logo')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('logo')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('logo')->move('uploads/logo/', $file_name);
      if ($move) {
        // If the logo already exists, delete it
        if ($field->logo_path && file_exists(public_path($field->logo_path))) {
          unlink($field->logo_path);
        }
        $field->logo_path = 'uploads/logo/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    if ($request->hasFile('stamp')) {
      $fileOriginalName = $request->file('stamp')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('stamp')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('stamp')->move('uploads/stamp/', $file_name);
      if ($move) {
        // If the stamp already exists, delete it
        if ($field->stamp_path && file_exists(public_path($field->stamp_path))) {
          unlink($field->stamp_path);
        }
        $field->stamp_path = 'uploads/stamp/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    if ($request->hasFile('signature')) {
      $fileOriginalName = $request->file('signature')->getClientOriginalName();
      $fileNameWithoutExtention = pathinfo($fileOriginalName, PATHINFO_FILENAME);
      $file_name_slug = slugify($fileNameWithoutExtention);
      $fileExtention = $request->file('signature')->getClientOriginalExtension();
      $file_name = $file_name_slug . '_' . time() . '.' . $fileExtention;
      $move = $request->file('signature')->move('uploads/signature/', $file_name);
      if ($move) {
        // If the signature already exists, delete it
        if ($field->signature_path && file_exists(public_path($field->signature_path))) {
          unlink($field->signature_path);
        }
        $field->signature_path = 'uploads/signature/' . $file_name;
      } else {
        session()->flash('emsg', 'Some problem occured. File not uploaded.');
      }
    }
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/' . $this->page_route);
  }
}
