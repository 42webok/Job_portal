@extends('admin.layout.app')
@section('title', 'Admin | Edit Job')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css">

<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">

                <div class="card-body">
                    <h4 class="card-title">Edit Job</h4>
                    <p class="card-description">Update Job Post</p>

                    <form class="forms-sample"
                          method="POST"
                          action="{{ route('jobs.update', encryptId($job->id)) }}">
                        @csrf

                        <div class="row">

                            {{-- Select User --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select User</label>

                                    <select name="user_id" class="form-control">
                                        <option value="">Select User</option>

                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ old('user_id', $job->user_id) == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            {{-- Title --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Job Title</label>

                                    <input type="text"
                                           name="title"
                                           value="{{ old('title', $job->title) }}"
                                           class="form-control"
                                           placeholder="Enter Job Title">
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
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $job->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Job Type --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Job Type</label>

                                    <select name="job_type_id" class="form-control">
                                        <option value="">Select Job Type</option>

                                        @foreach($job_types as $type)
                                            <option value="{{ $type->id }}"
                                                {{ old('job_type_id', $job->job_type_id) == $type->id ? 'selected' : '' }}>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            {{-- Vacancy --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Vacancy</label>

                                    <input type="number"
                                           name="vacancy"
                                           value="{{ old('vacancy', $job->vacancy) }}"
                                           class="form-control">
                                </div>
                            </div>

                            {{-- Salary --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Salary</label>

                                    <input type="text"
                                           name="salary"
                                           value="{{ old('salary', $job->salary) }}"
                                           class="form-control">
                                </div>
                            </div>

                            {{-- Location --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Location</label>

                                    <input type="text"
                                           name="location"
                                           value="{{ old('location', $job->location) }}"
                                           class="form-control">
                                </div>
                            </div>

                        </div>

                        {{-- Description --}}
                        <div class="form-group">
                            <label>Description</label>

                            <textarea name="description" class="form-control summernote">
                                {!! old('description', $job->description) !!}
                            </textarea>
                        </div>

                        {{-- Benefits --}}
                        <div class="form-group">
                            <label>Benefits</label>

                            <textarea name="benefits" class="form-control summernote">
                                {!! old('benefits', $job->benefits) !!}
                            </textarea>
                        </div>

                        {{-- Responsibility --}}
                        <div class="form-group">
                            <label>Responsibility</label>

                            <textarea name="responsibility" class="form-control summernote">
                                {!! old('responsibility', $job->responsibility) !!}
                            </textarea>
                        </div>

                        {{-- Qualifications --}}
                        <div class="form-group">
                            <label>Qualifications</label>

                            <textarea name="qualifications" class="form-control summernote">
                                {!! old('qualifications', $job->qualifications) !!}
                            </textarea>
                        </div>

                        <div class="row">

                            {{-- Experience --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Experience</label>

                                    <select name="experience" class="form-control">
                                        <option value="">Select Experience</option>

                                        <option value="Fresher" {{ $job->experience == 'Fresher' ? 'selected' : '' }}>Fresher</option>
                                        <option value="1 Year" {{ $job->experience == '1 Year' ? 'selected' : '' }}>1 Year</option>
                                        <option value="2 Years" {{ $job->experience == '2 Years' ? 'selected' : '' }}>2 Years</option>
                                        <option value="3 Years" {{ $job->experience == '3 Years' ? 'selected' : '' }}>3 Years</option>
                                        <option value="4 Years" {{ $job->experience == '4 Years' ? 'selected' : '' }}>4 Years</option>
                                        <option value="5 Years" {{ $job->experience == '5 Years' ? 'selected' : '' }}>5 Years</option>
                                        <option value="10+ Years" {{ $job->experience == '10+ Years' ? 'selected' : '' }}>10+ Years</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Featured --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Featured Job</label>

                                    <select name="is_featured" class="form-control">
                                        <option value="0" {{ $job->is_featured == 0 ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ $job->is_featured == 1 ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status</label>

                                    <select name="status" class="form-control">
                                        <option value="1" {{ $job->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $job->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        {{-- Keywords --}}
                        <div class="form-group">
                            <label>Keywords</label>

                            <input type="text"
                                   name="keywords"
                                   value="{{ old('keywords', $job->keywords) }}"
                                   class="form-control">
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
                                           value="{{ old('company_name', $job->company_name) }}"
                                           class="form-control">
                                </div>
                            </div>

                            {{-- Company Location --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Company Location</label>

                                    <input type="text"
                                           name="company_location"
                                           value="{{ old('company_location', $job->company_location) }}"
                                           class="form-control">
                                </div>
                            </div>

                        </div>

                        {{-- Website --}}
                        <div class="form-group">
                            <label>Company Website</label>

                            <input type="text"
                                   name="company_website"
                                   value="{{ old('company_website', $job->company_website) }}"
                                   class="form-control">
                        </div>

                        <button type="submit" class="btn btn-gradient-primary me-2">
                            Update Job
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
            success: function(response) {
                editor.summernote('insertImage', response.location);
            }
        });
    }

});
</script>

@endpush