<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AppliedScholarship;
use App\Models\AsignExam;
use App\Models\CreateExams;
use App\Models\ExamPaymentDetails;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApplicationsC extends Controller
{
  public function index(Request $request)
  {
    $rows = AppliedScholarship::with('getScholarship', 'getStudent', 'getLevel', 'getCat', 'getSubject', 'getAsignExam');
    $rows = $rows->whereHas('getStudent', function ($query) {
      $query->where('deleted_at', null);
    });
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

    $data = compact('rows', 'i');
    return view('admin.applications')->with($data);
  }
  public function submitPayment(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'from' => 'required',
        'amount' => 'required|numeric',
        'transaction_id' => 'required',
        'payment_date' => 'required|date',
        'payment_through' => 'required',
        'payment_receipt' => 'required|max:1024|mimes:jpg,jpeg,png,gif,pdf',
      ],
      [
        'payment_receipt.max' => 'The file may not be greater than 1 MB',
      ]
    );
    $student_id = $request['student_id'];
    $student = Student::find($student_id);
    $field = new ExamPaymentDetails;
    if ($request->hasFile('payment_receipt')) {
      $file_name = time() . '.' . $request->file('payment_receipt')->getClientOriginalExtension();
      $request->file('payment_receipt')->move('uploads/payment_receipt/', $file_name);
      $field->payment_receipt = 'uploads/payment_receipt/' . $file_name;
    }
    $field->student_id = $student_id;
    $field->application_id = $request['application_id'];
    $field->from = $request['from'];
    $field->amount = $request['amount'];
    $field->transaction_id = $request['transaction_id'];
    $field->payment_date = $request['payment_date'];
    $field->payment_through = $request['payment_through'];
    $field->status = 'Approved';
    $res = $field->save();
    if ($res) {
      $nf = AppliedScholarship::where('id', '=', $request['application_id'])->first();
      $nf->payment_status = 'Success';
      $nf->save();
    }
    session()->flash('smsg', 'Payment submitted.');
    return redirect('admin/applications');
  }
  public function viewPayment(Request $request)
  {
    $output = '';
    $rows = ExamPaymentDetails::where('application_id', $request->id)->get();
    if (!is_null($rows)) {
      foreach ($rows as $row) {
        if ($row->status == 'Under Review') {
          $cls = 'primary';
        }
        if ($row->status == 'Approved') {
          $cls = 'success';
        }
        if ($row->status == 'Canceled') {
          $cls = 'danger';
        }
        $output .= '<div class="card"><div class="card-body"><table class="table table-striped table-sm"><tbody>';
        $output .= '<tr><th>From</th><td>' . $row->from . '</td></tr>';
        $output .= '<tr><th>Amount</th><td>' . $row->amount . '</td></tr>';
        $output .= '<tr><th>Transaction Id</th><td>' . $row->transaction_id . '</td></tr>';
        $output .= '<tr><th>Payment Date</th><td>' . $row->payment_date . '</td></tr>';
        $output .= '<tr><th>Payment Through</th><td>' . $row->payment_through . '</td></tr>';
        $output .= '<tr><th>Payment Receipt</th><td><a target="_blank" href="' . url($row->payment_receipt) . '">View</a></td></tr>';
        $output .= '<tr><th>Status</th><td><span class="badge badge-' . $cls . '">' . $row->status . '</span></td></tr>';

        $output .= '<tr><th></th><td><a class="btn btn-sm btn-outline btn-primary" href="' . url('admin/applications/update-payment-status?app_id=' . $row->application_id . '&id=' . $row->id . '&status=Under Review') . '">Under Review</a> | <a class="btn btn-sm btn-outline btn-success" href="' . url('admin/applications/update-payment-status?app_id=' . $row->application_id . '&id=' . $row->id . '&status=Approved') . '">Approved</a> | <a class="btn btn-sm btn-outline btn-danger" href="' . url('admin/applications/update-payment-status?app_id=' . $row->application_id . '&id=' . $row->id . '&status=Canceled') . '">Canceled</a></td></tr>';
        $output .= '</tbody></table></div></div>';
      }
    } else {
      $output = 'No data found';
    }
    echo $output;
  }

  public function updatePaymentStatus(Request $request)
  {
    // printArray($request->all());
    // die;

    $app_id = $request['app_id'];
    $id = $request['id'];
    $status = $request['status'];
    if ($status == 'Under Review') {
      $payment_status = 'Reviewing';
    }
    if ($status == 'Approved') {
      $payment_status = 'Success';
    }
    if ($status == 'Canceled') {
      $payment_status = 'Pending';
    }
    $as = AppliedScholarship::find($app_id);
    $as->payment_status = $payment_status;
    $as->save();

    $as = ExamPaymentDetails::find($id);
    $as->status = $status;
    $as->save();

    if ($status == 'Approved') {
      //$remember_token = Str::random(45);
      $appDet = AppliedScholarship::find($app_id);
      $std = Student::find($appDet->std_id);
      //$std->remember_token = $remember_token;
      //$std->save();
      $ae = AsignExam::where('application_id', $app_id)->first();
      $exmDet = CreateExams::find($ae->exam_id);

      $emaildata = ['name' => $std->name, 'token' => $exmDet->token, 'exam_date' => $exmDet->exam_date, 'start_time' => $exmDet->start_time, 'end_time' => $exmDet->end_time];

      $dd = ['to' => $std->email, 'to_name' => $std->name, 'subject' => 'Mock Test for Scholarship'];

      // printArray($emaildata);
      // printArray($dd);
      // die;

      $chk = Mail::send(
        'mails.exam-test-link',
        $emaildata,
        function ($message) use ($dd) {
          $message->to($dd['to'], $dd['to_name']);
          $message->subject($dd['subject']);
          $message->priority(1);
        }
      );
    }

    session()->flash('smsg', 'Payment submitted.');
    return redirect('admin/applications');
  }
  public function bulkDelete(Request $request)
  {
    $ids = $request['ids'];
    $td = 0;
    for ($i = 0; $i < count($ids); $i++) {
      $result = AppliedScholarship::find($ids[$i])->delete();
      if ($result) {
        $td++;
      }
    }
    session()->flash('smsg', $td . ' record deleted succesfully.');
    echo $td;
  }
}
