<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobModel;
use App\Models\JobTypeModel;
use App\Models\CategoriesModel;

class JobController extends Controller
{

    public function index()
    {
        $jobs = JobModel::with('jobType', 'category')->where('status', 1)->orderBy("id","desc")->paginate(6);
        $jobTypes = JobTypeModel::where('status', 1)->get();
        $categories = CategoriesModel::where('status', 1)->get();
        return view('frontend.jobs.index', compact('jobs', 'jobTypes', 'categories'));
    }
}
