@extends('layouts.master')

@section('title', 'Edit Page')

@section('content')

<div class="container-fluid px-4">
   <div class="card mt-4">
        <div class="card-header">
            <h4>Edit Page</h4>
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

            <form action="{{ route('admin.pages.update', $page->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Page Title --}}
                <div class="mb-3">
                    <label>Page Title</label>
                    <input type="text" 
                           name="title" 
                           value="{{ old('title', $page->title) }}" 
                           class="form-control">
                </div>

                {{-- Slug --}}
                <div class="mb-3">
                    <label>Slug</label>
                    <input type="text" 
                           name="slug" 
                           value="{{ old('slug', $page->slug) }}" 
                           class="form-control">
                </div>

                {{-- Content --}}
                <div class="mb-3">
                    <label>Content</label>
                    <textarea rows="6" 
                              id="my_summernote" 
                              name="content" 
                              class="form-control">{{ old('content', $page->content) }}</textarea>
                </div>

                {{-- Current Image --}}
                <div class="mb-3">
                    <label>Current Featured Image</label><br>
                    @if($page->featured_image)
                        <img src="{{ asset('assets/uploads/pages/'.$page->featured_image) }}" 
                             width="150" 
                             style="object-fit:cover; border-radius:6px;">
                    @else
                        <span class="text-muted">No Image Uploaded</span>
                    @endif
                </div>

                {{-- Change Image --}}
                <div class="mb-3">
                    <label>Change Featured Image</label>
                    <input type="file" name="featured_image" class="form-control">
                </div>

                <hr>
                <h6>SEO Tags</h6>

                {{-- Meta Title --}}
                <div class="mb-3">
                    <label>Meta Title</label>
                    <input type="text" 
                           name="meta_title" 
                           value="{{ old('meta_title', $page->meta_title) }}" 
                           class="form-control">
                </div>

                {{-- Meta Description --}}
                <div class="mb-3">
                    <label>Meta Description</label>
                    <textarea name="meta_description" 
                              class="form-control">{{ old('meta_description', $page->meta_description) }}</textarea>
                </div>

                <hr>
                <h6>Visibility Settings</h6>

                <div class="row">

                    {{-- Show in Header --}}
                    <div class="col-md-3 mb-3">
                        <label>Show in Header</label><br>
                        <input type="checkbox" 
                               name="show_in_header" 
                               value="1"
                               {{ $page->show_in_header ? 'checked' : '' }}>
                    </div>

                    {{-- Show in Footer --}}
                    <div class="col-md-3 mb-3">
                        <label>Show in Footer</label><br>
                        <input type="checkbox" 
                               name="show_in_footer" 
                               value="1"
                               {{ $page->show_in_footer ? 'checked' : '' }}>
                    </div>

                    {{-- Active Status --}}
                    <div class="col-md-3 mb-3">
                        <label>Active Status</label><br>
                        <input type="checkbox" 
                               name="status" 
                               value="1"
                               {{ $page->status ? 'checked' : '' }}>
                    </div>

                    {{-- Submit --}}
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">
                            Update Page
                        </button>
                    </div>

                </div>

            </form>

        </div>
   </div>
</div>

@endsection