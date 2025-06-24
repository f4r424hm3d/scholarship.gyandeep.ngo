<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use App\Models\StudentScholarshipLetter;
use Barryvdh\DomPDF\Facade\Pdf;
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
  public function view_y(Request $request, $id)
  {
    $letter = StudentScholarshipLetter::find($id);
    $page_title = 'Print Letter';
    $data = compact('letter', 'id', 'page_title');

    $pdf = PDF::loadView('admin.print-letter', $data)->setPaper('a4', 'portrait')->setWarnings(false);

    $file_name = slugify('score-result') . '_' . date('dmY_His') . '.pdf';

    if ($request->has('download')) {
      return $pdf->download($file_name);
    } else {
      return $pdf->stream($file_name);
    }
  }
  public function viewTest(Request $request, $id)
  {
    $letter = StudentScholarshipLetter::find($id);
    $page_title = 'Print Letter';
    $data = compact('letter', 'id', 'page_title');

    $pdf = PDF::loadView('admin.test-print-letter', $data)->setPaper('a4', 'portrait')->setWarnings(false);

    $file_name = slugify('score-result') . '_' . date('dmY_His') . '.pdf';

    if ($request->has('download')) {
      return $pdf->download($file_name);
    } else {
      return $pdf->stream($file_name);
    }
  }
  public function print($id)
  {
    $letter = StudentScholarshipLetter::find($id);
    $page_title = 'Print Letter';
    $data = compact('letter', 'id', 'page_title');
    return view('admin.print-letter')->with($data);
  }
}
