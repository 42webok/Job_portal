@extends('admin.layout.app')
@section('title', 'Admin | Create Job')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css">

<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">

                <div class="card-body">
                    <h4 class="card-title">Create Job</h4>
                    <p class="card-description">Add New Job Post</p>

                    <form class="forms-sample" method="POST" action="{{ route('jobs.save') }}">
                        @csrf

                        <div class="row">

                            {{-- Select User --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select User</label>

                                    <select name="user_id" class="form-control">
                                        <option value="">Select User</option>

                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('user_id')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Title --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Job Title</label>

                                    <input type="text"
                                           name="title"
                                           value="{{ old('title') }}"
                                           class="form-control"
                                           placeholder="Enter Job Title">

                                    @error('title')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            {{-- Category --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category</label>

                                    <select name="category_id" class="form-control">
                                        <option value="">Select Category</option>

                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Job Type --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Job Type</label>

                                    <select name="job_type_id" class="form-control">
                                        <option value="">Select Job Type</option>

                                        @foreach($job_types as $type)
                                            <option value="{{ $type->id }}" {{ old('job_type_id') == $type->id ? 'selected' : '' }}>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('job_type_id')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            {{-- Vacancy --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Vacancy</label>

                                    <input type="number"
                                           min="1"
                                           name="vacancy"
                                           value="{{ old('vacancy') }}"
                                           class="form-control"
                                           placeholder="Vacancy">

                                    @error('vacancy')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Salary --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Salary</label>

                                    <input type="text"
                                           name="salary"
                                           value="{{ old('salary') }}"
                                           class="form-control"
                                           placeholder="Salary">

                                    @error('salary')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Location --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Location</label>

                                    <input type="text"
                                           name="location"
                                           value="{{ old('location') }}"
                                           class="form-control"
                                           placeholder="Location">

                                    @error('location')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        {{-- Description --}}
                        <div class="form-group">
                            <label>Description</label>

                            <textarea name="description"
                                      class="form-control summernote"
                                      rows="6">{{ old('description') }}</textarea>

                            @error('description')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Benefits --}}
                        <div class="form-group">
                            <label>Benefits</label>

                            <textarea name="benefits"
                                      class="form-control summernote"
                                      rows="6">{{ old('benefits') }}</textarea>

                            @error('benefits')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Responsibility --}}
                        <div class="form-group">
                            <label>Responsibility</label>

                            <textarea name="responsibility"
                                      class="form-control summernote"
                                      rows="6">{{ old('responsibility') }}</textarea>

                            @error('responsibility')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Qualifications --}}
                        <div class="form-group">
                            <label>Qualifications</label>

                            <textarea name="qualifications"
                                      class="form-control summernote"
                                      rows="6">{{ old('qualifications') }}</textarea>

                            @error('qualifications')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">

                            {{-- Experience --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Experience</label>

                                    <select name="experience" class="form-control">
                                        <option value="">Select Experience</option>
                                        <option value="Fresher">Fresher</option>
                                        <option value="1 Year">1 Year</option>
                                        <option value="2 Years">2 Years</option>
                                        <option value="3 Years">3 Years</option>
                                        <option value="4 Years">4 Years</option>
                                        <option value="5 Years">5 Years</option>
                                        <option value="10+ Years">10+ Years</option>
                                    </select>

                                    @error('experience')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Featured --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Featured Job</label>

                                    <select name="is_featured" class="form-control">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>

                                    @error('is_featured')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status</label>

                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>

                                    @error('status')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        {{-- Keywords --}}
                        <div class="form-group">
                            <label>Keywords</label>

                            <input type="text"
                                   name="keywords"
                                   value="{{ old('keywords') }}"
                                   class="form-control"
                                   placeholder="Laravel, PHP, React etc">

                            @error('keywords')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <h4 class="mb-4">Company Details</h4>

                        <div class="row">

                            {{-- Company Name --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Company Name</label>

                                    <input type="text"
                                           name="company_name"
                                           value="{{ old('company_name') }}"
                                           class="form-control"
                                           placeholder="Company Name">

                                    @error('company_name')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Company Location --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Company Location</label>

                                    <input type="text"
                                           name="company_location"
                                           value="{{ old('company_location') }}"
                                           class="form-control"
                                           placeholder="Company Location">

                                    @error('company_location')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        {{-- Website --}}
                        <div class="form-group">
                            <label>Company Website</label>

                            <input type="text"
                                   name="company_website"
                                   value="{{ old('company_website') }}"
                                   class="form-control"
                                   placeholder="https://example.com">

                            @error('company_website')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-gradient-primary me-2">
                            Save Job
                        </button>

                        <a href="{{ route('jobs.index') }}" class="btn btn-light">
                            Cancel
                        </a>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection


@push('script')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>

<script>
    $(document).ready(function () {

        $('.summernote').summernote({
            height: 200,
            placeholder: 'Write here...',
        });

    });
</script>
<script>
    $(document).ready(function () {

        $('.summernote').summernote({
            height: 250,

            callbacks: {

                onImageUpload: function(files) {

                    uploadSummernoteImage(files[0], $(this));
                }
            }
        });

        function uploadSummernoteImage(file, editor)
        {
            let data = new FormData();

            data.append("file", file);

            $.ajax({
                url: "{{ route('summernote.upload') }}",
                method: "POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,

                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

                success: function(response)
                {
                    editor.summernote('insertImage', response.location);
                },

                error: function(data)
                {
                    alert('Image upload failed');
                }
            });
        }

    });
</script>
@endpush