@extends('admin.layout.app')
@section('title', 'Admin | Manage Jobs')

@section('content')

<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">

            <div class="card">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">Manage Jobs</h4>

                        <a href="{{ route('jobs.create') }}" class="btn btn-primary">
                            Add Job
                        </a>
                    </div>

                   

                    <div class="table-responsive">

                        <table class="table">

                            <thead>
                                <tr>
                                    <th> Title </th>
                                    <th> User </th>
                                    <th> Category </th>
                                    <th> Job Type </th>
                                    <th> Salary </th>
                                    <th> Vacancy </th>
                                    <th> Featured </th>
                                    <th> Status </th>
                                    <th> Created </th>
                                    <th> Action </th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($jobs as $job)

                                    <tr>

                                        <td>
                                            {{ $job->title }}
                                        </td>

                                        <td>
                                            {{ $job->user->name ?? 'N/A' }}
                                        </td>

                                        <td>
                                            {{ $job->category->name ?? 'N/A' }}
                                        </td>

                                        <td>
                                            {{ $job->jobType->name ?? 'N/A' }}
                                        </td>

                                        <td>
                                            {{ $job->salary ?? 'N/A' }}
                                        </td>

                                        <td>
                                            {{ $job->vacancy ?? 0 }}
                                        </td>

                                        <td>
                                            <span class="badge {{ $job->is_featured == 1 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $job->is_featured == 1 ? 'Yes' : 'No' }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge {{ $job->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $job->status == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ date('d M Y', strtotime($job->created_at)) }}
                                        </td>

                                        <td>

                                            <a href="{{ route('jobs.edit', encryptId($job->id)) }}"
                                               class="btn btn-sm btn-warning">
                                                Edit
                                            </a>

                                            <a href="{{ route('jobs.delete', encryptId($job->id)) }}"
                                               class="btn btn-sm btn-danger"
                                               onclick="return confirm('Are you sure you want to delete this job?')">
                                                Delete
                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="10" class="text-center">
                                            No jobs found
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        {{ $jobs->links() }}
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection