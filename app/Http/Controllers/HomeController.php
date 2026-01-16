<?php

namespace App\Http\Controllers;
use App\Models\JobModel;
use App\Models\CategoriesModel;
use App\Models\JobTypeModel;


use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index(){
   //  $categories = CategoriesModel::where('status', 1)->withCount([
   //       'job_details' => function ($query) {
   //             $query->where('status', 1);
   //       }
   //  ])->get();

    $categories = CategoriesModel::where('status', 1)
    ->withCount([
        'job_details' => function ($query) {
            $query->where('status', 1);
        }
    ])
    ->get();
    $featuredJobs = JobModel::where('is_featured', 1)->where('status', 1)->with('category', 'jobType')->latest()->take(6)->get();
    $latestJobs = JobModel::where('status', 1)->with('category', 'jobType')->latest()->take(6)->get();
    return view('frontend.index', compact('categories', 'featuredJobs', 'latestJobs'));
   }




}
