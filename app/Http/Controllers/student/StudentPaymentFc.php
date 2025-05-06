<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppliedScholarship;
use App\Models\ExamPaymentDetails;
use App\Models\Student;

class StudentPaymentFc extends Controller
{
    public function index()
    {
        return view('front.student.payment-page');
    }
    public function payment(Request $request)
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
                'payment_receipt' => 'required|max:1024|mimes:jpg,jpeg,png,gif,pdf'
            ],
            [
                'payment_receipt.max' => 'The file may not be greater than 1 MB'
            ]
        );
        $student_id = session()->get('student_id');
        $student = Student::find($student_id);
        $field = new ExamPaymentDetails;
        if ($request->hasFile('payment_receipt')) {
            $payment_receipt = time() . '.' . $request->file('payment_receipt')->getClientOriginalExtension();
            $payment_receipt = $request->file('payment_receipt')->move('uploads/payment_receipt/', $payment_receipt);
            $field->payment_receipt = $payment_receipt;
        }
        $field->student_id = $student_id;
        $field->application_id = $request['application_id'];
        $field->from = $request['from'];
        $field->amount = $request['amount'];
        $field->transaction_id = $request['transaction_id'];
        $field->payment_date = $request['payment_date'];
        $field->payment_through = $request['payment_through'];
        $field->status = 'Under Review';
        $res = $field->save();
        if ($res) {
            $nf = AppliedScholarship::where('id', '=', $request['application_id'])->first();
            $nf->payment_status = 'Reviewing';
            $nf->save();
        }
        session()->flash('smsg', 'Record has been saved.');
        return redirect($request['back_url']);
    }
}
