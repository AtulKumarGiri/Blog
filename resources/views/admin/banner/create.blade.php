@extends('layouts.master')

@section('title', 'Add Home Banner')

@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Add Home Banner</h4>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.home-banner.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Subtitle</label>
                    <textarea name="subtitle" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label>Button Text</label>
                    <input type="text" name="button_text" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Button Link</label>
                    <input type="text" name="button_link" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Banner Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="mb-3">
                    <label>
                        <input type="checkbox" name="status"> Set as Active
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">
                    Save Banner
                </button>

            </form>
        </div>
    </div>
</div>

@endsection