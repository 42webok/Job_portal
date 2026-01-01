<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(){
        return view("frontend.auth.register");
    }

    public function registerSave(Request $request){
        // Validate and create the user
        $validate = $request->validate([
            "name"=> "required|string|max:255",
            "email"=> "required|email|unique:users,email",
            "password"=> "required|string|min:6|confirmed",
            "password_confirmation"=> "required|string|min:6|same:password",
        ]);
        if($validate){
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('login')->with('success', 'Registration successful. Please login.');
        }else{
            return redirect()->back()->with('error', 'Registration failed. Please try again.');
        }

    }

    public function login(){
        return view("frontend.auth.login");
    }

    public function loginCheck(Request $request){
        $validater = $request->validate([
            "email"=> "required|email",
            "password"=> "required|string",
        ]);
        if($validater){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
               return redirect()->intended('profile')->with('success', 'Login successful.');
           }else{
                return redirect()->back()->with('error', 'Login failed. Please check your credentials and try again.');
           }
        }else{
            return redirect()->back()->with('error', 'Login failed. Please check your credentials and try again.');
        }

    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }

}
