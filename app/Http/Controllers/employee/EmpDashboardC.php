<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmpDashboardC extends Controller
{
	public function index()
	{
		return view('employee.index');
	}
	public function profile()
	{
		$profile = User::find(session()->get('userLoggedIn')['user_id']);
		$data = compact('profile');
		return view('employee.profile')->with($data);
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
		return redirect('employee/profile');
	}
}
