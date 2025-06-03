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
    public function register(Request $request)
    {
        // printArray($request->all());
        // die;
        $otp = rand(1000, 9999);
        $otp_expire_at = date("YmdHis", strtotime("+15 minutes"));
        $request->validate(
            [
                'name' => 'required|regex:/^[a-zA-Z ]*$/',
                'email' => 'required|email|unique:students,email',
                'c_code' => 'required|numeric',
                'mobile' => 'required|numeric',
                'password' => 'required',
                'password2' => 'required|same:password',
                'current_qualification_level' => 'required',
                'neet_status' => 'required'
            ]
        );
        $field = new Student;
        $field->name = $request['name'];
        $field->email = $request['email'];
        $field->current_qualification_level = $request['current_qualification_level'];
        $field->neet_status = $request['neet_status'];
        $field->c_code = $request['c_code'];
        $field->mobile = $request['mobile'];
        $field->password = $request['password'];
        $field->otp = $otp;
        $field->otp_expire_at = $otp_expire_at;
        $field->status = 0;

        $maildata = ['otp' => $otp, 'name' => $request['name']];


        $emaildata = ['name' => $request['name'], 'otp' => $otp];
        $dd = ['to' => $request['email'], 'to_name' => $request['name'], 'subject' => 'OTP'];

        $chk = Mail::send(
            'front.mailtemplate.send-otp',
            $emaildata,
            function ($message) use ($dd) {
                $message->to($dd['to'], $dd['to_name']);
                $message->subject('OTP');
                $message->priority(1);
            }
        );
        $leadData = [
            'name' => $request['name'],
            'email' => $request['email'],
            'c_code' => $request['c_code'],
            'mobile' => $request['mobile'],
            'current_qualification_level' => $request['current_qualification_level'],
            'neet_status' => $request['neet_status'],
        ];
        $dd2 = ['to' => TO_EMAIL, 'to_name' => TO_NAME, 'cc' => CC_EMAIL, 'cc_name' => CC_NAME, 'subject' => 'New Enquiry Alert – Team Attention Needed', 'bcc' => BCC_EMAIL, 'bcc_name' => BCC_NAME];

        Mail::send(
            'mails.inquiry-mail-to-team',
            $leadData,
            function ($message) use ($dd2) {
                $message->to($dd2['to'], $dd2['to_name']);
                $message->cc($dd2['cc'], $dd2['cc_name']);
                $message->bcc($dd2['bcc'], $dd2['bcc_name']);
                $message->subject($dd2['subject']);
                $message->priority(1);
            }
        );
        if ($chk == false) {
            $emsg = response('Sorry! Please try again latter');
            session()->flash('emsg', $emsg);
            return redirect('signup');
        } else {
            $field->save();
            session()->flash('smsg', 'An OTP has been send to your registered email address.');
            $request->session()->put('last_id', $field->id);
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
    public function submitOtp(Request $request)
    {
        // printArray($request->all());
        // die;
        $result = Student::find($request['id']);
        $current_time = date("YmdHis");
        if ($result->otp == $request['otp']) {
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
                session()->flash('smsg', 'Email verified. Submit scholarship application.');
                $request->session()->put('student_id', $request->session()->get('last_id'));
                return redirect('profile');
            }
        } else {
            session()->flash('emsg', 'Enter incorrect OTP');
            return redirect('confirmed-email');
        }
    }
    public function signin(Request $request)
    {
        //printArray($request->all());
        //die;
        $field = Student::whereEmail($request['email'])->first();
        if (is_null($field)) {
            session()->flash('emsg', 'Email address not exist.');
            if ($request['back_to'] == 'profile') {
                return redirect('login');
            } else {
                return redirect('login?url=' . $request['back_to']);
            }
        } else {
            if ($field->status == 1) {
                if ($field->password == $request['password']) {
                    $lc = $field->login_count == '' ? 0 : $field->login_count + 1;
                    $field->login_count = $lc;
                    $field->last_login = date("Y-m-d H:i:s");
                    $field->save();
                    session()->flash('smsg', 'Succesfully logged in');
                    $request->session()->put('student_id', $field->id);
                    $request->session()->put('student_name', $field->name);
                    if ($request['back_to'] == 'profile') {
                        return redirect('profile');
                    } else {
                        return redirect($request['back_to']);
                    }
                } else {
                    session()->flash('emsg', 'Incorrect password entered');
                    if ($request['back_to'] == 'profile') {
                        return redirect('login');
                    } else {
                        return redirect('login?url=' . $request['back_to']);
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
                    $emsg = response('Sorry! Please try again latter');
                    session()->flash('emsg', $emsg);
                    return redirect('signup');
                } else {
                    $field->otp = $otp;
                    $field->otp_expire_at = $otp_expire_at;
                    $field->save();
                    session()->flash('smsg', 'An OTP has been send to your registered email address.');
                    $request->session()->put('last_id', $field->id);
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
    public function forgetPassword(Request $request)
    {
        // printArray($request->all());
        // die;
        $remember_token = Str::random(45);
        $otp_expire_at = date("YmdHis", strtotime("+10 minutes"));
        $field = Student::whereEmail($request['email'])->first();
        if (is_null($field)) {
            session()->flash('emsg', 'Entered wrong email address. Please check.');
            return redirect('forget-password');
        } else {
            $login_link = url('email-login/?uid=' . $field->id . '&token=' . $remember_token);

            $reset_password_link = url('profile/password/reset/?uid=' . $field->id . '&token=' . $remember_token);

            $emaildata = ['name' => $field->name, 'id' => $field->id, 'remember_token' => $remember_token, 'login_link' => $login_link, 'reset_password_link' => $reset_password_link];

            $dd = ['to' => $request['email'], 'to_name' => $field->name, 'subject' => 'Password Reset'];

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
                $emsg = response('Sorry! Please try again latter');
                session()->flash('emsg', $emsg);
                return redirect('forget-password');
            } else {
                $field->remember_token = $remember_token;
                $field->otp_expire_at = $otp_expire_at;
                $field->save();
                $request->session()->put('forget_password_email', $request['email']);
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

    public function emailLogin_X(Request $request)
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
            $lc = $field->login_count == '' ? 0 : $field->login_count + 1;
            $field->login_count = $lc;
            $field->last_login = date("Y-m-d H:i:s");
            $field->remember_token = null;
            $field->otp_expire_at = null;
            $field->save();
            session()->flash('smsg', 'You have successfully logged in.');
            $request->session()->put('student_id', $field->id);
            return redirect('profile/applied-scholarship');
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
