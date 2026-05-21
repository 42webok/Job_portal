@extends('admin.layout.app')
@section('title', 'Admin | Categories')
@section('content')
<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">Manage Categories</h4>

                        <a href="{{ route('admin.categories.create') }}"
                           class="btn btn-primary float-end">
                            Add Category
                        </a>
                    </div>

                    <div class="table-responsive">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($categories as $key => $category)

                                    <tr>

                                        <td>
                                            {{ $key +1 }}
                                        </td>

                                        <td>
                                            {{ $category->name }}
                                        </td>

                                        <td>
                                            {{ $category->slug }}
                                        </td>

                                        <td>
                                            <span class="badge {{ $category->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $category->status == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $category->created_at ? $category->created_at->format('d M Y') : 'N/A' }}
                                        </td>

                                        <td>

                                            <a href="{{ route('admin.categories.edit', encryptId($category->id)) }}"
                                               class="btn btn-sm btn-warning">
                                                Edit
                                            </a>

                                            <a href="{{ route('admin.categories.delete', encryptId($category->id)) }}"
                                               class="btn btn-sm btn-danger">
                                                Delete
                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="6" class="text-center">
                                            No categories found
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>
                        </table>

                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        {{ $categories->links() }}
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>
@endsection