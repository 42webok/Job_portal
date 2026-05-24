<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CategoriesModel;
use App\Models\JobTypeModel;
use App\Models\JobModel;

class JobController extends Controller
{
    //
        public function create()
    {
        $users = User::orderBy('name','ASC')->get();
        $categories = CategoriesModel::orderBy('name','ASC')->get();
        $job_types = JobTypeModel::orderBy('name','ASC')->get();

        return view('admin.jobs.create', compact(
            'users',
            'categories',
            'job_types'
        ));
    }

        public function save(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            'category_id' => 'required',
            'job_type_id' => 'required',
            'description' => 'required',
            'keywords' => 'required',
        ]);

        JobModel::create([
            'user_id'           => $request->user_id,
            'title'             => $request->title,
            'category_id'       => $request->category_id,
            'job_type_id'       => $request->job_type_id,
            'vacancy'           => $request->vacancy,
            'salary'            => $request->salary,
            'location'          => $request->location,
            'description'       => $request->description,
            'benefits'          => $request->benefits,
            'responsibility'    => $request->responsibility,
            'qualifications'    => $request->qualifications,
            'keywords'          => $request->keywords,
            'company_name'      => $request->company_name,
            'company_location'  => $request->company_location,
            'company_website'   => $request->company_website,
            'experience'        => $request->experience,
            'is_featured'       => $request->is_featured ?? 0,
            'status'            => $request->status ?? 1,
        ]);

        return redirect()->route('admin.jobs.index')
                        ->with('success','Job Created Successfully');
    }

        public function upload_summernote_image(Request $request)
    {
        if ($request->hasFile('file')) {

            $image = $request->file('file');

            $imageName = time().'_'.rand(1111,9999).'.'.$image->getClientOriginalExtension();

            $image->move(public_path('uploads/summernote'), $imageName);

            return response()->json([
                'location' => asset('uploads/summernote/'.$imageName)
            ]);
        }

        return response()->json([
            'error' => 'Image not uploaded'
        ], 400);
    }

        public function index()
    {
        $jobs = JobModel::with(['user','category','jobType'])
                    ->latest()
                    ->paginate(10);

        return view('admin.jobs.index', compact('jobs'));
    }

        public function edit($id)
    {
        $job_id = dcrypttId($id);

        $job = JobModel::findOrFail($job_id);

        $users = User::orderBy('name','ASC')->get();

        $categories = CategoriesModel::orderBy('name','ASC')->get();

        $job_types = JobTypeModel::orderBy('name','ASC')->get();

        return view('admin.jobs.edit', compact(
            'job',
            'users',
            'categories',
            'job_types'
        ));
    }
        public function update(Request $request, $id)
    {
        $job_id = dcrypttId($id);

        $job = JobModel::findOrFail($job_id);

        $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            'category_id' => 'required',
            'job_type_id' => 'required',
            'description' => 'required',
            'keywords' => 'required',
        ]);

        $job->update([

            'user_id'           => $request->user_id,
            'title'             => $request->title,
            'category_id'       => $request->category_id,
            'job_type_id'       => $request->job_type_id,
            'vacancy'           => $request->vacancy,
            'salary'            => $request->salary,
            'location'          => $request->location,
            'description'       => $request->description,
            'benefits'          => $request->benefits,
            'responsibility'    => $request->responsibility,
            'qualifications'    => $request->qualifications,
            'keywords'          => $request->keywords,
            'company_name'      => $request->company_name,
            'company_location'  => $request->company_location,
            'company_website'   => $request->company_website,
            'experience'        => $request->experience,
            'is_featured'       => $request->is_featured,
            'status'            => $request->status,

        ]);

        return redirect()->route('jobs.index')
                        ->with('success', 'Job Updated Successfully');
    }

        public function delete($id)
    {
        $job_id = dcrypttId($id);

        $job = JobModel::findOrFail($job_id);

        $job->delete();

        return redirect()->route('jobs.index')
                        ->with('success', 'Job Deleted Successfully');
    }
}
