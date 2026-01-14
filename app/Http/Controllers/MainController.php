<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CategoriesModel;
use App\Models\JobModel;
use App\Models\JobTypeModel;
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


    // post the job 
    public function postJob(){

        $categories = CategoriesModel::where('status', 1)->get();
        $job_types = JobTypeModel::where('status', 1)->get();
        

        return view('frontend.profile.post_job', compact('categories', 'job_types'));
    }

    public function postJobData(Request $request){
        $validate = $request->validate([
            "title"=> "required|string|max:255",
            "category"=> "required|exists:categories,id",
            "job_type"=> "required|exists:job_type,id",
            "vacancy"=> "required|integer|min:1",
            "salary"=> "nullable|string|max:255",
            "location"=> "nullable|string|max:255",
            "description"=> "required|string",
            "benefits"=> "nullable|string",
            "responsibility"=> "nullable|string",
            "qualifications"=> "nullable|string",
            "experience"=> "nullable|string",
        ]);

        if($validate){
            // Save job data to database (Assuming you have a Job model)
            $job = new JobModel();
            $job->title = $request->title;
            $job->category_id = $request->category;
            $job->job_type_id = $request->job_type;
            $job->vacancy = $request->vacancy;
            $job->salary = $request->salary;
            $job->location = $request->location;
            $job->description = $request->description;
            $job->benefits = $request->benefits;
            $job->responsibility = $request->responsibility;
            $job->qualifications = $request->qualifications;
            $job->keywords = $request->keywords;
            $job->experience = $request->experience;
            $job->company_name = $request->company_name;
            $job->company_website = $request->company_website;
            $job->company_location = $request->company_location;
            $job->status = 1; // Assuming 1 is for active/published jobs
            $job->save();

            return redirect()->back()->with('success', 'Job posted successfully.');
        }else{
            return redirect()->back()->with('error', 'Job posting failed. Please try again.');
        }
    }

//    my jobs code start here 
     public function myJobs(){
        $jobs = JobModel::with(['category', 'jobType'])->where('status' , 1)->paginate(10);
        return view('frontend.profile.my_jobs', compact('jobs'));
     }


}


