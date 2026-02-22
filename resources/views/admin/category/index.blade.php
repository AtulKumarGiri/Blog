@extends('layouts.master')

@section('title', 'Category')

@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>
                View Categories
                <a href="{{ url('admin/add-category') }}" 
                   class="btn btn-primary btn-sm float-end">
                    Add Category
                </a>
                <a href="{{ url('admin/category/trash') }}" 
                    class="btn btn-warning btn-sm float-end me-2">
                    Trash
                </a>
            </h4>
        </div>

        <div class="card-body">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="table-responsive">
                <table id="myDataTable" class="table table-bordered table-striped align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Parent</th>
                            <th>Image</th>
                            <th>Sort</th>
                            <th>Navbar</th>
                            <th>Featured</th>
                            <th>Status</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($category as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>


                                <td class="text-start">
                                    <strong>{{ $item->name }}</strong><br>
                                    <small class="text-muted">{{ $item->slug }}</small>
                                </td>

                                <td>
                                    {{ $item->parent ? $item->parent->name : '—' }}
                                </td>

                                <td>
                                    @if($item->image)
                                        <img src="{{ asset('uploads/category/'.$item->image) }}" 
                                             width="50" height="50"
                                             style="object-fit:cover;border-radius:5px;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>

                                <td>{{ $item->sort_order ?? 0 }}</td>

                                <td>
                                    @if($item->navbar_status)
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="badge bg-secondary">No</span>
                                    @endif
                                </td>

                                <td>
                                    @if($item->is_featured)
                                        <span class="badge bg-warning text-dark">Featured</span>
                                    @else
                                        <span class="badge bg-light text-dark">No</span>
                                    @endif
                                </td>

                                <td>
                                    @if($item->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Hidden</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ url('admin/edit-category/'.$item->id) }}" 
                                       class="btn btn-sm btn-success">
                                        Edit
                                    </a>

                                    <a href="{{ url('admin/delete-category/'.$item->id) }}" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this category?')">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>

@endsection