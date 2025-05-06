<?php

namespace App\Http\Controllers\provider;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\ProviderType;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class ProviderLoginFc extends Controller
{
  public function login()
  {
    return view('front.provider.login');
  }
  public function signup()
  {
    $country = Country::orderBy('phonecode', 'ASC')->where('phonecode', '!=', 0)->get();
    $pt = ProviderType::all();
    $data = compact('country', 'pt');
    return view('front.provider.signup')->with($data);
  }
  public function register(Request $data)
  {
    // printArray($data->all());
    // die;
    $otp = rand(1000, 9999);
    $otp_expire_at = date("YmdHis", strtotime("+5 minutes"));
    $data->validate(
      [
        'name' => 'required|regex:/^[a-zA-Z ]*$/',
        'email' => 'required|email|unique:providers,email',
        'c_code' => 'required|numeric',
        'mobile' => 'required|numeric',
        'provider_type_id' => 'required|numeric',
        'password' => 'required',
        'password2' => 'required|same:password',
      ]
    );
    $field = new Provider;
    $field->name = $data['name'];
    $field->provider_name = $data['name'];
    $field->slug = slugify($data['name']);
    $field->email = $data['email'];
    $field->c_code = $data['c_code'];
    $field->mobile = $data['mobile'];
    $field->provider_type_id = $data['provider_type_id'];
    $field->password = $data['password'];
    $field->otp = $otp;
    $field->otp_expire_at = $otp_expire_at;
    $field->status = 0;
    $field->source = 'signup';
    $maildata = ['otp' => $otp, 'name' => $data['name']];


    $emaildata = ['name' => $data['name'], 'otp' => $otp];
    $dd = ['to' => $data['email'], 'to_name' => $data['name'], 'subject' => 'OTP'];

    $chk = Mail::send(
      'front.mailtemplate.send-otp',
      $emaildata,
      function ($message) use ($dd) {
        $message->to($dd['to'], $dd['to_name']);
        $message->subject('OTP');
        $message->priority(1);
      }
    );
    if ($chk == false) {
      $emsg = response()->Fail('Sorry! Please try again latter');
      session()->flash('emsg', $emsg);
      return redirect('provider/signup');
    } else {
      $field->save();
      session()->flash('smsg', 'An OTP has been send to your registered email address.');
      $data->session()->put('last_id', $field->id);
      return redirect('provider/confirmed-email');
    }
  }
  public function confirmedEmail()
  {

    //session()->get('last_id');
    //echo "<br>";
    //echo $otp_expire_a = date("YmdHis");
    //echo "<br>";
    //echo $otp_expire_at = date("YmdHis", strtotime("+5 minutes"));
    return view('front.provider.confirmed-email-form');
  }
  public function submitOtp(Request $data)
  {
    //printArray($data->all());
    $result = Provider::find($data['id']);
    $current_time = date("YmdHis");
    if ($result->otp == $data['otp']) {
      if ($current_time > $result->otp_expire_at) {
        $otp_expire_at = date("YmdHis", strtotime("+5 minute"));
        $new_otp = rand(1000, 9999);
        $result->otp = $new_otp;
        $result->otp_expire_at = $otp_expire_at;
        $result->save();
        session()->flash('smsg', 'OTP expired. New OTP has been send to your email id.');
        return redirect('provider/confirmed-email');
      } else {
        $result->otp = null;
        $result->otp_expire_at = null;
        $result->email_verified_at = date("Y-m-d H:i:s");
        $result->email_verified = 1;
        $result->status = 1;
        $result->save();
        session()->flash('smsg', 'Email verified. Succesfully logged in.');
        $data->session()->put('provider_id', $data->session()->get('last_id'));
        return redirect('provider/profile');
      }
    } else {
      session()->flash('emsg', 'Enter incorrect OTP');
      return redirect('provider/confirmed-email');
    }
  }
  public function signin(Request $data)
  {
    //printArray($data->all());
    //die;
    $field = Provider::whereEmail($data['email'])->first();
    if (is_null($field)) {
      session()->flash('emsg', 'Email address not exist.');
      return redirect('provider/login');
    } else {
      if ($field->password == $data['password']) {
        $lc = $field->login_count == '' ? 0 : $field->login_count + 1;
        $field->login_count = $lc;
        $field->last_login = date("Y-m-d H:i:s");
        $field->save();
        session()->flash('smsg', 'Succesfully logged in');
        $data->session()->put('provider_id', $field->id);
        return redirect('provider/profile');
      } else {
        session()->flash('emsg', 'Incorrect password entered');
        return redirect('provider/login');
      }
    }
  }
  public function sendMail()
  {
    $emaildata = ['name' => 'Mohd Faraz', 'otp' => '1278'];
    $dd = ['to' => 'farazahmad280@gmail.com', 'subject' => 'OTP'];
    Mail::send('front.mailtemplate.send-otp', $emaildata, function ($message) use ($dd) {
      $message->to($dd['to']);
      $message->from('info@mudraeducation.org', 'Gyandeep NGO');
      $message->subject($dd['subject']);
    });
  }
  public function viewForgetPassword()
  {
    return view('front.provider.forget-password');
  }
  public function forgetPassword(Request $data)
  {
    // printArray($data->all());
    // die;
    $remember_token = Str::random(45);
    $otp_expire_at = date("YmdHis", strtotime("+10 minutes"));
    $field = Provider::whereEmail($data['email'])->first();
    if (is_null($field)) {
      session()->flash('emsg', 'Entered wrong email address. Please check.');
      return redirect('provider/forget-password');
    } else {
      $login_link = url('provider/email-login/?uid=' . $field->id . '&token=' . $remember_token);

      $reset_password_link = url('provider/profile/password/reset/?uid=' . $field->id . '&token=' . $remember_token);

      $emaildata = ['name' => $field->name, 'id' => $field->id, 'remember_token' => $remember_token, 'login_link' => $login_link, 'reset_password_link' => $reset_password_link];

      $dd = ['to' => $data['email'], 'to_name' => $field->name, 'subject' => 'Password Reset'];

      $chk = Mail::send(
        'front.mailtemplate.forget-password-link',
        $emaildata,
        function ($message) use ($dd) {
          $message->to($dd['to'], $dd['to_name']);
          $message->subject($dd['subject']);
          $message->priority(1);
        }
      );
      if ($chk == false) {
        $emsg = response()->Fail('Sorry! Please try again latter');
        session()->flash('emsg', $emsg);
        return redirect('provider/forget-password');
      } else {
        $field->remember_token = $remember_token;
        $field->otp_expire_at = $otp_expire_at;
        $field->save();
        $data->session()->put('forget_password_email', $data['email']);
        return redirect('provider/forget-password/email-sent');
      }
    }
  }

  public function emailSent()
  {
    // session()->get('forget_password_email');
    // echo "<br>";
    // echo $otp_expire_a = date("YmdHis");
    // echo "<br>";
    // echo $otp_expire_at = date("YmdHis", strtotime("+10 minutes"));
    return view('front.provider.email-sent');
  }

  public function emailLogin(Request $request)
  {
    //printArray($request->all());
    //die;
    $id = $request['uid'];
    $remember_token = $request['token'];
    $where = ['id' => $id, 'remember_token' => $remember_token];
    $field = Provider::where($where)->first();
    $current_time = date("YmdHis");
    //printArray($field->all());
    if (is_null($field)) {
      return redirect('provider/account/invalid_link');
    } else {
      if ($current_time > $field->otp_expire_at) {
        return redirect('provider/account/invalid_link');
      } else {
        $lc = $field->login_count == '' ? 0 : $field->login_count + 1;
        $field->login_count = $lc;
        $field->last_login = date("Y-m-d H:i:s");
        $field->remember_token = null;
        $field->otp_expire_at = null;
        $field->save();
        session()->flash('smsg', 'Succesfully logged in');
        $request->session()->put('provider_id', $field->id);
        return redirect('provider/profile');
      }
    }
  }

  public function invalidLink()
  {
    return view('front.provider.invalid-link');
  }
  public function viewResetPassword(Request $request)
  {
    //printArray($request->all());
    //die;
    $id = $request['uid'];
    $remember_token = $request['token'];
    $where = ['id' => $id, 'remember_token' => $remember_token];
    $field = Provider::where($where)->first();
    $current_time = date("YmdHis");
    //printArray($field->all());
    if (is_null($field)) {
      return redirect('provider/account/invalid_link');
    } else {
      return view('front.provider.reset-password');
    }
  }
  public function resetPassword(Request $request)
  {
    //printArray($request->all());
    //die;
    $request->validate(
      [
        'new_password' => 'required|min:8',
        'confirm_new_password' => 'required|min:8|same:new_password'
      ]
    );
    $id = $request['id'];
    $remember_token = $request['remember_token'];
    $where = ['id' => $id, 'remember_token' => $remember_token];
    $field = Provider::where($where)->first();
    $current_time = date("YmdHis");
    //printArray($field->all());
    if (is_null($field)) {
      return redirect('provider/account/invalid_link');
    } else {
      if ($current_time > $field->otp_expire_at) {
        return redirect('provider/account/invalid_link');
      } else {
        $lc = $field->login_count == '' ? 0 : $field->login_count + 1;
        $field->login_count = $lc;
        $field->last_login = date("Y-m-d H:i:s");
        $field->remember_token = null;
        $field->otp_expire_at = null;
        $field->password = $request['new_password'];
        $field->save();
        session()->flash('smsg', 'Succesfully logged in');
        $request->session()->put('provider_id', $field->id);
        return redirect('provider/profile');
      }
    }
  }
}
