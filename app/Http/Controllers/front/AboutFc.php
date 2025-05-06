<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutFc extends Controller
{
    public function index()
    {
        return view('front.about');
    }
    public function mudraEducation()
    {
        return view('front.about-mudra-education');
    }
    public function scholarship()
    {
        return view('front.about-scholarship');
    }
}
