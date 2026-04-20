<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        if(session()->has('admin_id')){
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login.login');
    }

    public function loginCheck(Request $request){
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|max:50',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !password_verify($request->password, $admin->password)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->withInput();
        }

        session(['admin_id' => $admin->id]);
        return redirect()->route('admin.dashboard');
    }
}
