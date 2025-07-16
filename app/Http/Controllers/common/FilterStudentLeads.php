<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class FilterStudentLeads extends Controller
{
  public function getCountry(Request $request)
  {
    $output = '<option value="">Select Country</option>';
    $nationality = $request->input('nationality');
    $countries = Student::select('country')->where('country', '!=', '')->where('nationality', $nationality)->distinct()->get();

    foreach ($countries as $country) {
      $output .= '<option value="' . $country->country . '">' . $country->country . '</option>';
    }

    return response()->json($output);
  }
  public function getState(Request $request)
  {
    $output = '<option value="">Select State</option>';
    $states = Student::select('state')->where('state', '!=', '')->distinct();
    if ($request->has('nationality') && $request->input('nationality') != '') {
      $states = $states->where('nationality', $request->input('nationality'));
    }
    if ($request->has('country')) {
      $states = $states->where('country', $request->input('country'));
    }
    $states = $states->get();

    foreach ($states as $state) {
      $output .= '<option value="' . $state->state . '">' . $state->state . '</option>';
    }

    return response()->json($output);
  }
  public function getCity(Request $request)
  {
    $output = '<option value="">Select City</option>';
    $cities = Student::select('city')->where('city', '!=', '')->distinct();
    if ($request->has('nationality') && $request->input('nationality') != '') {
      $cities = $cities->where('nationality', $request->input('nationality'));
    }
    if ($request->has('country') && $request->input('country') != '') {
      $cities = $cities->where('country', $request->input('country'));
    }
    if ($request->has('state') && $request->input('state') != '') {
      $cities = $cities->where('state', $request->input('state'));
    }
    $cities = $cities->get();

    foreach ($cities as $city) {
      $output .= '<option value="' . $city->city . '">' . $city->city . '</option>';
    }

    return response()->json($output);
  }
  public function getLevel(Request $request)
  {
    $output = '<option value="">Select Level</option>';
    $rows = Student::select('current_qualification_level')->where('current_qualification_level', '!=', '')->distinct();
    if ($request->has('nationality') && $request->input('nationality') != '') {
      $rows = $rows->where('nationality', $request->input('nationality'));
    }
    if ($request->has('country') && $request->input('country') != '') {
      $rows = $rows->where('country', $request->input('country'));
    }
    if ($request->has('state') && $request->input('state') != '') {
      $rows = $rows->where('state', $request->input('state'));
    }
    if ($request->has('city') && $request->input('city') != '') {
      $rows = $rows->where('city', $request->input('city'));
    }
    $rows = $rows->get();

    foreach ($rows as $level) {
      $output .= '<option value="' . $level->current_qualification_level . '">' . $level->getLevel->name . '</option>';
    }

    return response()->json($output);
  }
  public function getCourse(Request $request)
  {
    $output = '<option value="">Select Course</option>';
    $rows = Student::select('intrested_course_category')->where('intrested_course_category', '!=', '')->distinct();
    if ($request->has('nationality') && $request->input('nationality') != '') {
      $rows = $rows->where('nationality', $request->input('nationality'));
    }
    if ($request->has('country') && $request->input('country') != '') {
      $rows = $rows->where('country', $request->input('country'));
    }
    if ($request->has('state') && $request->input('state') != '') {
      $rows = $rows->where('state', $request->input('state'));
    }
    if ($request->has('city') && $request->input('city') != '') {
      $rows = $rows->where('city', $request->input('city'));
    }
    if ($request->has('level') && $request->input('level') != '') {
      $rows = $rows->where('current_qualification_level', $request->input('level'));
    }
    $rows = $rows->get();

    foreach ($rows as $row) {
      $output .= '<option value="' . $row->intrested_course_category . '">' . $row->getCourse->category . '</option>';
    }

    return response()->json($output);
  }
}
