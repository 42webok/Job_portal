
@extends('admin.layout.app')
@section('title', 'Admin | Create User')
@section('content')
 <div class="content-wrapper">
          
           
           
                 
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add User</h4>
                        <p class="card-description">Create New User</p>

                        <form class="forms-sample" method="POST" action="{{ route('admin.users.save') }}">
                            @csrf
                        
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Enter Name">
                            @error('name')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="Enter Email">
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
                            @error('password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" name="location" value="{{ old('location') }}" class="form-control" id="location" placeholder="Enter Location">
                            @error('location')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-light">Cancel</a>

                        </form>

                    </div>
                    </div>
                </div>
            </div>



          </div>
@endsection
