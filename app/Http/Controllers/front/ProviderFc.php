<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Provider;
use App\Models\ProviderFaq;
use App\Models\ProviderPhotoGallery;
use App\Models\ProviderType;
use App\Models\ProviderVideoGallery;
use App\Models\Scholarship;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProviderFc extends Controller
{
    public function index(Request $request)
    {
        $provider = $request['provider'] ?? '';

        $lvlurl = [];
        $rows = Provider::where('status', 1)->with('getProviderType', 'getCountry');
        if ($provider != '') {
            $lvlurl[] = 'provider=' . $provider;
            $rows = $rows->where('provider_type_id', '=', $provider);
        }

        $final_get_url = implode('&', $lvlurl);
        $rows = $rows->paginate(10)->withPath('providers?' . $final_get_url);
        $pt = ProviderType::all();
        //printArray($rows->toArray());
        //die;
        $filter_level = Level::all();
        $data = compact('rows', 'pt', 'provider', 'filter_level');
        return view('front.providers')->with($data);
    }
    public function providerDetail()
    {
        $slug = request()->segment(2);
        $pro_det = Provider::with('getProviderType', 'getCountry')->where('slug', '=', $slug)->first();

        $data = compact('pro_det');
        return view('front.provider-detail')->with($data);
    }
    public function scholarship(Request $request)
    {
        $slug = request()->segment(2);
        $pro_det = Provider::with('getProviderType', 'getCountry')->where('slug', '=', $slug)->first();

        $p_id = $pro_det->id;

        $level_id = $request['level_id'] ?? '';
        $intrest = $request['intrest'] ?? '';
        $nationality = $request['nationality'] ?? '';
        $payment = $request['payment'] ?? '';

        $lvlurl = [];

        $allsch = Scholarship::where('provider_id', '=', $p_id)->where('status', '=', '1')->with('getSchLevel', 'getSchSubject', 'getSchCountry');

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

        $final_get_url = implode('&', $lvlurl);
        $allsch = $allsch->paginate(10)->withPath('scholarship?' . $final_get_url);

        $data = compact('pro_det', 'allsch', 'level_id', 'nationality', 'intrest', 'payment');
        return view('front.provider-scholarship')->with($data);
    }
    public function gallery()
    {
        $slug = request()->segment(2);
        $pro_det = Provider::with('getProviderType', 'getCountry')->where('slug', '=', $slug)->first();

        $provider_id = $pro_det->id;
        $photos = ProviderPhotoGallery::where('provider_id', '=', $provider_id)->get();
        $videos = ProviderVideoGallery::where('provider_id', '=', $provider_id)->get();
        $data = compact('pro_det', 'photos', 'videos');
        return view('front.provider-gallery')->with($data);
    }
    public function faqs()
    {
        $slug = request()->segment(2);
        $pro_det = Provider::with('getProviderType', 'getCountry')->where('slug', '=', $slug)->first();
        $provider_id = $pro_det->id;
        $faqs = ProviderFaq::where('provider_id', '=', $provider_id)->get();
        $data = compact('pro_det', 'faqs');
        return view('front.provider-faqs')->with($data);
    }
}
