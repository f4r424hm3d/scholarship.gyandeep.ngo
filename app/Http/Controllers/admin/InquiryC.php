<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class InquiryC extends Controller
{
  public function contctUs()
  {
    $rows = ContactUs::orderBy('id', 'desc')->get();
    $data = compact('rows');
    return view('admin.contact-us-inquiry')->with($data);
  }
  public function deleteContctUs($id)
  {
    //echo $id;
    echo $result = ContactUs::find($id)->delete();
  }
}
