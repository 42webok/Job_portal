@extends('admin.layout.app')
@section('title', 'Admin | Create Category')

@section('content')
<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div class="card-body">

                    <h4 class="card-title">Add Category</h4>

                    <form method="POST" action="{{ route('admin.categories.save') }}">
                        @csrf

                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <button class="btn btn-primary">Submit</button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-light">Cancel</a>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>
@endsection