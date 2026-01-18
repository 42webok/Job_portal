<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobModel;
use App\Models\JobTypeModel;
use App\Models\CategoriesModel;

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
}
