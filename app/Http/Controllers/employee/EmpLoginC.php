<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmpLoginC extends Controller
{
  public function index()
  {
    $form_submit_url = url('employee/login');
    $data = compact('form_submit_url');
    return view('employee.login')->with($data);
  }
  public function login(Request $request)
  {
    // printArray($request->all());
    // die;
    $field = User::where('role', '!=', 'Admin')->where('email', $request['username'])->orWhere('username', $request['username'])->first();
    // printArray($field->toArray());
    // die;
    if (is_null($field)) {
      session()->flash('emsg', 'Email address not exist.');
      return redirect('employee/login');
    } else {
      if ($field->password == $request['password']) {
        $lc = $field->login_count == '' ? 0 : $field->login_count + 1;
        $field->login_count = $lc;
        $field->last_login = date("Y-m-d H:i:s");
        $field->save();
        session()->flash('smsg', 'Succesfully logged in');
        $request->session()->put('userLoggedIn', ['user_id' => $field->id, 'user_name' => $field->name, 'username' => $field->username, 'role' => $field->role]);
        // echo "logged in";
        // printArray($request->session()->all());
        // echo $request->session()->get('userLoggedIn')['user_id'];

        return redirect('employee/dashboard');
      } else {
        session()->flash('emsg', 'Incorrect password entered');
        return redirect('employee/login');
      }
    }
  }
}
