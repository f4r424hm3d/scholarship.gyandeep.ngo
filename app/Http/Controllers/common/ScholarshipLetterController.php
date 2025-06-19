<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use App\Models\StudentScholarshipLetter;
use Illuminate\Http\Request;

class ScholarshipLetterController extends Controller
{
  public function view($id)
  {
    $letter = StudentScholarshipLetter::find($id);
    $page_title = 'View Letter';
    $data = compact('letter', 'id', 'page_title');
    return view('admin.view-letter')->with($data);
  }
  public function print($id)
  {
    $letter = StudentScholarshipLetter::find($id);
    $page_title = 'Print Letter';
    $data = compact('letter', 'id', 'page_title');
    return view('admin.print-letter')->with($data);
  }
}
