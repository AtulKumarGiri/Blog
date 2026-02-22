@extends('layouts.master')

@section('title', 'Pages')

@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Pages List</h4>
            <a href="{{ route('admin.pages.create') }}" class="btn btn-primary btn-sm">
                Add Page
            </a>
        </div>

        <div class="card-body">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($pages as $page)
                        <tr>
                            <td>{{ $page->id }}</td>

                            <td>{{ $page->title }}</td>

                            <td>{{ $page->slug }}</td>

                            <td>
                                @if($page->featured_image)
                                    <img src="{{ asset('assets/uploads/pages/'.$page->featured_image) }}" 
                                         width="60" 
                                         height="60"
                                         style="object-fit:cover;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>

                            <td>
                                @if($page->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.pages.edit', $page->id) }}" 
                                   class="btn btn-warning btn-sm">
                                   Edit
                                </a>

                                <form action="{{ route('admin.pages.destroy', $page->id) }}" 
                                      method="POST" 
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" 
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this page?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                No Pages Found
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection