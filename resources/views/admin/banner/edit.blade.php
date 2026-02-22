@extends('layouts.master')

@section('title', 'Edit Home Banner')

@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Edit Home Banner</h4>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.home-banner.update', $banner->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" 
                           value="{{ $banner->title }}" 
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Subtitle</label>
                    <textarea name="subtitle" 
                              class="form-control"
                              rows="3">{{ $banner->subtitle }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Button Text</label>
                    <input type="text" name="button_text"
                           value="{{ $banner->button_text }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Button Link</label>
                    <input type="text" name="button_link"
                           value="{{ $banner->button_link }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Banner Image</label>
                    <input type="file" name="image" class="form-control">

                    @if($banner->image)
                        <div class="mt-2">
                            <img src="{{ asset($banner->image) }}" width="150">
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label>
                        <input type="checkbox" name="status"
                               {{ $banner->status == 1 ? 'checked' : '' }}>
                        Set as Active
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Banner
                </button>

            </form>

        </div>
    </div>
</div>

@endsection