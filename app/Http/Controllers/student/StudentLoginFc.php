<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StudentLoginFc extends Controller
{
  public function login()
  {
    return view('front.student.login');
  }
  public function signup()
  {
    return view('front.student.signup');
  }
  public function register(Request $data)
  {
    // printArray($data->all());
    // die;
    $otp = rand(1000, 9999);
    $otp_expire_at = date("YmdHis", strtotime("+15 minutes"));
    $data->validate(
      [
        'name' => 'required|regex:/^[a-zA-Z ]*$/',
        'email' => 'required|email|unique:students,email',
        'c_code' => 'required|numeric',
        'mobile' => 'required|numeric',
        'password' => 'required',
        'password2' => 'required|same:password',
        'current_qualification_level' => 'required',
        'intrested_course_category' => 'required'
      ]
    );
    $field = new Student;
    $field->name = $data['name'];
    $field->email = $data['email'];
    $field->current_qualification_level = $data['current_qualification_level'];
    $field->intrested_course_category = $data['intrested_course_category'];
    $field->c_code = $data['c_code'];
    $field->mobile = $data['mobile'];
    $field->password = $data['password'];
    $field->otp = $otp;
    $field->otp_expire_at = $otp_expire_at;
    $field->status = 0;

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
      return redirect('signup');
    } else {
      $field->save();
      session()->flash('smsg', 'An OTP has been send to your registered email address.');
      $data->session()->put('last_id', $field->id);
      return redirect('confirmed-email');
    }
  }
  public function confirmedEmail()
  {

    //session()->get('last_id');
    //echo "<br>";
    //echo $otp_expire_a = date("YmdHis");
    //echo "<br>";
    //echo $otp_expire_at = date("YmdHis", strtotime("+15 minutes"));
    return view('front.student.confirmed-email-form');
  }
  public function submitOtp(Request $data)
  {
    // printArray($data->all());
    // die;
    $result = Student::find($data['id']);
    $current_time = date("YmdHis");
    if ($result->otp == $data['otp']) {
      if ($current_time > $result->otp_expire_at) {
        $otp_expire_at = date("YmdHis", strtotime("+15 minute"));
        $new_otp = rand(1000, 9999);
        $result->otp = $new_otp;
        $result->otp_expire_at = $otp_expire_at;
        $result->save();
        session()->flash('smsg', 'OTP expired. New OTP has been send to your email id.');
        return redirect('confirmed-email');
      } else {
        $result->otp = null;
        $result->otp_expire_at = null;
        $result->email_verified_at = date("Y-m-d H:i:s");
        $result->email_verified = 1;
        $result->status = 1;
        $result->lead_type = 'new';
        $result->source = 'signup';
        $result->save();
        session()->flash('smsg', 'Email verified. Succesfully logged in.');
        $data->session()->put('student_id', $data->session()->get('last_id'));
        return redirect('profile');
      }
    } else {
      session()->flash('emsg', 'Enter incorrect OTP');
      return redirect('confirmed-email');
    }
  }
  public function signin(Request $data)
  {
    //printArray($data->all());
    //die;
    $field = Student::whereEmail($data['email'])->first();
    if (is_null($field)) {
      session()->flash('emsg', 'Email address not exist.');
      if ($data['back_to'] == 'profile') {
        return redirect('login');
      } else {
        return redirect('login?url=' . $data['back_to']);
      }
    } else {
      if ($field->status == 1) {
        if ($field->password == $data['password']) {
          $lc = $field->login_count == '' ? 0 : $field->login_count + 1;
          $field->login_count = $lc;
          $field->last_login = date("Y-m-d H:i:s");
          $field->save();
          session()->flash('smsg', 'Succesfully logged in');
          $data->session()->put('student_id', $field->id);
          $data->session()->put('student_name', $field->name);
          if ($data['back_to'] == 'profile') {
            return redirect('profile');
          } else {
            return redirect($data['back_to']);
          }
        } else {
          session()->flash('emsg', 'Incorrect password entered');
          if ($data['back_to'] == 'profile') {
            return redirect('login');
          } else {
            return redirect('login?url=' . $data['back_to']);
          }
        }
      } else {
        $otp = rand(1000, 9999);
        $otp_expire_at = date("YmdHis", strtotime("+15 minutes"));

        $emaildata = ['name' => $field->name, 'otp' => $otp];
        $dd = ['to' => $field->email, 'to_name' => $field->name, 'subject' => 'Email OTP'];

        $result = Mail::send(
          'front.mailtemplate.send-otp',
          $emaildata,
          function ($message) use ($dd) {
            $message->to($dd['to'], $dd['to_name']);
            $message->subject($dd['subject']);
            $message->priority(1);
          }
        );
        if ($result == false) {
          $emsg = response()->Fail('Sorry! Please try again latter');
          session()->flash('emsg', $emsg);
          return redirect('signup');
        } else {
          $field->otp = $otp;
          $field->otp_expire_at = $otp_expire_at;
          $field->save();
          session()->flash('smsg', 'An OTP has been send to your registered email address.');
          $data->session()->put('last_id', $field->id);
          return redirect('confirmed-email');
        }
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
    return view('front.student.forget-password');
  }
  public function forgetPassword(Request $data)
  {
    // printArray($data->all());
    // die;
    $remember_token = Str::random(45);
    $otp_expire_at = date("YmdHis", strtotime("+10 minutes"));
    $field = Student::whereEmail($data['email'])->first();
    if (is_null($field)) {
      session()->flash('emsg', 'Entered wrong email address. Please check.');
      return redirect('forget-password');
    } else {
      $login_link = url('email-login/?uid=' . $field->id . '&token=' . $remember_token);

      $reset_password_link = url('profile/password/reset/?uid=' . $field->id . '&token=' . $remember_token);

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
        return redirect('forget-password');
      } else {
        $field->remember_token = $remember_token;
        $field->otp_expire_at = $otp_expire_at;
        $field->save();
        $data->session()->put('forget_password_email', $data['email']);
        return redirect('forget-password/email-sent');
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
    return view('front.student.email-sent');
  }

  public function emailLogin(Request $request)
  {
    //printArray($request->all());
    //die;
    $id = $request['uid'];
    $remember_token = $request['token'];
    $where = ['id' => $id, 'remember_token' => $remember_token];
    $field = Student::where($where)->first();
    $current_time = date("YmdHis");
    //printArray($field->all());
    if (is_null($field)) {
      return redirect('account/invalid_link');
    } else {
      if ($current_time > $field->otp_expire_at) {
        return redirect('account/invalid_link');
      } else {
        $lc = $field->login_count == '' ? 0 : $field->login_count + 1;
        $field->login_count = $lc;
        $field->last_login = date("Y-m-d H:i:s");
        $field->remember_token = null;
        $field->otp_expire_at = null;
        $field->save();
        session()->flash('smsg', 'Succesfully logged in');
        $request->session()->put('student_id', $field->id);
        return redirect('profile');
      }
    }
  }

  public function invalidLink()
  {
    return view('front.student.invalid-link');
  }
  public function viewResetPassword(Request $request)
  {
    //printArray($request->all());
    //die;
    $id = $request['uid'];
    $remember_token = $request['token'];
    $where = ['id' => $id, 'remember_token' => $remember_token];
    $field = Student::where($where)->first();
    $current_time = date("YmdHis");
    //printArray($field->all());
    if (is_null($field)) {
      return redirect('account/invalid_link');
    } else {
      return view('front.student.reset-password');
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
    $field = Student::where($where)->first();
    $current_time = date("YmdHis");
    //printArray($field->all());
    if (is_null($field)) {
      return redirect('account/invalid_link');
    } else {
      if ($current_time > $field->otp_expire_at) {
        return redirect('account/invalid_link');
      } else {
        $lc = $field->login_count == '' ? 0 : $field->login_count + 1;
        $field->login_count = $lc;
        $field->last_login = date("Y-m-d H:i:s");
        $field->remember_token = null;
        $field->otp_expire_at = null;
        $field->password = $request['new_password'];
        $field->save();
        session()->flash('smsg', 'Succesfully logged in');
        $request->session()->put('student_id', $field->id);
        return redirect('profile');
      }
    }
  }
}
