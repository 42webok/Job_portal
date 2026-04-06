@extends('frontend.layouts.app')

@section('main')

<!-- HERO -->
<section class="section-0 lazy d-flex bg-image-style dark align-items-center" data-bg="{{ asset('assets/images/banner5.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-xl-8">
                <h1>Hire Top Freelancers</h1>
                <p>Connect with talented professionals ready to work.</p>

                <div class="d-flex mt-4 gap-4 text-white">
                    <div>
                        <h4 class="mb-0">500+</h4>
                        <small>Active Talent</small>
                    </div>
                    <div>
                        <h4 class="mb-0">120+</h4>
                        <small>Skills Available</small>
                    </div>
                    <div>
                        <h4 class="mb-0">95%</h4>
                        <small>Success Rate</small>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<!-- FILTER -->
<section class="section-1 py-5">
    <div class="container">

        <div class="card border-0 shadow p-4 mb-5 sticky-top" style="top:10px; z-index:10;">

            <div class="row g-3">

                <div class="col-md-4">
                    <input type="text" class="form-control" id="skillSearch" placeholder="Search skills (Laravel, React...)">
                </div>

                <div class="col-md-3">
                    <input type="text" class="form-control" id="locationSearch" placeholder="Location">
                </div>

                <div class="col-md-3">
                    <select class="form-control" id="experienceSearch">
                        <option value="">Experience</option>
                        <option>1 Year</option>
                        <option>2 Years</option>
                        <option>3 Years</option>
                        <option>4 Years</option>
                        <option>5 Years</option>
                        <option>6 Years</option>
                        <option>7 Years</option>
                        <option>8 Years</option>
                        <option>9 Years</option>
                        <option>10 Years</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100" id="searchButton">Search</button>
                </div>

            </div>

        </div>


        <!-- CANDIDATES -->
        <div class="row" id="candidateList">

            @forelse($candidate as $user)

            <div class="col-md-4">

                <div class="card border-0 shadow candidate-card mb-4">

                    <div class="card-body">

                        <!-- TOP -->
                        <div class="d-flex align-items-center mb-3">

                            @if($user->image)
                            <img src="{{ asset('uploads/profile_images/'.$user->image) }}" class="w-25 img-fluid rounded-circle me-3">
                            @else
                            <img src="{{ asset('assets/images/avatar7.png') }}" class="w-25 img-fluid rounded-circle me-3"> 
                            @endif
                            <div>
                                <h5 class="mb-0">{{ $user->name }}</h5>
                                <small class="text-muted">{{ $user->designation }}</small>
                            </div>

                        </div>

                        <!-- BADGE -->
                        <span class="badge bg-success mb-2">Open to Work</span>

                        <!-- LOCATION -->
                        <p class="mb-2 text-muted">
                            <i class="fa fa-map-marker"></i> {{ $user->location }}
                        </p>

                        <!-- SKILLS -->
                        <div class="skills mb-3">
                            @forelse($user->skills as $skills)
                            <span class="badge skill-badge">{{ $skills->name }}</span>
                            @empty 
                            <span class="badge skill-badge">no skill mention</span>
                            @endforelse

                        </div>

                        <!-- INFO -->
                        <div class="d-flex justify-content-between mb-3 small text-muted">

                            <span>⭐ 4.8 Rating</span>
                            <span>💼 {{ $user->experience ? $user->experience : 'Fresher'  }}</span>

                        </div>

                        <!-- ACTION -->
                        <div class="d-grid">
                            <a href="{{ route('candidate.details' ,  encryptId($user->id)) }}" class="btn btn-primary btn-sm">View Profile</a>
                        </div>

                    </div>

                </div>

            </div>
            @empty 
            <h4>No candidates found !</h4>

            @endforelse

             <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center">
                            {{ $candidate->links() }}
                        </div>
                    </div>
                </div>

        </div>
        <div id="pagination"></div>

    </div>
</section>

@endsection


<style>
/* CARD HOVER */
.candidate-card{
    transition:0.3s;
    border-radius:12px;
}

