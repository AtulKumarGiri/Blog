@extends('layouts.master')

@section('title', 'Home Banner')

@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Home Banners</h4>
            <a href="{{ route('admin.home-banner.create') }}" class="btn btn-primary btn-sm">
                Add Banner
            </a>
        </div>

        <div class="card-body">

            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($banners as $banner)
                        <tr>
                            <td>{{ $banner->id }}</td>
                            <td>{{ $banner->title }}</td>

                            <td>
                                @if($banner->image)
                                    <img src="{{ asset($banner->image) }}" width="100">
                                @endif
                            </td>

                            <td>
                                @if($banner->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.home-banner.edit', $banner->id) }}"
                                   class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('admin.home-banner.destroy', $banner->id) }}"
                                      method="POST"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this banner?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No banners found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection