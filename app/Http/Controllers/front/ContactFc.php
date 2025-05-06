<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Mail;

class ContactFc extends Controller
{
  public function index()
  {
    return view('front.contact');
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
    $field = new ContactUs;
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
      return redirect('contact-us');
    } else {
      return redirect('contact-us');
    }
  }
}
