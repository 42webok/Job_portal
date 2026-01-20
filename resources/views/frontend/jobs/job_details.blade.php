@extends('frontend.layouts.app')

@section('main')

 <section class="section-4 bg-2">    
    <div class="container pt-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('jobs.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Back to Jobs</a></li>
                    </ol>
                </nav>
            </div>
        </div> 
    </div>
    <div class="container job_details_area">
        <div class="row pb-5">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                
                                <div class="jobs_conetent">
                                    <a href="#">
                                        <h4>{{ $job->title }}</h4>
                                    </a>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p> <i class="fa fa-map-marker"></i> {{ $job->location ?? 'N/A' }}</p>
                                        </div>
                                        <div class="location">
                                            <p> <i class="fa fa-clock-o"></i> {{ $job->jobType->name ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now">
                                    <a class="heart_mark" href="#"> <i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>Job description</h4>
                            <p>{!! nl2br($job->description) !!}</p>
                        </div>
                        <div class="single_wrap">
                           @if($job->responsibilities)
                            <h4>Responsibilities</h4>
                            <p>{!! nl2br($job->responsibilities) !!}</p>
                           @endif
                           
                        </div>
                        <div class="single_wrap">
                            @if($job->qualifications)
                            <h4>Qualifications</h4>
                            <p>{!! nl2br($job->qualifications) !!}</p>
                           @endif
                        </div>
                        <div class="single_wrap">
                           @if($job->benefits)
                            <h4>Benefits</h4>
                            <p>{!! nl2br($job->benefits) !!}</p>
                           @endif
                        </div>
                        <div class="border-bottom"></div>
                        <div class="pt-3 text-end">
                            <a href="#" class="btn btn-secondary">Save</a>
                            <a href="javascript:void(0);" onclick='applyForJob({{ $job->id }})' class="btn btn-primary">Apply</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow border-0">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Job Summery</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Published on: <span>{{ $job->created_at->format('d M, Y') }}</span></li>
                                <li>Vacancy: <span>{{ $job->vacancy ?? 'N/A' }}</span></li>
                                <li>
                                    @if($job->salary)
                                    Salary: <span>{{ $job->salary}}</span>
                                    @endif
                                <li>
                                <li>Location: <span>{{ $job->location ?? 'N/A' }}</span></li>
                                <li>Job Nature: <span>{{ $job->jobType->name ?? 'N/A' }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card shadow border-0 my-4">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Company Details</h3>
                        </div>
                        <div class="job_content pt-3">
                            @if(!empty($job->company_name) && !empty($job->company_location) && !empty($job->company_website))
                                <ul>
                                    <li>
                                       @if($job->company_name)
                                        Company Name: <span>{{ $job->company_name }}</span>
                                       @endif
                                    </li>
                                    <li>
                                        @if($job->company_location)
                                        Location: <span>{{ $job->company_location }}</span>
                                       @endif
                                    </li>
                                    <li>
                                        @if($job->company_website)
                                       <span><a href="{{ $job->company_website }}" class="btn btn-primary btn-sm">Visit Website</a></span>
                                       @endif
                                    </li>
                                </ul>
                            @else
                                <p>No Company Details Available.</p>
                            @endif
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
    function applyForJob(jobId) {
        // Implement the job application logic herr
        $.ajax({
            url: '{{ route("apply_job") }}',
            type: 'POST',
            data: {
                job_id: jobId
            },
            success: function(response) {
                console.log(response);
                
               if(response.message){
                   Swal.fire({
                       title: 'Success!',
                       text: response.message,
                       icon: 'success',
                       showConfirmButton: false,
                       timer: 3000
                   });
               }
               if(response.error){
                   Swal.fire({
                       title: 'Error!',
                       text: response.error,
                       icon: 'error',
                       showConfirmButton: false,
                       timer: 3000
                   });
               }
            },
            error: function(xhr , status, error) {
                if (xhr.status === 403) {
                   Swal.fire({
                       title: 'Error!',
                       text: xhr.responseJSON.error,
                       icon: 'error',
                       showConfirmButton: false,
                       timer: 3000
                   });
                } else {
                     Swal.fire({
                       title: 'Error!',
                       text: xhr.responseJSON.error,
                       icon: 'error',
                       showConfirmButton: false,
                       timer: 3000
                   });
                }
            }
        });
    }
</script>

@endpush
