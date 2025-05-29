<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CreateExams;
use App\Models\Scholarship;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentProfileC extends Controller
{
  public function index(Request $request, $studentId)
  {
    $countries = Country::all();
    $student = Student::find($studentId);
    $maritulStatuses = ['Single' => 'Single', 'Married' => 'Married'];
    $page_title = 'Student Profile';
    $ft = 'edit';
    $page_route = 'student';

    $scholarships = Scholarship::where('deadline', '>=', date('Y-m-d'))->get();
    if (old('scholarship')) {
      $categories = CreateExams::where('scholarship_id', old('scholarship'))->groupBy('course_category_id')->inRandomOrder()->get();
    } else {
      $categories = null;
    }
    $data = compact('student', 'page_title', 'ft', 'page_route', 'countries', 'maritulStatuses', 'scholarships', 'categories');
    return view('backend.student-profile', $data);
  }
  public function update(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'name' => 'required',
        'email' => 'required|email|unique:students,email,' . $request['id'],
        'c_code' => 'required|numeric',
        'mobile' => 'required|numeric',
        'marksheet_10_copy' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1025',
        'marksheet_12_copy' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1025',
        'aadhar_copy' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1025',
        'photo_copy' => 'nullable|mimes:jpg,jpeg,png|max:1025',
        'neet_result_copy' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1025',
        'passport_copy' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1025',
      ]
    );
    $field = Student::find($request['id']);
    $field->name = $request['name'];
    $field->c_code = $request['c_code'];
    $field->mobile = $request['mobile'];
    $field->father = $request['father'];
    $field->mother = $request['mother'];
    $field->parents_mobile = $request['parents_mobile'];
    $field->nationality = $request['nationality'];
    $field->gender = $request['gender'];
    $field->parents_occupation = $request['parents_occupation'];
    $field->dob = $request['dob'];
    $field->first_language = $request['first_language'];
    $field->marital_status = $request['marital_status'];
    $field->passport_number = $request['passport_number'];
    $field->passport_expiry_date = $request['passport_expiry_date'];
    $field->religion = $request['religion'];
    $field->address = $request['address'];
    $field->city = $request['city'];
    $field->state = $request['state'];
    $field->country = $request['country'];
    $field->zipcode = $request['zipcode'];

    $field->passing_year_10 = $request['passing_year_10'];
    $field->result_10 = $request['result_10'];
    $field->passing_year_12 = $request['passing_year_12'];
    $field->result_12 = $request['result_12'];
    $field->neet_passing_year = $request['neet_passing_year'];
    $field->neet_result = $request['neet_result'];

    if ($request->hasFile('marksheet_10_copy')) {
      $file = $request->file('marksheet_10_copy');
      $filename = time() . '_marksheet_10.' . $file->getClientOriginalExtension();
      $file->move('uploads/marksheet/', $filename);
      $field->marksheet_10_path = 'uploads/marksheet/' . $filename;
    }
    if ($request->hasFile('marksheet_12_copy')) {
      $file = $request->file('marksheet_12_copy');
      $filename = time() . '_marksheet_12.' . $file->getClientOriginalExtension();
      $file->move('uploads/marksheet/', $filename);
      $field->marksheet_12_path = 'uploads/marksheet/' . $filename;
    }
    if ($request->hasFile('aadhar_copy')) {
      $file = $request->file('aadhar_copy');
      $filename = time() . '_aadhar.' . $file->getClientOriginalExtension();
      $file->move('uploads/aadhar/', $filename);
      $field->aadhar_path = 'uploads/aadhar/' . $filename;
    }

    if ($request->hasFile('passport_copy')) {
      $file = $request->file('passport_copy');
      $filename = time() . '_passport.' . $file->getClientOriginalExtension();
      $file->move('uploads/passport/', $filename);
      $field->passport_path = 'uploads/passport/' . $filename;
    }
    if ($request->hasFile('neet_result_copy')) {
      $file = $request->file('neet_result_copy');
      $filename = time() . '_neet_result.' . $file->getClientOriginalExtension();
      $file->move('uploads/neet_result/', $filename);
      $field->neet_result_path = 'uploads/neet_result/' . $filename;
    }
    if ($request->hasFile('photo_copy')) {
      $file = $request->file('photo_copy');
      $filename = time() . '_photo.' . $file->getClientOriginalExtension();
      $file->move('uploads/student/', $filename);
      $field->photo_path = 'uploads/student/' . $filename;
    }
    $field->submit_application = 1;
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/student/' . $field->id . '/profile');
  }
}
