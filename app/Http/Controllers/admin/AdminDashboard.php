<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminDashboard extends Controller
{
  public function index()
  {
    return view('backend.index');
  }
  public function profile()
  {
    $profile = User::find(session()->get('adminLoggedIn')['user_id']);
    $data = compact('profile');
    return view('backend.profile')->with($data);
  }
  public function updateProfile(Request $data)
  {
    $data->validate(
      [
        'name' => 'required|regex:/^[a-zA-Z ]*$/',
        'email' => 'required|email|unique:users,email,' . $data['id'],
        'username' => 'required|unique:users,username,' . $data['id'],
        'password' => 'required',
      ]
    );
    $field = User::find($data['id']);
    $field->name = $data['name'];
    $field->email = $data['email'];
    $field->username = $data['username'];
    $field->password = $data['password'];
    $field->save();
    session()->flash('smsg', 'Record has been updated successfully.');
    return redirect('admin/profile');
  }
  // function generateBarcodeNumber()
  // {
  //     $number = mt_rand(1000000000, 9999999999); // better than rand()

  //     // call the same function if the barcode exists already
  //     if ($this->barcodeNumberExists($number)) {
  //         return $this->generateBarcodeNumber();
  //     }

  //     // otherwise, it's valid and can be used
  //     return $number;
  // }

  // function barcodeNumberExists($number)
  // {
  //     // query the database and return a boolean
  //     // for instance, it might look like this in Laravel
  //     return User::whereBarcodeNumber($number)->exists();
  // }
}