.candidate-card:hover{
    transform:translateY(-6px);
    box-shadow:0 12px 30px rgba(0,0,0,0.12);
}

/* SKILL BADGES */
.skill-badge{
    background:#111111c2 !important;
    color:#A8DF8E !important;
    margin:2px;
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
}

/* FILTER STICKY FIX */
.sticky-top{
    backdrop-filter: blur(10px);
    background: rgba(255,255,255,0.95);
}
.light-theme .current {
    background: #ffffff !important;
    color: #000000 !important;
    border-color: #444;
    box-shadow: 0 1px 0 rgba(255, 255, 255, 1), 0 0 2px rgba(0, 0, 0, 0.3) inset;
    cursor: default;
}
</style>


@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/simplePagination.css">

<script>
    $(document).ready(function(){
       let searchButton = $('#searchButton');
       $('#skillSearch, #locationSearch, #experienceSearch').on('keypress', function(e){
            if(e.which == 13){
                searchButton.click();
            }
        });
       let skillSearch = $('#skillSearch');
       let locationSearch = $('#locationSearch');
       let experienceSearch = $('#experienceSearch');
        
      function loadCandidates(page = 1){
           
           let skill = skillSearch.val();
           let location = locationSearch.val();
           let experience = experienceSearch.val();
        
           $.ajax({
               url:"{{ route('candidate.search') }}",
               method:"GET",
              data:{ 
                    skill:skill, 
                    location:location, 
                    experience:experience,
                    page: page
                },
               success:function(response){
                     // Clear current candidates
                     console.log(response);
                     $('#candidateList').empty();

                     if(response.candidates.data.length > 0){
                          response.candidates.data.forEach(function(candidate){
                            let candidateCard = `
                                 <div class="col-md-4">

                                <div class="card border-0 shadow candidate-card mb-4">

                                    <div class="card-body">

                                        <div class="position-relative">
                                            <div class="d-flex align-items-center mb-3">

                                                ${candidate.image ? `<img src="/uploads/profile_images/${candidate.image}" class="w-25 img-fluid rounded-circle me-3">` : `<img src="{{ asset('assets/images/avatar7.png') }}" class="w-25 img-fluid rounded-circle me-3">` }
                                                <div>
                                                <h5 class="mb-0">${candidate.name}</h5>
                                                <small class="text-muted">${candidate.designation}</small>
                                            </div>

                                        </div>

                                        
                                        <span class="badge bg-success mb-2">Open to Work</span>

                                        <!-- LOCATION -->
                                        <p class="mb-2 text-muted">
                                            <i class="fa fa-map-marker"></i> ${candidate.location}
                                        </p>

                                        
                                        <div class="skills mb-3">
                                            ${candidate.skills.length > 0 ? candidate.skills.map(skill => `<span class="badge skill-badge">${skill.name}</span>`).join('') : `<span class="badge skill-badge">no skill mention</span>`}

                                        </div>

                                       
                                        <div class="d-flex justify-content-between mb-3 small text-muted">

                                            <span>⭐ 4.8 Rating</span>
                                            <span>💼 ${candidate.experience ? candidate.experience : 'Fresher'}</span>

                                        </div>

                                       
                                        <div class="d-grid">
                                           <a href="/candidate/${candidate.encrypted_id}" 
                                                class="btn btn-primary btn-sm">View Profile</a>
                                        </div>

                                    </div>

                                </div>

                            </div>
                            `;
                            $('#candidateList').append(candidateCard);
                          });
                          $('#pagination').pagination('destroy');
                          $('#pagination').pagination({
                                items: response.candidates.total,
                                itemsOnPage: response.candidates.per_page,
                                currentPage: response.candidates.current_page,
                                cssStyle: 'light-theme',
                                triggerPagingOnInit: false,
                                onPageClick: function(pageNumber) {
                                    loadCandidates(pageNumber);
                                }
                            });
                     } else {
                         $('#candidateList').append('<h4>No candidates found!</h4>');
                     }
                
               },
               error:function(error){
                   console.error("Search error:", error);
               }
           });
         }
         searchButton.on('click', function(){
              loadCandidates();
         });
    });
</script>






@endpush