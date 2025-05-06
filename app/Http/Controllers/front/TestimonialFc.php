<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialFc extends Controller
{
    public function index()
    {
        $rows = Testimonial::orderBy('id', 'desc')->paginate(30);
        $data = compact('rows');
        return view('front.testimonials')->with($data);
    }
}
