
@extends('admin.layout.app')
@section('title', 'Admin | Users')
@section('content')
 <div class="content-wrapper">
          
           
           
                 
              <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                    
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">Manage Users</h4>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary float-end">Add User</a>
                    </div>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Name </th>
                            <th> Email </th>
                            <th> Picture </th>
                            <th> Mobile </th>
                            <th> Designation </th>
                            <th> Location </th>
                            <th> Is Public </th>
                            <th> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                 <td>
                                {{ $user->name  }}
                                </td>
                                <td> {{ $user->email }} </td>
                                <td> 
                                    @if($user->image)
                                    <img src="{{ asset('uploads/profile_images/' . $user->image) }}" alt="User Picture" width="50" height="50"> 
                                    @else
                                    <img src="{{ asset('assets/images/avatar7.png') }}" alt="Default Picture" width="50" height="50">
                                    @endif
                                </td>
                                <td> {{ $user->mobile }} </td>
                                <td> {{ $user->designation }} </td>
                                <td> {{ $user->location }} </td>
                                <td> <span class="badge {{ $user->is_public_profile == 1 ? 'bg-success' : 'bg-danger' }}">{{ $user->is_public_profile == 1 ? 'Yes' : 'No' }}</span> </td>
                                <td>
                                    <a href="{{ route('candidate.details', encryptId($user->id)) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('admin.users.edit', encryptId($user->id)) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                             </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                      </table>
                    
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $users->links() }}
                    </div>
                </div>
              </div>
            </div>


          </div>
@endsection
