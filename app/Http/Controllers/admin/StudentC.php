<?php

namespace App\Http\Controllers\admin;

use App\Exports\StudentsExport;
use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use App\Models\Country;
use App\Models\CourseCategory;
use App\Models\FollowUpStatus;
use App\Models\FollowUpType;
use App\Models\LeadStatus;
use App\Models\LeadType;
use App\Models\Level;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class StudentC extends Controller
{
  public function index(Request $request)
  {
    if ($request->segment(3) == '') {
      $clt = 'new';
    } else {
      $clt = $request->segment(3);
    }

    $limit_per_page = $request->limit_per_page ?? 25;
    $order_by = $request->order_by ?? 'id';
    $order_in = $request->order_in ?? 'DESC';
    $rows = Student::with('getLevel', 'getCourse', 'getLastFup', 'getAC')->orderBy($order_by, $order_in);
    $filterApplied = false;
    if ($request->has('search') && $request->search != '') {
      $rows = $rows->where('name', 'like', '%' . $request->search . '%')->orWhere('email', 'like', '%' . $request->search . '%')->orWhere('mobile', 'like', '%' . $request->search . '%');
    } else {
      if ($request->has('nationality') && $request->nationality != '') {
        $rows = $rows->where('nationality', $request->nationality);
        $filterApplied = true;
      }
      if ($request->has('country') && $request->country != '') {
        $rows = $rows->where('country', $request->country);
        $filterApplied = true;
      }
      if ($request->has('state') && $request->state != '') {
        $rows = $rows->where('state', $request->state);
        $filterApplied = true;
      }
      if ($request->has('city') && $request->city != '') {
        $rows = $rows->where('city', $request->city);
        $filterApplied = true;
      }
      if ($request->has('level') && $request->level != '') {
        $rows = $rows->where('current_qualification_level', $request->level);
        $filterApplied = true;
      }
      if ($request->has('application_submitted') && $request->application_submitted != '') {
        $rows = $rows->where('submit_application', $request->application_submitted);
        $filterApplied = true;
      }
      if ($request->has('exam_attended') && $request->exam_attended != '') {
        $rows = $rows->whereHas('lastAttendedExam', function ($query) use ($request) {
          $query->where('attended', $request->exam_attended);
        });
        $filterApplied = true;
      }
      if ($request->has('from') && $request->from != '') {
        $from = date('Y-m-d', strtotime($request->from . '-1 days'));
        $rows = $rows->whereDate('created_at', '>', $from);
        $filterApplied = true;
      }
      if ($request->has('to') && $request->to != '') {
        $to = date('Y-m-d', strtotime($request->to . '+1 days'));
        $rows = $rows->whereDate('created_at', '<', $to);
        $filterApplied = true;
      }
      // if ($request->has('lead_status') && $request->lead_status != '') {
      //   $rows = $rows->where('lead_status', $request->lead_status);
      //   $filterApplied = true;
      // }
      // if ($request->has('lead_sub_status') && $request->lead_sub_status != '') {
      //   $rows = $rows->where('lead_sub_status', $request->lead_sub_status);
      //   $filterApplied = true;
      // }
    }

    $rows = $rows->where('lead_type', $clt);
    $rows = $rows->paginate($limit_per_page)->withQueryString();
    //printArray($rows->toArray());
    //die;

    $cp = $rows->currentPage();
    $pp = $rows->perPage();
    $i = ($cp - 1) * $pp + 1;

    $lpp = ['25', '50', '100'];
    $orderColumns = ['Name' => 'name', 'Date' => 'id'];

    $filterNationalities = Student::select('nationality')->where('nationality', '!=', '')->distinct()->get();

    $filterCountries = Student::select('country')->where('country', '!=', '')->distinct();
    if ($request->has('nationality') && $request->nationality != '') {
      $filterCountries = $filterCountries->where('nationality', $request->nationality);
    }
    $filterCountries = $filterCountries->get();

    $filterStates = Student::select('state')->where('state', '!=', '')->distinct();
    if ($request->has('nationality') && $request->nationality != '') {
      $filterStates = $filterStates->where('nationality', $request->nationality);
    }
    if ($request->has('country') && $request->country != '') {
      $filterStates = $filterStates->where('country', $request->country);
    }
    $filterStates = $filterStates->get();

    $filterCities = Student::select('city')->where('city', '!=', '')->distinct();
    if ($request->has('nationality') && $request->nationality != '') {
      $filterCities = $filterCities->where('nationality', $request->nationality);
    }
    if ($request->has('country') && $request->country != '') {
      $filterCities = $filterCities->where('country', $request->country);
    }
    if ($request->has('state') && $request->state != '') {
      $filterCities = $filterCities->where('state', $request->state);
    }
    $filterCities = $filterCities->get();

    $filterLevels = Student::with('getLevel')->where('current_qualification_level', '!=', '')->select('current_qualification_level')->distinct();
    if ($request->has('nationality') && $request->nationality != '') {
      $filterLevels = $filterLevels->where('nationality', $request->nationality);
    }
    if ($request->has('country') && $request->country != '') {
      $filterLevels = $filterLevels->where('country', $request->country);
    }
    if ($request->has('state') && $request->state != '') {
      $filterLevels = $filterLevels->where('state', $request->state);
    }
    if ($request->has('city') && $request->city != '') {
      $filterLevels = $filterLevels->where('city', $request->city);
    }
    $filterLevels = $filterLevels->get();

    $lt = LeadType::all();
    //die;
    $alt = LeadType::all();
    $fuptype = FollowUpType::all();
    $fupstatus = FollowUpStatus::all();
    $ls = LeadStatus::all();
    $counsellor = User::where('role', '=', 'Counsellor')->where('status', '=', '1')->get();
    $data = compact('rows', 'filterLevels', 'filterNationalities', 'filterCountries', 'filterStates', 'filterCities', 'i', 'lt', 'alt', 'fuptype', 'fupstatus', 'ls', 'counsellor', 'clt', 'lpp', 'orderColumns', 'filterApplied', 'order_by', 'order_in', 'limit_per_page');
    return view('admin.students')->with($data);
  }
  public function trash(Request $request)
  {
    $rows = Student::onlyTrashed()->with('getLevel', 'getCourse');

    if ($request->has('nationality') && $request->nationality != '') {
      $rows = $rows->where('nationality', $request->nationality);
    }
    if ($request->has('level') && $request->level != '') {
      $rows = $rows->where('current_qualification_level', $request->level);
    }
    if ($request->has('course') && $request->course != '') {
      $rows = $rows->where('intrested_course_category', $request->course);
    }

    $rows = $rows->paginate(20)->withQueryString();
    // printArray($rows->toArray());
    // die;

    $cp = $rows->currentPage();
    $pp = $rows->perPage();
    $i = ($cp - 1) * $pp + 1;

    $cc = Student::with('getCourse')->where('intrested_course_category', '!=', '')->select('intrested_course_category')->distinct()->get();

    $lvl = Student::with('getLevel')->where('current_qualification_level', '!=', '')->select('current_qualification_level')->distinct()->get();

    $filterNationalities = Student::select('nationality')->where('nationality', '!=', '')->distinct()->get();
    $filterCountries = Student::select('country')->where('country', '!=', '')->distinct()->get();
    $filterStates = Student::select('state')->where('state', '!=', '')->distinct()->get();
    $filterCities = Student::select('city')->where('city', '!=', '')->distinct()->get();

    $data = compact('rows', 'cc', 'lvl', 'filterNationalities', 'filterCountries', 'filterStates', 'filterCities', 'i');
    return view('admin.students-trash')->with($data);
  }
  public function delete($id)
  {
    //echo $id;
    echo $result = Student::find($id)->delete();
  }
  public function bulkDelete(Request $request)
  {
    $ids = $request['ids'];
    $td = 0;
    for ($i = 0; $i < count($ids); $i++) {
      //$result = Student::find($ids[$i])->delete();
      $result = Student::find($ids[$i])->forceDelete();
      if ($result) {
        $td++;
      }
    }
    session()->flash('smsg', $td . ' records deleted succesfully.');
    echo $td;
  }
  public function bulkForceDelete(Request $request)
  {
    $ids = $request['ids'];
    $td = 0;
    for ($i = 0; $i < count($ids); $i++) {
      $result = Student::withTrashed()->find($ids[$i])->forceDelete();
      if ($result) {
        $td++;
      }
    }
    session()->flash('smsg', $td . ' record deleted succesfully.');
    echo $td;
  }
  public function bulkRestore(Request $request)
  {
    $ids = $request['ids'];
    $td = 0;
    for ($i = 0; $i < count($ids); $i++) {
      $result = Student::withTrashed()->find($ids[$i])->restore();
      if ($result) {
        $td++;
      }
    }
    session()->flash('smsg', $td . ' record restored succesfully.');
    echo $td;
  }
  public function add()
  {
    $ft = 'add';
    $url = url('admin/student/store');
    $title = 'Add New';
    $sd = '';
    $country = Country::all();
    $levels = Level::all();
    $cc = CourseCategory::all();
    $data = compact('sd', 'ft', 'url', 'title', 'country', 'levels', 'cc');
    return view('admin.add-students')->with($data);
  }
  public function store(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'name' => 'required',
        'email' => 'required|email|unique:students,email',
        'c_code' => 'required|numeric',
        'mobile' => 'required|numeric',
      ]
    );
    $field = new Student;
    $field->name = $request['name'];
    $field->email = $request['email'];
    $field->c_code = $request['c_code'];
    $field->mobile = $request['mobile'];
    $field->gender = $request['gender'];
    $field->nationality = $request['nationality'];
    $field->source = $request['source'];
    $field->dob = $request['dob'];
    $field->current_qualification_level = $request['current_qualification_level'];
    $field->intrested_course_category = $request['intrested_course_category'];
    $field->address = $request['address'];
    $field->city = $request['city'];
    $field->state = $request['state'];
    $field->country = $request['country'];
    $field->password = Str::random(10);
    $field->status = 1;
    $field->lead_type = 'new';
    $field->save();
    session()->flash('smsg', 'New record has been added successfully.');
    return redirect('admin/student/add');
  }
  public function Import(Request $request)
  {
    // printArray($data->all());
    // die;
    $request->validate([
      'file' => 'required|mimes:xlsx,csv,xls',
    ]);
    $file = $request->file;
    if ($file) {
      try {
        $result = Excel::import(new StudentImport, $file);
        // session()->flash('smsg', 'Data has been imported succesfully.');
        return redirect('admin/student/add');
      } catch (\Exception $ex) {
        dd($ex);
      }
    }
  }
  public function export(Request $request)
  {
    return Excel::download(new StudentsExport($request), 'students.xlsx');
  }
}
