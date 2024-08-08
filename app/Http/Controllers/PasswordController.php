<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile.password');
    }

    public function update(Request $request)
    {
        $rules = [
            'old_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }else{
            $old_password = $request->get("old_password");
            $password = $request->get("password");
            $user = Auth::User();
            if (!Hash::check($old_password, $user->password)) { 
                return back()->withErrors(['old_password' => ['Kata sandi lama anda tidak cocok']]);
            }else{
                $user->fill(['password' => Hash::make($password)])->save();
                return redirect()->back()->with('success', 'Kata sandi anda berhasil dirubah !!');
            }
        }

    }

}