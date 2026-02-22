@extends('layouts.master')

@section('title', 'Add Page')

@section('content')

<div class="container-fluid px-4">
   <div class="card mt-4">
        <div class="card-header">
            <h4>Add Page</h4>
        </div>
        <div class="card-body">

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.pages.store') }}" class="row" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Page Title --}}
                <div class="col-md-4 mb-3">
                    <label>Page Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control">
                </div>

                {{-- Slug --}}
                <div class="col-md-4 mb-3">
                    <label>Slug</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug') }}" class="form-control" readonly>
                </div>

                {{-- Featured Image --}}
                <div class="col-md-4 mb-3">
                    <label>Featured Image</label>
                    <input type="file" name="featured_image" class="form-control">
                </div>

                {{-- Content --}}
                <div class="mb-3">
                    <label>Content</label>
                    <textarea rows="6" id="my_summernote" name="content" class="form-control">{{ old('content') }}</textarea>
                </div>

                

                <hr>
                <h6>SEO Tags</h6>

                {{-- Meta Title --}}
                <div class="col-md-12 mb-3">
                    <label>Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title') }}" class="form-control">
                </div>

                {{-- Meta Description --}}
                <div class="mb-3">
                    <label>Meta Description</label>
                    <textarea name="meta_description" class="form-control">{{ old('meta_description') }}</textarea>
                </div>

                <hr>
                <h6>Visibility Settings</h6>

                <div class="row">

                    {{-- Show in Header --}}
                    <div class="col-md-3 mb-3">
                        <label>Show in Header</label><br>
                        <input type="checkbox" name="show_in_header" value="1"
                            {{ old('show_in_header') ? 'checked' : '' }}>
                    </div>

                    {{-- Show in Footer --}}
                    <div class="col-md-3 mb-3">
                        <label>Show in Footer</label><br>
                        <input type="checkbox" name="show_in_footer" value="1"
                            {{ old('show_in_footer') ? 'checked' : '' }}>
                    </div>

                    {{-- Page Status --}}
                    <div class="col-md-3 mb-3">
                        <label>Active Status</label><br>
                        <input type="checkbox" name="status" value="1"
                            {{ old('status') ? 'checked' : '' }}>
                    </div>

                    {{-- Submit --}}
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">
                            Save Page
                        </button>
                    </div>

                </div>

            </form>
        </div>
   </div>
</div>

<script>
    document.getElementById('title').addEventListener('keyup', function() {
        let slug = this.value
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')  
            .replace(/\s+/g, '-')          
            .replace(/-+/g, '-');          

        document.getElementById('slug').value = slug;
    });
</script>

@endsection