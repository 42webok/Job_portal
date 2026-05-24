@extends('admin.layout.app')
@section('title', 'Admin | Add Skill')

@section('content')

<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div class="card-body">

                    <h4 class="card-title">Add Skill</h4>

                    <form method="POST"
                          action="{{ route('skills.store') }}">

                        @csrf

                        <div class="form-group">

                            <label>Skill Name</label>

                            <input type="text"
                                   name="name"
                                   value="{{ old('name') }}"
                                   class="form-control"
                                   placeholder="Enter Skill Name">

                            @error('name')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <button type="submit"
                                class="btn btn-gradient-primary me-2">

                            Save Skill

                        </button>

                        <a href="{{ route('skills.index') }}"
                           class="btn btn-light">

                            Cancel

                        </a>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection