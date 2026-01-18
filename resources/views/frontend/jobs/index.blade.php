@extends('frontend.layouts.app')

@section('main')

 
<section class="section-3 py-5 bg-2 ">
    <div class="container">     
        <div class="row">
            <div class="col-6 col-md-10 ">
                <h2>Find Jobs</h2>  
            </div>
            <div class="col-6 col-md-2">
                <div class="align-end">
                    <select name="sort" id="sort" class="form-control">
                        <option @if (request()->sort == 'latest') selected @endif value="latest">Latest</option>
                        <option @if (request()->sort == 'oldest') selected @endif value="oldest">Oldest</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row pt-5">
            <div class="col-md-4 col-lg-3 sidebar mb-4">
               <form  id="filterForm">
                 <div class="card border-0 shadow p-4">
                    <div class="mb-4">
                        <h2>Keywords</h2>
                        <input value="{{ request()->keyword }}" name='keywords' type="text" placeholder="Keywords" class="form-control">
                    </div>

                    <div class="mb-4">
                        <h2>Location</h2>
                        <input value="{{ request()->location }}" name='location' type="text" placeholder="Location" class="form-control">
                    </div>

                    <div class="mb-4">
                        <h2>Category</h2>
                        <select name="category" id="category" class="form-control">
                            <option value="">Select a Category</option>
                            @forelse($categories as $category)
                                <option @if(request()->category == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                            @empty
                                <option value="">No Category Found</option>
                            @endforelse
                        </select>
                    </div>                   

                    <div class="mb-4">
                        <h2>Job Type</h2>
                       @forelse($jobTypes as $jobType)
                        <div class="form-check">
                            <input @if (in_array($jobType->id, $job_types)) checked
                            @endif class="form-check-input" name="job_types" type="checkbox" value="{{ $jobType->id }}" id="jobType{{ $jobType->id }}">
                            <label class="form-check-label" for="jobType{{ $jobType->id }}">
                                {{ $jobType->name }}
                            </label>
                        </div>
                       @empty
                           <p>No Job Types Found</p>
                       @endforelse
                    </div>

                    <div class="mb-4">
                        <h2>Experience</h2>
                        <select name="experience" id="experience" class="form-control">
                            <option value="">Select Experience</option>
                            <option value="1" @if(request()->experience == 1) selected @endif>1 Year</option>
                            <option value="2" @if(request()->experience == 2) selected @endif>2 Years</option>
                            <option value="3" @if(request()->experience == 3) selected @endif>3 Years</option>
                            <option value="4" @if(request()->experience == 4) selected @endif>4 Years</option>
                            <option value="5" @if(request()->experience == 5) selected @endif>5 Years</option>
                            <option value="6" @if(request()->experience == 6) selected @endif>6 Years</option>
                            <option value="7" @if(request()->experience == 7) selected @endif>7 Years</option>
                            <option value="8" @if(request()->experience == 8) selected @endif>8 Years</option>
                            <option value="9" @if(request()->experience == 9) selected @endif>9 Years</option>
                            <option value="10" @if(request()->experience == 10) selected @endif>10 Years</option>
                            <option value="10_plus" @if(request()->experience == '10_plus') selected @endif>10+ Years</option>
                        </select>
                    </div>                    
                    <button type="submit" class="btn btn-primary mt-2 w-100">Search</button>
                    <a href="{{ route('jobs.index') }}" class="btn btn-primary mt-2">Reset</a>
                </div>
               </form>
            </div>
            <div class="col-md-8 col-lg-9 ">
                <div class="job_listing_area">                    
                    <div class="job_lists">
                    <div class="row">
                       @forelse($jobs as $job)
                         <div class="col-md-4">
                                    <div class="card border-0 p-3 shadow mb-4">
                                        <div class="card-body">
                                            <h3 class="border-0 fs-5 pb-2 mb-0">{{ $job->title }}</h3>
                                            <p>{{ Str::limit($job->description, 50) }}</p>
                                            <div class="bg-light p-3 border">
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                    <span class="ps-1">{{ $job->location }}</span>
                                                </p>
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                    <span class="ps-1">{{ $job->jobType->name }}</span>
                                                </p>
                                                @if($job->salary)
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                        <span class="ps-1">{{ $job->salary }}</span>
                                                    </p>
                                                @endif
                                            </div>

                                            <div class="d-grid mt-3">
                                                <a href="job-detail.html" class="btn btn-primary btn-lg">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                    @empty
                        <div class="col-md-12 mb-4">
                            <div class="job_card p-4 border shadow-sm">
                                <p>No Jobs Found</p>
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center">
                            {{ $jobs->links() }}
                        </div>
                    </div>
                </div>
            </div>
</section>

@endsection

@push('scripts')

<script>
    $(document).ready(function(){
        $('#filterForm').on('submit', function(e){
            e.preventDefault();
            var keyword = $('input[name="keywords"]').val();
            var location = $('input[name="location"]').val();
            var category = $('#category').val();
            var experience = $('#experience').val();
            var sort = $('#sort').val();

            var jobTypes = [];
            $('input[name="job_types"]:checked').each(function(){
                jobTypes.push($(this).val());
            });
            console.log(jobTypes);
            
            var queryParams = {};

            if(keyword){
                queryParams.keyword = keyword;
            }
            if(location){
                queryParams.location = location;
            }
            if(category){
                queryParams.category = category;
            }
            if(experience){
                queryParams.experience = experience;
            }
            if(jobTypes.length > 0){
                queryParams.job_types = jobTypes.join(',');
                console.log(queryParams.job_types);
            }
            if(sort){
                queryParams.sort = sort;
            }

            var queryString = $.param(queryParams);

            window.location.href = "{{ route('jobs.index') }}" + '?' + queryString;
        })

       
    })

     $(document).on('change', 'select[name="sort"]', function(){
            $('#filterForm').submit();
        });

</script>



@endpush
