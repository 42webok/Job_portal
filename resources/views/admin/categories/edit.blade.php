@extends('admin.layout.app')
@section('title', 'Admin | Edit Category')

@section('content')
<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin stretch-card">

            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Edit Category</h4>
                    <p class="card-description">Update Category Information</p>

                    <form class="forms-sample"
                          method="POST"
                          action="{{ route('admin.categories.update', encryptId($category->id)) }}">

                        @csrf

                        <div class="form-group">
                            <label for="name">Category Name</label>

                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $category->name) }}"
                                   class="form-control"
                                   id="name"
                                   placeholder="Enter Category Name">

                            @error('name')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>

                            <select name="status" class="form-control" id="status">

                                <option value="1"
                                    {{ old('status', $category->status) == 1 ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0"
                                    {{ old('status', $category->status) == 0 ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                            @error('status')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-gradient-primary me-2">
                            Update
                        </button>

                        <a href="{{ route('admin.categories.index') }}" class="btn btn-light">
                            Cancel
                        </a>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection