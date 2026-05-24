@extends('admin.layout.app')
@section('title', 'Admin | Skills')

@section('content')

<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">

            <div class="card">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h4 class="card-title">
                            Manage Skills
                        </h4>

                        <a href="{{ route('skills.create') }}"
                           class="btn btn-primary">

                            Add Skill

                        </a>

                    </div>

                    

                    <div class="table-responsive">

                        <table class="table">

                            <thead>

                                <tr>
                                    <th>ID</th>
                                    <th>Skill Name</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>

                            </thead>

                            <tbody>

                                @forelse($skills as $skill)

                                    <tr>

                                        <td>
                                            {{ $skill->id }}
                                        </td>

                                        <td>
                                            {{ $skill->name }}
                                        </td>

                                        <td>
                                            {{ date('d M Y', strtotime($skill->created_at)) }}
                                        </td>

                                        <td>

                                            <a href="{{ route('skills.edit', encryptId($skill->id)) }}"
                                               class="btn btn-sm btn-warning">

                                                Edit

                                            </a>

                                            <a href="{{ route('skills.delete', encryptId($skill->id)) }}"
                                               class="btn btn-sm btn-danger"
                                               onclick="return confirm('Are you sure?')">

                                                Delete

                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="4" class="text-center">
                                            No Skills Found
                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="d-flex justify-content-end mt-3">

                        {{ $skills->links() }}

                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection