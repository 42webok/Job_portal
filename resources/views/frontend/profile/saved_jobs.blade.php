@extends('frontend.layouts.app')

@section('title','Profile')

@section('main')
    
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            @include('frontend.profile.profile_sidebar')
            <div class="col-lg-9">
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="card-body card-form">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="fs-4 mb-1">My Saved Jobs</h3>
                            </div>
                            {{-- <div style="margin-top: -10px;">
                                <a href="{{-- route('post_job') }}" class="btn btn-primary">Post a Job</a>
                            </div> --}}
                            
                        </div>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Job Created</th>
                                        <th scope="col">Applicants</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                   @forelse($savedJobs as $job)
                                    <tr class="active">
                                        <td>
                                            <div class="job-name fw-500">{{ $job->jobs->title }}</div>
                                            <div class="info1">{{ $job->jobs->jobType->name }} . {{ $job->jobs->location }}</div>
                                        </td>
                                        <td>{{ $job->created_at->format('d M, Y') }}</td>
                                        <td>{{ $job->jobs->applications->count() }} Applications</td>
                                        <td>
                                            <div class="job-status text-capitalize">
                                                @if($job->jobs->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-dots float-end">
                                                <a href="#" class="" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="{{ route('jobs.details', $job->jobs->id) }}"> <i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                    <li><a class="dropdown-item delete-btn" href="javascript:void(0);" data-id="{{ $job->id }}"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                       <td colspan="5">
                                          Saved not found !
                                       </td>
                                   </tr>
                                        
                                    
                                   @endforelse
                                   <tr>
                                       <td colspan="5">
                                           {{ $savedJobs->links() }}
                                       </td>
                                   </tr>
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        let id = this.dataset.id;

        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
               window.location.href = `/delete_saved/${id}`;
            }
        });
    });
});
</script>
@endpush