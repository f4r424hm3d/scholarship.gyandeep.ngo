<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\AsignLeads;
use App\Models\FollowUpStatus;
use App\Models\FollowUpType;
use App\Models\LeadStatus;
use App\Models\LeadType;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class EmpStudentC extends Controller
{
	public function index(Request $request)
	{
		// if ($request->has('from') && $request->from != '') {
		//     echo $request->from;
		//     echo $from = date('Y-m-d', strtotime($request->from . '-1 days'));
		// }

		if ($request->segment(3) == '') {
			$clt = 'new';
		} else {
			$clt = $request->segment(3);
		}

		$rows = AsignLeads::where('user_id', session()->get('userLoggedIn')['user_id'])->with('getStudent');

		if ($request->has('nationality') && $request->nationality != '') {
			$rows->whereHas('getStudent', function (Builder $query) use ($request) {
				$query->where('nationality', '=', $request->nationality);
			});
		}
		if ($request->has('level') && $request->level != '') {
			$rows->whereHas('getStudent', function (Builder $query) use ($request) {
				$query->where('current_qualification_level', '=', $request->level);
			});
		}
		if ($request->has('course') && $request->course != '') {
			$rows->whereHas('getStudent', function (Builder $query) use ($request) {
				$query->where('intrested_course_category', '=', $request->course);
			});
		}
		// if ($request->has('from') && $request->from != '') {
		//     $rows->whereHas('getStudent', function (Builder $query) use ($request) {
		//         $query->where('created_at', '>=', $request->from);
		//     });
		// }
		// if ($request->has('to') && $request->to != '') {
		//     $rows->whereHas('getStudent', function (Builder $query) use ($request) {
		//         $query->where('created_at', '<=', $request->to);
		//     });
		// }
		if ($request->has('from') && $request->from != '') {
			$from = date('Y-m-d', strtotime($request->from . '-1 days'));
			$rows->whereDate('created_at', '>', $from);
		}
		if ($request->has('to') && $request->to != '') {
			$to = date('Y-m-d', strtotime($request->to . '+1 days'));
			$rows->whereDate('created_at', '<', $to);
		}
		if ($request->has('lead_status') && $request->lead_status != '') {
			$rows->whereHas('getStudent', function (Builder $query) use ($request) {
				$query->where('lead_status', '=', $request->lead_status);
			});
		}
		if ($request->has('lead_sub_status') && $request->lead_sub_status != '') {
			$rows->whereHas('getStudent', function (Builder $query) use ($request) {
				$query->where('lead_sub_status', '=', $request->lead_sub_status);
			});
		}
		$rows->whereHas('getStudent', function (Builder $query) use ($clt) {
			$query->where('lead_type', '=', $clt);
		});

		$rows = $rows->orderBy('id', 'desc')->paginate(20)->withQueryString();
		// printArray($rows->toArray());
		// die;

		$cp = $rows->currentPage();
		$pp = $rows->perPage();
		$i = ($cp - 1) * $pp + 1;

		$cc = Student::with('getCourse')->where('intrested_course_category', '!=', '')->select('intrested_course_category')->distinct()->get();

		$lvl = Student::with('getLevel')->where('current_qualification_level', '!=', '')->select('current_qualification_level')->distinct()->get();

		$nat = Student::select('nationality')->where('nationality', '!=', '')->distinct()->get();

		$lt = LeadType::all();
		$alt = LeadType::all();
		$fuptype = FollowUpType::all();
		$fupstatus = FollowUpStatus::all();
		$ls = LeadStatus::all();
		$data = compact('rows', 'cc', 'lvl', 'nat', 'i', 'lt', 'alt', 'fuptype', 'fupstatus', 'ls');

		// printArray($data->toArray());
		// die;
		return view('employee.students')->with($data);
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

		$nat = Student::select('nationality')->where('nationality', '!=', '')->distinct()->get();

		$data = compact('rows', 'cc', 'lvl', 'nat', 'i');
		return view('employee.students-trash')->with($data);
	}
}
