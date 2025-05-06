<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\PageContent;
use App\Models\Provider;
use App\Models\Scholarship;
use App\Models\ScholarshipCustomEligibility;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ScholarshipFc extends Controller
{
    public function index(Request $request)
    {
        $level_id = $request['level_id'] ?? '';
        $intrest = $request['intrest'] ?? '';
        $nationality = $request['nationality'] ?? '';
        $payment = $request['payment'] ?? '';
        $provider_type_id = $request['provider'] ?? '';

        $lvlurl = [];

        $allsch = Scholarship::with('getSchLevel', 'getSchSubject', 'getSchCountry', 'getProvider')->where('status', '1');

        $allsch->whereHas('getProvider', function (Builder $query) {
            $query->where('status', '=', '1');
        });

        if ($nationality != '') {
            $lvlurl[] = 'nationality=' . $nationality;
            $allsch->whereHas('getSchCountry', function (Builder $query) use ($nationality) {
                $query->where('country', '=', $nationality);
            });
        }
        if ($level_id != '') {
            $lvlurl[] = 'level_id=' . $level_id;
            $allsch->whereHas('getSchLevel', function (Builder $query) use ($level_id) {
                $query->where('level_id', '=', $level_id);
            });
        }

        if ($intrest != '') {
            $lvlurl[] = 'intrest=' . $intrest;
            $allsch->whereHas('getSchSubject', function (Builder $query) use ($intrest) {
                $query->where('spc_id', '=', $intrest);
            });
        }
        if ($payment != '') {
            $lvlurl[] = 'payment=' . $payment;
            $allsch->where('covers', '=', $payment);
        }
        if ($provider_type_id != '') {
            $lvlurl[] = 'provider=' . $provider_type_id;
            $allsch->where('provider_type_id', '=', $provider_type_id);
        }

        $final_get_url = implode('&', $lvlurl);
        $allsch = $allsch->paginate(10)->withPath('scholarships?' . $final_get_url);

        $sc = PageContent::where('page_name', 'scholarship')->get();
        //printArray($allsch->toArray());
        //die;
        $data = compact('allsch', 'level_id', 'nationality', 'intrest', 'payment', 'provider_type_id', 'sc');
        return view('front.scholarship')->with($data);
    }
    public function scholarshipByLevel(Request $request)
    {
        $seg1 = request()->segment(1);
        $segArray = explode('-', $seg1);
        array_pop($segArray);
        //array_pop($segArray);
        $lvl_slug = implode('-', $segArray);
        $lvld = Level::where('seo_name_slug', '=', $lvl_slug)->first();
        $level_id = $lvld->id ?? '';

        $allsch = Scholarship::with('getSchLevel', 'getSchSubject', 'getSchCountry');

        if ($level_id != '') {
            $allsch->whereHas('getSchLevel', function (Builder $query) use ($level_id) {
                $query->where('level_id', '=', $level_id);
            });
        }

        $allsch = $allsch->paginate(10);

        //printArray($allsch->toArray());
        //die;

        $intrest = '';
        $nationality = '';
        $payment = '';
        $provider_type_id = '';
        $sc = PageContent::where('page_name', 'scholarship')->get();
        $data = compact('allsch', 'level_id', 'nationality', 'intrest', 'payment', 'provider_type_id', 'sc');
        return view('front.scholarship')->with($data);
    }
    public function scholarshipDetail()
    {
        $id = request()->segment(2);
        $slug = request()->segment(3);
        $schdet = Scholarship::with('getSchLevel', 'getSchSubject', 'getSchCountry');
        $schdet->where('id', '=', $id)->where('slug', '=', $slug);
        $schdet = $schdet->first();

        $today = date('Y-m-d');
        $deadline = $schdet->deadline;
        if ($today > $deadline) {
            $dl = '<span class="text-danger">Expired</span><br>Try next time';
            $dtexp = true;
        } else {
            $dl = 'Expires in ' . dateDiff($today, $deadline) . ' days';
            $dtexp = false;
        }
        //$levels = '';
        $levelArray = [];
        foreach ($schdet->getSchLevel as $lvl) {
            $levelArray[] = $lvl->getLevel->name;
        }
        $lvls = implode(' , ', $levelArray);
        $subjectArray = [];
        foreach ($schdet->getSchSubject as $sub) {
            $subjectArray[] = $sub->getSubject->specialization;
        }
        $subjects = implode(' , ', $subjectArray);

        $provider = Provider::find($schdet->provider_id);
        $filter_level = Level::all();
        $data = compact('schdet', 'dl', 'lvls', 'subjects', 'provider', 'filter_level','dtexp');
        return view('front.scholarship-detail')->with($data);
    }
    public function scholarshipDetailInstruction()
    {
        $id = request()->segment(2);
        $slug = request()->segment(3);
        $schdet = Scholarship::with('getSchLevel', 'getSchSubject', 'getSchCountry');
        $schdet->where('id', '=', $id)->where('slug', '=', $slug);
        $schdet = $schdet->first();

        $today = date('Y-m-d');
        $deadline = $schdet->deadline;
        if ($today > $deadline) {
            $dl = 'Expired try next time';
        } else {
            $dl = 'Expires in ' . dateDiff($today, $deadline) . ' days';
        }
        //$levels = '';
        $levelArray = [];
        foreach ($schdet->getSchLevel as $lvl) {
            $levelArray[] = $lvl->getLevel->name;
        }
        $lvls = implode(' , ', $levelArray);
        $subjectArray = [];
        foreach ($schdet->getSchSubject as $sub) {
            $subjectArray[] = $sub->getSubject->specialization;
        }
        $subjects = implode(' , ', $subjectArray);

        $provider = Provider::find($schdet->provider_id);
        $filter_level = Level::all();

        $schques = ScholarshipCustomEligibility::where('scholarship_id', '=', $schdet->id)->get();
        if (is_null($schques)) {
            $totalEligQues = 0;
        } else {
            $totalEligQues = count($schques);
        }
        $data = compact('schdet', 'dl', 'lvls', 'subjects', 'provider', 'filter_level', 'schques', 'totalEligQues');
        return view('front.scholarship-instruction')->with($data);
    }
}
