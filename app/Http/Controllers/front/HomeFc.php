<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Country;
use App\Models\Level;
use App\Models\Provider;
use App\Models\Scholarship;
use App\Models\Specialization;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomeFc extends Controller
{
  public function index(Request $request)
  {
    $filter_nationality = Country::all();
    $filter_level = Level::all();
    $spc = Specialization::all();
    $providers = Provider::where('status', '=', '1')->limit(6)->get();

    $where = ['status' => '1', 'source' => 'self'];
    $scholarship = Scholarship::with('getProvider');
    $scholarship->whereHas('getProvider', function (Builder $query) {
      $query->where('status', '=', '1');
    });
    $scholarship = $scholarship->where($where)->limit(10)->get();

    $blogs = Blog::orderBy('id', 'desc')->limit(10)->get();
    // printArray($scholarship->all());
    // die;
    $data = compact('filter_nationality', 'filter_level', 'spc', 'providers', 'scholarship', 'blogs');
    return view('front.index')->with($data);
  }
  public function eligibilityCriteria()
  {
    return view('front.eligibility-criteria');
  }
  public function termsConditions()
  {
    return view('front.terms-conditions');
  }
  public function privacyPolicy()
  {
    return view('front.privacy-policy');
  }
  public function disclaimer()
  {
    return view('front.disclaimer');
  }
  public function copyrightPolicy()
  {
    return view('front.copyright-policy');
  }
  public function cancellationRefund()
  {
    return view('front.cancellation-refund');
  }
}
