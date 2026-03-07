@extends('frontend.layouts.app')

@section('main')

<section class="section-0 lazy d-flex bg-image-style dark align-items-center" data-bg="{{ asset('assets/images/banner5.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-xl-8">
                <h1>Find Top Talent</h1>
                <p>Discover skilled professionals ready to work.</p>
            </div>
        </div>
    </div>
</section>


<section class="section-1 py-5">
    <div class="container">

        <div class="card border-0 shadow p-4 mb-5">

            <div class="row">

                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Search skill...">
                </div>

                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Location">
                </div>

                <div class="col-md-3">
                    <select class="form-control">
                        <option>Experience</option>
                        <option>1 Year</option>
                        <option>2 Years</option>
                        <option>3+ Years</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100">Search</button>
                </div>

            </div>

        </div>


        <div class="row">

            @for($i=0;$i<6;$i++)

            <div class="col-md-4">

                <div class="card border-0 shadow-lg mb-4 candidate-card">

                    <div class="card-body text-center">

                        <img src="{{ asset('assets/images/user.png') }}" class="rounded-circle mb-3" width="90">

                        <h4 class="mb-1">John Developer</h4>

                        <p class="text-muted mb-2">Senior Laravel Developer</p>

                        <p class="mb-2">
                            <i class="fa fa-map-marker"></i> Lahore
                        </p>

                        <span class="badge bg-success mb-3">Open to Work</span>

                        <div class="skills mb-3">
                            <span class="badge bg-light text-dark">Laravel</span>
                            <span class="badge bg-light text-dark">PHP</span>
                            <span class="badge bg-light text-dark">MySQL</span>
                        </div>

                        <p class="text-muted small">
                            4 Years Experience
                        </p>

                        <div class="d-grid">
                            <a href="#" class="btn btn-primary">View Profile</a>
                        </div>

                    </div>

                </div>

            </div>

            @endfor


        </div>

    </div>
</section>

@endsection
