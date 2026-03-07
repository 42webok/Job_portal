@extends('frontend.layouts.app')

@section('title','Profile')

@section('main')
    
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            @include('frontend.profile.profile_sidebar')
            <div class="col-lg-9">
                <div class="card border-0 shadow mb-4">
                    <form action="{{ route('profile-update') }}" method="POST">
                    <div class="card-body  p-4">
                        <h3 class="fs-4 mb-1">My Profile</h3>
                     
                        @csrf
                        <div class="mb-4">
                            <label for="" class="mb-2">Name*</label>
                            <input type="text" name="name"  placeholder="Enter Name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Email*</label>
                            <input type="text" name="email" placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Designation*</label>
                            <input type="text" name="designation" placeholder="Designation" class="form-control" value="{{ $user->designation }}">
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Mobile*</label>
                            <input type="text" name="mobile" placeholder="Mobile" class="form-control" value="{{ $user->mobile }}">
                        </div>
                    </div>
                    <div class="card-footer  p-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>



                 <!-- ADD SKILLS FORM -->
                <div class="card border-0 shadow mb-4">
                    <div class="card-body p-4">
                        <h3 class="fs-4 mb-3">My Skills</h3>

                        <!-- Display selected skills -->
                        <div id="selected-skills" class="mb-3">
                            @foreach($userSkills as $skill)
                                <span style="background: #A8DF8E !important;" class="badge bg-primary me-1 mb-1 notic">
                                    {{ $skill->name }}
                                    <i class="fa fa-times remove-skill" data-id="{{ $skill->id }}" style="cursor:pointer;"></i>
                                </span>
                            @endforeach
                        </div>

                        <!-- Add Skills Button -->
                        <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#skillsModal">
                            Add Skills
                        </button>
                    </div>
                </div>

                <!-- SKILLS MODAL -->
                <div class="modal fade" id="skillsModal" tabindex="-1" aria-labelledby="skillsModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="skillsModalLabel">Add Skills</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        
                        <input type="text" id="skill-search" class="form-control mb-3" placeholder="Search skills...">

                        <div id="skills-list" class="d-flex flex-wrap">
                            @foreach($allSkills as $skill)
                                <span  style="background: #A8DF8E !important; cursor:pointer" class="badge bg-light text-dark skill-item me-1 mb-1" data-id="{{ $skill->id }}" style="cursor:pointer;">
                                    {{ $skill->name }}
                                </span>
                            @endforeach
                        </div>

                        <p class="mt-3 text-muted small">You can select maximum 10 skills.</p>

                      </div>
                      <div class="modal-footer">
                        <button type="button" id="save-skills" class="btn btn-primary">Save Skills</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>




                <div class="card border-0 shadow mb-4">
                   <form action="{{ route('change_password') }}" method="POST">
                    @csrf
                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-1">Change Password</h3>
                            <div class="mb-4">
                                <label for="" class="mb-2">Old Password*</label>
                               <input type="password" value="{{ old('old_password') }}" name="old_password"
                                class="form-control @error('old_password') is-invalid @enderror">

                                @error('old_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">New Password*</label>
                                <input type="password" value="{{ old('new_password') }}" name="new_password" placeholder="New Password" class="form-control @error('new_password') is-invalid @enderror">
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Confirm Password*</label>
                                <input type="password" value="{{ old('confirm_password') }}" name="confirm_password" placeholder="Confirm Password" class="form-control @error('confirm_password') is-invalid @enderror">
                            @error('confirm_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        <div class="card-footer  p-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                   </form>
                </div>                
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
$(document).ready(function(){

    let selectedSkills = @json($userSkills->pluck('id')); // existing skill ids

    // Click skill in modal
    $('.skill-item').click(function(){

    let skillId = $(this).data('id');

    // REMOVE skill if already selected
    if(selectedSkills.includes(skillId)){

        selectedSkills = selectedSkills.filter(id => id != skillId);

        $(this).removeClass('bg-primary text-white');

        return;
    }

    // LIMIT CHECK
    if(selectedSkills.length >= 10){
        // alert('');
         Swal.fire({
                                                toast: true,
                                                position: 'top-end',
                                                icon: 'error',
                                                title: 'You can select max 10 skills',
                                                showConfirmButton: false,
                                                timer: 3000,
                                                timerProgressBar: true
                                            });
        return;
    }

    // ADD skill
    selectedSkills.push(skillId);

    $(this).addClass('bg-primary text-white');

});


    // Remove skill from badge
    $(document).on('click','.remove-skill',function(){
        let skillId = $(this).data('id');
        selectedSkills = selectedSkills.filter(id => id != skillId);
        $(this).parent().remove();

        // remove highlight in modal
        $(`.skill-item[data-id=${skillId}]`).removeClass('bg-primary text-white');
    });

    // Save skills
    $('#save-skills').click(function(){

        $.ajax({
            url:"{{ route('save_user_skills') }}",
            method:"POST",
            data:{
                skills:selectedSkills
            },
            success:function(res){
                if(res.success){
                    // reload badges
                    $('#selected-skills').html('');
                     Swal.fire({
                                                toast: true,
                                                position: 'top-end',
                                                icon: 'success',
                                                title: 'Skills added success !',
                                                showConfirmButton: false,
                                                timer: 3000,
                                                timerProgressBar: true
                                            });
                    res.skills.forEach(skill => {
                        $('#selected-skills').append(`<span style="background: #A8DF8E !important;"class="badge bg-primary me-1 mb-1">${skill.name} <i class="fa fa-times remove-skill" data-id="${skill.id}" style="cursor:pointer;"></i></span>`);
                    });
                    $('#skillsModal').modal('hide');
                }
            }
        });

    });

    // Search skills
    $('#skill-search').on('keyup',function(){
        let val = $(this).val().toLowerCase();
        $('.skill-item').each(function(){
            let text = $(this).text().toLowerCase();
            $(this).toggle(text.includes(val));
        });
    });

});

$(document).on('click','.remove-skill',function(){

    let skillId = $(this).data('id');
    let badge = $(this).parent();

    $.ajax({
        url:"{{ route('remove_user_skill') }}",
        method:"POST",
        data:{
            skill_id:skillId
        },
        success:function(res){

            if(res.success){

                // remove from array
                selectedSkills = selectedSkills.filter(id => id != skillId);
                 Swal.fire({
                                                toast: true,
                                                position: 'top-end',
                                                icon: 'success',
                                                title: 'Skills remove success !',
                                                showConfirmButton: false,
                                                timer: 3000,
                                                timerProgressBar: true
                                            });

                // remove badge
                badge.remove();

                // remove highlight in modal
                $(`.skill-item[data-id=${skillId}]`).removeClass('bg-primary text-white');

            }

        }
    });

});

</script>
@endpush

