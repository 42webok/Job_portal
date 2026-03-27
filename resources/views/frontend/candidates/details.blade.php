@extends('frontend.layouts.app')

@section('main')

<section class="section-5 bg-2 py-5">
<div class="container">

    <!-- PROFILE HEADER -->
    <div class="card border-0 shadow mb-4 p-4">

        <div class="row align-items-center">

            <div class="col-md-2 text-center">
                @if($user->image)
                <img src="{{ asset('uploads/profile_images/'.$user->image) }}" class="img-fluid rounded-circle" width="100">
                @else
                 <img src="{{ asset('assets/images/avatar7.png') }}" class="img-fluid rounded-circle" width="100">
                @endif
            </div>

            <div class="col-md-7">

                <h3 class="mb-1">{{ $user->name }}</h3>
                <p class="text-muted mb-2">{{ $user->designation }}</p>

                <p class="mb-2">
                    <i class="fa fa-map-marker"></i> {{ $user->location ?? 'Pakistan' }}
                </p>

                <span class="badge bg-success">Open to Work</span>

            </div>

            <div class="col-md-3 text-end">

                <button class="btn btn-primary mb-2 w-100">Contact</button>
                @if($user->resume && $user->resume != '')
                <a href='{{ asset('resumes/'.$user->resume) }}' target='_blank' class="btn btn-outline-primary w-100">Download CV</a>
                @endif
            </div>

        </div>

    </div>


    <div class="row">

        <!-- LEFT SIDE -->
        <div class="col-md-8">

            <!-- ABOUT -->
            <div class="card border-0 shadow mb-4 p-4">
                <h4>About</h4>
                <p class="text-muted">
                @if($user->about)
                   {!! nl2br($user->about) !!}
                @else
                   No bio added yet. 
                @endif
                </p>
            </div>

           
           

            <!-- EXPERIENCE -->
            <div class="card border-0 shadow mb-4 p-4">
                <h4>Experience</h4>

                @if($user->experience_details)
                   {!! nl2br($user->experience_details) !!}
                @else
                   No experience added yet. 
                @endif

            </div>

        </div>


        <!-- RIGHT SIDE -->
        <div class="col-md-4">

            <!-- INFO CARD -->
            <div class="card border-0 shadow mb-4 p-4">

                <h5>Profile Info</h5>

                <p><strong>Experience:</strong> {{ $user->experience ?? 'Fresher' }}</p>
                @if($user->availability)
                <p><strong>Availability:</strong> {{ $user->availability }}</p>
                @endif
                <p><strong>Location:</strong> {{ $user->location ?? 'Not Found' }}</p>

            </div>

             <div class="card border-0 shadow mb-4 p-4">
                <h5>Skills</h5>

                <div class='d-flex align-items-center flex-wrap' >
                @foreach($user->skills as $skill)
                    <span class="badge skill-badge" >{{ $skill->name }}</span>
                @endforeach
                </div>

            </div>

            <!-- SKILL MATCH / RATING -->
           <div class="card border-0 shadow mb-4 p-4">

                <h5 class="mb-3">Other Profile</h5>

                <div class="d-flex justify-content-center gap-2 flex-wrap">

                @if($user->github || $user->linkedin || $user->portfolio_website)
                    @if($user->github)
                    <a href="{{ $user->github }}" target="_blank" 
                    class="btn btn-dark btn-sm">
                        <i class="fab fa-github"></i> GitHub
                    </a>
                    @endif

                    @if($user->linkedin)
                    <a href="{{ $user->linkedin }}" target="_blank" 
                    class="btn btn-primary btn-sm">
                        <i class="fab fa-linkedin"></i> LinkedIn
                    </a>
                    @endif

                    @if($user->portfolio_website)
                    <a href="{{ $user->portfolio_website }}" target="_blank" 
                    class="btn btn-success btn-sm">
                        <i class="fa fa-globe"></i> Portfolio
                    </a>
                    @endif
                @else
                     <p>Not other profile found !</p>
                @endif

                </div>

            </div>


        </div>

    </div>

</div>
</section>

@endsection


<style>
.skill-badge{
    background:#111111c2;
    color:#A8DF8E !important;
    margin:2px;
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
}
p{
    margin-bottom: 0px !important;
}
</style>
