<!DOCTYPE html>
<html class="no-js" lang="en_AU" />
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>@yield('title' , 'CareerVibe | Find Best Jobs')</title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
	<meta name="HandheldFriendly" content="True" />
	<meta name="pinterest" content="nopin" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
   <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/cropper.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
	<!-- Fav Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="#" />
    <style>
        .page-link{
            color: #A8DF8E !important;
        }
        .page-item.active .page-link{
            color: white !important;
            background-color: #A8DF8E !important;
            border-color: #A8DF8E !important;
        }
        .form-check-input:checked {
            background-color: #A8DF8E !important;
            border-color: #A8DF8E !important;
        }
        .save_mark{
            background-color: #00D363 !important;
            color: white !important;
        }
        .note-btn-group.btn-group button, .note-btn-group.btn-group .btn{
             font-size: 13px !important;
        }
    </style>
</head>
<body data-instant-intensity="mousedown">
    {{-- header code here by AR --}}
<header>
	<nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
		<div class="container">
			<a class="navbar-brand" href="{{ route('index') }}">CareerVibe</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="{{ route('index') }}">Home</a>
					</li>	
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="{{ route('jobs.index') }}">Find Jobs</a>
					</li>										
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="{{ route('candidates') }}">Talent / Candidates</a>
					</li>										
				</ul>				
				@if(Auth::check())
				<a class="btn btn-outline-primary me-3" href="{{ route('profile') }}" >My Profile</a>
				@else
				<a class="btn btn-outline-primary me-3" href="{{ route('login') }}" >Login</a>
				@endif
				<a class="btn btn-primary" href="{{ route('post_job') }}" >Post a Job</a>
			</div>
		</div>
	</nav>
</header>

{{-- main code here by AR --}}
<main>
    @yield('main')
</main>

{{-- model code here by AR --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title pb-0" id="exampleModalLabel">Change Profile Picture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{-- <form id="profileImageForm" method="post" action="{{ route('profile-image-update') }}" enctype="multipart/form-data"> --}}
            {{-- @csrf --}}
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Profile Image</label>
                <input type="file" class="form-control" id="image"  name="image">
                <div id="previewImage">
                    <img src="" alt="Preview Image" class="img-fluid d-none">
                </div>

				{{-- @error('image')
					<p class="text-danger error_image"></p>
				@enderror --}}
            </div>
            <div class="d-flex justify-content-end">
                <button id="cropBtn" class="btn btn-primary mx-3">Crop & Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            
        {{-- </form> --}}
      </div>
    </div>
  </div>
</div>


{{-- footer code here by AR  --}}
<footer class="bg-dark py-3 bg-2">
<div class="container">
    <p class="text-center text-white pt-3 fw-bold fs-6">© 2023 xyz company, all right reserved</p>
</div>
</footer> 
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
  <!-- Cropper JS -->

<script src="{{ asset('assets/js/cropper.js') }}"></script>

<script src="{{ asset('assets/js/instantpages.5.1.0.min.js') }}"></script>
<script src="{{ asset('assets/js/lazyload.17.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/lightbox.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stack('scripts')
@if(session('success'))
<script>
Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'success',
    title: '{{ session('success') }}',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true
});
</script>
@endif

@if($errors->any() || session('error'))
<script>
Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'error',
    title: '{{ $errors->first() }}' || '{{ session('error') }}',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true
});
</script>
@endif

<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
	
</script>
{{-- <script>
$(document).ready(function () {
    $('.summernote').summernote({
        height: 220,
        placeholder: 'Write content here...',
        toolbar: [
            ['style', ['bold', 'italic', 'underline']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']],
            ['view', ['codeview']]
        ]
    });
});
</script> --}}
<script>
  $(document).ready(function() {
    $('.summernote').summernote({
      placeholder: 'Write something...',
      tabsize: 2,
      height: 260,
      toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link', 'picture', 'video', 'table', 'hr']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });
  });

  $('.summernote').summernote({
    callbacks: {
        onImageUpload: function(files) {
            sendFile(files[0], $(this));
        }
    }
});

function sendFile(file, editor) {
    let data = new FormData();
    data.append('file', file);
    $.ajax({
        url: '/upload-image', // your upload route
        type: 'POST',
        data: data,
        contentType: false,
        processData: false,
        success: function(url) {
            editor.summernote('insertImage', url);
        },
        error: function(err) {
            console.error(err);
        }
    });
}

</script>

{{-- image cropper code start here  --}}
<script>
$(document).ready(function () {
    let cropper;
    let selectedImage = document.querySelector('#image');
    let previewImage = document.querySelector('#previewImage img');
    let cropperBtn = document.querySelector('#cropBtn');

    selectedImage.addEventListener('change', function(e){
        let file = e.target.files[0];
        if (!file) return;

        let reader = new FileReader();
        reader.onload = function(event){
            previewImage.src = event.target.result;
            previewImage.classList.remove('d-none');

            // Wait for image to load before initializing cropper
            previewImage.onload = function() {
                // Destroy old cropper if exists
                if (cropper) {
                    cropper.destroy();
                }

                // Initialize cropper
                cropper = new Cropper(previewImage, {
                    aspectRatio: 1,
                    viewMode: 1
                });
            };
        };
        reader.readAsDataURL(file);
    });

    cropperBtn.addEventListener('click', function (e) {
        e.preventDefault(); 

        if (!cropper) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Please select and crop an image first',
                showConfirmButton: false,
                timer: 3000
            });
            return;
        }

        cropper.getCroppedCanvas({
            width: 300,
            height: 300
        }).toBlob(function (blob) {
            let formData = new FormData();
            formData.append('image', blob);
            formData.append('_token', '{{ csrf_token() }}');

            fetch("{{ route('profile-image-update') }}", {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: data.success,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    
                    // Close modal and refresh profile image
                    $('#exampleModal').modal('hide');
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else if (data.error) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: data.error,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Something went wrong',
                    showConfirmButton: false,
                    timer: 3000
                });
            });
        }, 'image/png');
    });
});
</script>
</body>
</html>