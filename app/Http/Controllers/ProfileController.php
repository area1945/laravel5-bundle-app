<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::User();
        return view('profile.index')->with("user", $user);
    }

    public function update(Request $request)
    {
        $user = Auth::User();
        $user_id = $user->id;

        $rules = [
            'name' => 'required|unique:users,name,' . $user_id,
            'email' => 'required|email|unique:users,email,' . $user_id
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else
        {
            $user->name = $request->get("name");
            $user->email = $request->get("email");
            $user->save();
            return redirect()->back()->with('success', 'Profil anda berhasil dirubah !!');
        }

    }

}