 <div class="col-lg-3">
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="s-body text-center mt-3">
                        @if(Auth::user()->image)
                        <img src="{{ asset('uploads/profile_images/'.Auth::user()->image) }}" alt="avatar"  class="rounded-circle img-fluid" style="width: 150px;height:150px;object-fit:cover;">
                        @else
                        <img src="{{ asset('assets/images/avatar7.png') }}" alt="avatar"  class="rounded-circle img-fluid" style="width: 150px;">
                        @endif
                        <h5 class="mt-3 pb-0">{{ Auth::user()->name }}</h5>
                        <p class="text-muted mb-1 fs-6">{{ Auth::user()->designation != '' ? Auth::user()->designation : 'Not Specified' }}</p>
                        <div class="d-flex justify-content-center mb-2">
                            <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-primary">Change Profile Picture</button>
                        </div>
                    </div>
                    {{-- profile visible code start here  --}}

                    <div class="text-center mt-2" ><input type="checkbox" {{ Auth::user()->is_public_profile == 1 ? 'checked' : '' }} value='{{ Auth::user()->is_public_profile }}' class="form-check-input" name="is_public_profile" id="is_public_profile">
                    <label for="is_public_profile" class="form-check-label" >Make my profile visible</label></div>
                    <i class="employers text-center mt-3 text-success" ><b>Allow employers to see your profile and contact you for job opportunities.</b></i>

                    {{-- profile visible code end here  --}}
                </div>
                <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush ">
                            <li class="list-group-item d-flex justify-content-between p-3">
                                <a href="{{ route('profile') }}">Account Settings</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <a href="{{ route('post_job') }}">Post a Job</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <a href="{{ route('my_jobs') }}">My Jobs</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <a href="{{ route('applied_jobs') }}">Jobs Applied</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <a href="{{ route('saved_jobs') }}">Saved Jobs</a>
                            </li>
                            <a class="btn btn-primary w-100" href="{{ route('logout') }}" >Logout</a>
                        </ul>
                    </div>
                </div>
            </div>


            @push('scripts')
                <script>
                    $('document').ready(function(){
                        $('#is_public_profile').on('change' , function(){
                            let current_value = this.value;
                            console.log(current_value);
                            $.ajax({
                                type: 'post',
                                url: '{{ route('is_public_profile') }}',
                                data: {
                                    'is_public_profile' : current_value
                                },
                                success: function(data){
                                    console.log(data);
                                   if(data.success){
                                            $('#is_public_profile').prop('checked', data.current_status == 1);
                                             $('#is_public_profile').val(data.current_status);
                                            Swal.fire({
                                                toast: true,
                                                position: 'top-end',
                                                icon: 'success',
                                                title: 'Profile visibility updated',
                                                showConfirmButton: false,
                                                timer: 3000,
                                                timerProgressBar: true
                                            });

                                        }else{

                                            Swal.fire({
                                                toast: true,
                                                position: 'top-end',
                                                icon: 'error',
                                                title: 'Update failed',
                                                showConfirmButton: false,
                                                timer: 3000
                                            });

                                        }
                                }
                            })
                            
                        })
                    })
                </script>
            @endpush