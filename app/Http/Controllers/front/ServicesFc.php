<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ServicesFc extends Controller
{
  public function index()
  {
    $rows = Services::orderBy('id')->paginate(36);
    // printArray($rows);
    // die;
    $data = compact('rows');
    return view('front.services')->with($data);
  }
  public function serviceDetail($id, $slug)
  {
    $where = ['id' => $id, 'slug' => $slug];
    $row = Services::where($where)->firstOrFail();
    // printArray($row);
    // die;
    $data = compact('row');
    return view('front.service-details')->with($data);
  }
  public function submitInquiry(Request $request)
  {
    // printArray($request->all());
    // die;
    $request->validate(
      [
        'name' => 'required|regex:/^[a-zA-Z ]*$/',
        'email' => 'required|email',
        'mobile' => 'required|numeric',
        'key' => 'required|numeric|same:key1',
      ],
      ['key.same' => 'Entered wrong number.']
    );
    $field = new ContactUs();
    $field->name = $request['name'];
    $field->email = $request['email'];
    $field->mobile = $request['mobile'];
    $field->message = $request['message'];
    $field->status = 0;
    $field->save();

    session()->flash('smsg', ' Your inquiry has been submitted. we will contact you soon..');

    $emaildata = ['name' => $request['name']];
    $dd = ['to' => $request['email'], 'to_name' => $request['name'], 'subject' => 'Inquiry'];

    $chk = Mail::send(
      'front.mailtemplate.inquiry-submitted',
      $emaildata,
      function ($message) use ($dd) {
        $message->to($dd['to'], $dd['to_name']);
        $message->subject($dd['subject']);
        $message->priority(1);
      }
    );

    if ($chk == false) {
      return redirect($request['back_url']);
    } else {
      return redirect($request['back_url']);
    }
  }
}
