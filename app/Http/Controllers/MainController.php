<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;



class MainController extends Controller
{
    //
    public function profile(){
        $user = User::where('id', Auth::id())->first();
        return view("frontend.profile.index", compact('user'));
    }

    public function profileUpdate(Request $request){
        $validate = $request->validate([
            "name"=> "required|string|max:255",
            "email"=> "required|email|unique:users,email,".Auth::id(),
            "designation"=> "nullable|string|max:255",
            "mobile"=> "nullable|string|max:15",
        ]);
        if($validate){
            $user = User::where('id', Auth::id())->first();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->designation = $request->designation;
            $user->mobile = $request->mobile;
            $user->save();
            return redirect()->back()->with('success', 'Profile updated successfully.');
        }else{
            return redirect()->back()->with('error', 'Profile update failed. Please try again.');
        }
    }

    public function updateProfilePicture(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($validator->passes()){
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/profile_images'), $imageName);

            $user = User::where('id', Auth::id())->first();

            // Delete old image file if exists - FIXED VERSION
            if ($user->image) {
                $oldImagePath = public_path('uploads/profile_images/'.$user->image);
                $is_del = File::delete($oldImagePath);
            }

            // Update the user's profile image path in the database
            $user->image = $imageName;
            $user->save();
            return redirect()->back()->with('success', 'Profile image updated successfully.');
        }else{
            return redirect()->back()->with('error', 'Profile image update failed. Please try again.');
        }

         
    }
}


