<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CategoriesModel;
use App\Models\JobModel;
use App\Models\JobTypeModel;
use App\Models\JobApplication;
use App\Models\SavedJobs;
use App\Models\Skill;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class PublicProfileController extends Controller
{
    public function isPublicProfile(Request $request){
        if (!Auth::id()) {
            abort(404);
        }
        $request->validate([
            'is_public_profile' => 'required|in:0,1'
        ]);
        $current_value = $request->is_public_profile == 1 ? 0 : 1;

        $user = User::find(Auth::id());
        $user->is_public_profile = $current_value;
        $user->save();

        return response()->json([
            'success' => true,
            'current_status' => $current_value
        ]);
    }

    // candidates code start here 

    public function candidates(){
        return view('frontend.candidates.index');
    }


    // save user skills
    public function SaveUserSkills(Request $request){
        $request->validate([
            'skills' => 'required|array|max:10', // max 10 skills
            'skills.*' => 'exists:skills,id',
        ]);

        $user = Auth::user();

        // Sync skills (will remove old ones not in array)
        $user->skills()->sync($request->skills);

        // Get updated skills for response
        $skills = $user->skills()->select('skills.id','skills.name')->get();

        return response()->json([
            'success' => true,
            'skills' => $skills
        ]);
    }
   

    public function removeUserSkill(Request $request){
        $user = Auth::user();

        $user->skills()->detach($request->skill_id);

        return response()->json([
            'success' => true
        ]);
    }

}
