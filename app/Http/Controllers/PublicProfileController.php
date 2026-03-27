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

        $candidate = User::with('skills')->where('is_public_profile' , 1)->get();
        return view('frontend.candidates.index' , compact('candidate'));
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

    public function candidateDetails($id)
        {
           if(!$id){
            abort(404);
           }
           $user = User::where(['id' => $id , 'is_public_profile' => 1])->first();
           return view('frontend.candidates.details' , compact('user'));
        }

        public function saveProfileExtra(Request $request){

            $user = User::find(Auth::id());
            $user->about = $request->about;
            $user->experience = $request->experience;
            $user->experience_details = $request->experience_details;
            $user->field_of_study = $request->field_of_study;
            $user->availability = $request->availability;
            $user->github = $request->github;
            $user->linkedin = $request->linkedin;
            $user->portfolio_website = $request->portfolio_website;
            $user->save();

             return redirect()->back()->with('success','Profile Updated Successfully');

        }

        public function uploadResume(Request $request)
            {
                $request->validate([
                    'resume' => 'required|mimes:pdf|max:2048'
                ]);

                $user = Auth::user();

                if($request->hasFile('resume'))
                {
                    $file = $request->file('resume');

                    $filename = time().'_'.$file->getClientOriginalName();

                    $file->move(public_path('resumes'),$filename);

                    User::where('id',$user->id)->update([
                        'resume' => $filename
                    ]);
                }

                return redirect()->back()->with('success','Resume uploaded successfully');
            }



}
