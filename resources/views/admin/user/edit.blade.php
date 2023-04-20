@extends('layouts.master')
@section('title', 'Edit User')

@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Edit User
                <a href="{{url('admin/users')}}" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="">Full Name</label>
                <p class="form-control">{{$user->name}}</p>
            </div>
            <div class="mb-3">
                <label for="">Email Id</label>
                <p class="form-control">{{$user->email}}</p>
            </div>
            <div class="mb-3">
                <label for="">Created At</label>
                <p class="form-control">{{$user->created_at->format('d/m/y')}}</p>
            </div>
            <form action="{{url('admin/update-user/'.$user->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="">Role as</label>
                    <select name="role_as" class="form-control" id="">
                        <option {{$user->role_as == '1' ? 'selected':''}} value="1">Admin</option>
                        <option {{$user->role_as == '0' ? 'selected':''}} value="0">User</option>
                        <option {{$user->role_as == '' ? 'selected':''}} value="2">Blogger</option>
                    </select>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Update Role</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection