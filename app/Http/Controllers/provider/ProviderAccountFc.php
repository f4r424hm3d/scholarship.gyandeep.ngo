<?php

namespace App\Http\Controllers\provider;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Provider;
use App\Models\ProviderType;
use App\Models\State;
use Illuminate\Http\Request;

class ProviderAccountFc extends Controller
{
    public function profile()
    {
        $id = session()->get('provider_id');
        $provider = Provider::find($id);
        $cc = Country::orderBy('phonecode', 'ASC')->where('phonecode', '!=', 0)->get();
        $country = Country::orderBy('name', 'ASC')->get();
        $data = compact('provider', 'country', 'cc');
        return view('front.provider.profile')->with($data);
    }
    public function editProfile()
    {
        $id = session()->get('provider_id');
        $provider = Provider::find($id);
        $cc = Country::orderBy('phonecode', 'ASC')->where('phonecode', '!=', 0)->get();
        $country = Country::orderBy('name', 'ASC')->get();
        $pt = ProviderType::all();
        $state = State::all();
        $data = compact('provider', 'country', 'cc', 'pt', 'state');
        return view('front.provider.edit-profile')->with($data);
    }
    public function updateProfile(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|regex:/^[a-zA-Z ]*$/',
                'gender' => 'required|in:Male,Female,Other',
                'c_code' => 'required|numeric',
                'mobile' => 'required|numeric',
                'dob' => 'required|date',
                'nationality' => 'required',
                'provider_type_id' => 'required|numeric',
                'provider_name' => 'required',
                'global_rank' => 'numeric|nullable',
                'established' => 'numeric|nullable',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'country' => 'required'
            ]
        );
        $field = Provider::find($request['id']);
        $field->name = $request['name'];
        $field->gender = $request['gender'];
        $field->dob = $request['dob'];
        $field->nationality = $request['nationality'];
        $field->c_code = $request['c_code'];
        $field->mobile = $request['mobile'];

        $field->provider_type_id = $request['provider_type_id'];
        $field->provider_name = $request['provider_name'];
        $field->slug = slugify($request['provider_name']);

        $field->global_rank = $request['global_rank'];
        $field->acceptance_rate = $request['acceptance_rate'];
        $field->established = $request['established'];
        $field->address = $request['address'];
        $field->city = $request['city'];
        $field->state = $request['state'];
        $field->country = $request['country'];

        $field->save();
        session()->flash('smsg', 'Record has been updated successfully.');
        return redirect('provider/profile');
    }
    public function updateLogo(Request $request)
    {
        $id = session()->get('provider_id');
        $request->validate(
            [
                'logo' => 'required|max:1024|mimes:jpg,jpeg,png,gif'
            ],
            [
                'logo.max' => 'The logo must not be greater than 1 MB.'
            ]
        );
        $field = Provider::find($id);
        if ($request->hasFile('logo')) {
            $logoname = time() . '.' . $request->file('logo')->getClientOriginalExtension();
            $logopath = $request->file('logo')->move('uploads/logo/', $logoname);
            $field->logo_name = $logoname;
            $field->logo_path = 'uploads/logo/' . $logoname;
        }
        $field->save();
        session()->flash('smsg', 'Logo has been updated successfully.');
        return redirect('provider/profile');
    }
    public function viewChangePassword()
    {
        $id = session()->get('provider_id');
        $provider = Provider::find($id);
        $request = compact('provider');
        return view('front.provider.change-password')->with($request);
    }
    public function changePassword(Request $request)
    {
        $id = session()->get('provider_id');
        $provider = Provider::find($id);

        $request->validate(
            [
                'old_password' => 'required|in:' . $provider->password,
                'new_password' => 'required|min:8',
                'confirm_new_password' => 'required|min:8|same:new_password'
            ]
        );
        $field = Provider::find($request['id']);
        $field->password = $request['new_password'];
        $field->save();
        session()->flash('smsg', 'Password has been changed.');
        return redirect('provider/profile');
    }
}
