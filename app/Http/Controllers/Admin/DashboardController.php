<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JobModel;
use App\Models\CategoriesModel;
use App\Models\JobApplication;


class DashboardController extends Controller
{
    public function index(){
        $total_users = User::count();
        $total_jobs = JobModel::where('status', 1)->count();
        $total_categories = CategoriesModel::where('status', 1)->count();

        $chart_jobs = JobModel::selectRaw('MONTH(created_at) as month , COUNT(*) as total')
        ->groupBy('month')
        ->pluck('total', 'month');
        $chart_jobs_applications = JobApplication::selectRaw('MONTH(created_at) as month , COUNT(*) as total')
        ->groupBy('month')
        ->pluck('total', 'month');
        $chart_users = User::selectRaw('MONTH(created_at) as month , COUNT(*) as total')
        ->groupBy('month')
        ->pluck('total', 'month');

        return view('admin.dashboard', compact('total_users' , 'total_jobs' , 'total_categories', 'chart_jobs', 'chart_jobs_applications', 'chart_users'));
    }
}
