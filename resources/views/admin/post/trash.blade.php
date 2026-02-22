@extends('layouts.master')

@section('title','Trash Posts')

@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Deleted Posts
                <a href="{{ url('admin/posts') }}" class="btn btn-primary btn-sm float-end">
                    Back
                </a>
            </h4>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Restore</th>
                        <th>Permanent Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>

                            <td>
                                <form action="{{ url('admin/posts/restore/'.$item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success btn-sm">Restore</button>
                                </form>
                            </td>

                            <td>
                                <form action="{{ url('admin/posts/force-delete/'.$item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        Delete Permanently
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No Deleted Posts</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection