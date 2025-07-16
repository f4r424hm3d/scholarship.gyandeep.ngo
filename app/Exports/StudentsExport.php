<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;

class StudentsExport implements FromView
{
  protected $request;

  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  public function view(): View
  {
    // Apply same filters as in controller

    $rows = Student::with('getLevel', 'getCourse', 'getLastFup', 'getAC');

    if ($this->request->filled('lead_type')) {
      $rows = $rows->where('lead_type', $this->request->lead_type);
    }

    if ($this->request->has('search') && $this->request->search != '') {
      $rows = $rows->where(function ($q) {
        $q->where('name', 'like', '%' . $this->request->search . '%')
          ->orWhere('city', 'like', '%' . $this->request->search . '%')
          ->orWhere('state', 'like', '%' . $this->request->search . '%');
      });
    } else {
      $filterMap = [
        'nationality' => 'nationality',
        'country' => 'country',
        'state' => 'state',
        'city' => 'city',
        'level' => 'current_qualification_level',
        'application_submitted' => 'submit_application',
      ];

      foreach ($filterMap as $requestKey => $dbColumn) {
        if ($this->request->filled($requestKey)) {
          $rows = $rows->where($dbColumn, $this->request->$requestKey);
        }
      }

      if ($this->request->filled('exam_attended')) {
        $rows = $rows->whereHas('lastAttendedExam', function ($query) {
          $query->where('attended', $this->request->exam_attended);
        });
      }

      if ($this->request->filled('from')) {
        $from = date('Y-m-d', strtotime($this->request->from . '-1 days'));
        $rows = $rows->whereDate('created_at', '>', $from);
      }

      if ($this->request->filled('to')) {
        $to = date('Y-m-d', strtotime($this->request->to . '+1 days'));
        $rows = $rows->whereDate('created_at', '<', $to);
      }
    }


    $rows = $rows->get();

    return view('admin.exports.students', [
      'rows' => $rows
    ]);
  }
}
