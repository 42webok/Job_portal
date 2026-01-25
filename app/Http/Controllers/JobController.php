<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobModel;
use App\Models\SavedJobs;
use App\Models\User;
use App\Models\JobTypeModel;
use App\Models\JobApplication;
use App\Models\CategoriesModel;
use App\Mail\JobNotificationMail;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{

    public function index(Request $request)
    {
        $jobs = JobModel::with('jobType', 'category')->where('status', 1);
        
        //  Filter by title and keywords
        if($request->keyword != ''){
            $jobs = $jobs->where(function($query) use ($request){
                $query->where('title', 'like', '%' . $request->keyword . '%')
                      ->orWhere('keywords', 'like', '%' . $request->keyword . '%');
            });
        }

        // Filter by location
        if($request->location != ''){
            $jobs = $jobs->where('location', 'like', '%' . $request->location . '%');
        }

        // Filter by category
        if($request->category && $request->category != ''){
            $jobs = $jobs->where('category_id', $request->category);
        }

        // Filter by experience
        if($request->experience != ''){
            $jobs = $jobs->where('experience', $request->experience);
        }

        // Filter by job type
        $job_types = [];
        if($request->job_types && $request->job_types != ''){
            $job_types = explode(',', $request->job_types);
            $jobs = $jobs->whereIn('job_type_id', $job_types);
        }

        // Filter by order 
        if($request->sort && $request->sort != ''){
            if($request->sort == 'oldest'){
                $jobs = $jobs->orderBy('created_at', 'asc');
            }
            else{
                $jobs = $jobs->orderBy('created_at', 'desc');
            }
        }


        $jobs = $jobs->paginate(6)->withQueryString();




        $jobTypes = JobTypeModel::where('status', 1)->get();
        $categories = CategoriesModel::where('status', 1)->get();
        return view('frontend.jobs.index', compact('jobs', 'jobTypes', 'categories' , 'job_types'));
    }

    // Job Details
    public function jobDetails($id){
        $job = JobModel::with('jobType', 'category')->where('id', $id)->first();
        if(!$job){
            abort(404);
        }
       $get_applied_job = SavedJobs::where('job_id', $job->id)
        ->where('user_id', auth()->id())
        ->exists();

        return view('frontend.jobs.job_details', compact('job' , 'get_applied_job'));
    }

    // Apply for Job
    public function applyForJob(Request $request){
        if(!auth()->check()){
            return response()->json(['error' => 'You must be logged in to apply for a job.'], 401);
        }

        $job = JobModel::where('id', $request->job_id)->first();
        if(!$job){
            return response()->json(['error' => 'Job not found.'], 404);
        }
        if($job->user_id == auth()->id()){
            return response()->json(['error' => 'You cannot apply for your own job.'], 403);
        }

        // not apply on same job again
        $existingApplication = JobApplication::where('job_id', $request->job_id)
            ->where('applicant_id', auth()->id())
            ->first();
        if($existingApplication){
            return response()->json(['error' => 'You have already applied for this job.'], 409);
        }

        $application = new JobApplication();
        $application->job_id = $request->job_id;
        $application->applicant_id = auth()->id();
        $application->job_owner_id = $job->user_id;
        $application->applied_at = now();
        $application->save();

        $owner_data = User::where('id', $job->user_id)->first();


        // send mail work to job owner about new application
        $mail_data = [
            'owner_name' => $owner_data->name,
            'job_title' => $job->title,
            'applicant_name' => auth()->user()->name,
            'applicant_email' => auth()->user()->email,
            'applicant_phone' => auth()->user()->phone,
        ];
        Mail::to($owner_data->email)->send(new JobNotificationMail($mail_data));


        return response()->json(['message' => 'Application submitted successfully.']);
    }


    // save  Job
    public function saveJobs(Request $request){
        if(!auth()->check()){
            return response()->json(['error' => 'You must be logged in to save for a job.'], 401);
        }

        $job = JobModel::where('id', $request->job_id)->first();
        if(!$job){
            return response()->json(['error' => 'Job not found.'], 404);
        }
        if($job->user_id == auth()->id()){
            return response()->json(['error' => 'You cannot save for your own job.'], 403);
        }

        // not apply on same job again
        $existingApplication = SavedJobs::where('job_id', $request->job_id)
            ->where('user_id', auth()->id())
            ->first();
        if($existingApplication){
            return response()->json(['error' => 'You have already saved this job.'], 409);
        }

        $application = new SavedJobs();
        $application->job_id = $request->job_id;
        $application->user_id = auth()->id();
        $application->created_at = now();
        $application->save();

        // $owner_data = User::where('id', $job->user_id)->first();


        // send mail work to job owner about new application
        // $mail_data = [
        //     'owner_name' => $owner_data->name,
        //     'job_title' => $job->title,
        //     'applicant_name' => auth()->user()->name,
        //     'applicant_email' => auth()->user()->email,
        //     'applicant_phone' => auth()->user()->phone,
        // ];
        // Mail::to($owner_data->email)->send(new JobNotificationMail($mail_data));


        return response()->json(['message' => 'Job saved successfully.']);
    }

}
