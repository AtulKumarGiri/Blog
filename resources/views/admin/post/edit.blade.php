@extends('layouts.master')
@section('title', 'Edit Post')

@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Edit Post
                <a href="{{ url('admin/posts') }}" class="btn btn-danger float-end">Back</a>
            </h4>
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

        <form action="{{ url('admin/update-post/'.$post->id) }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="row">
            @csrf
            @method('PUT')

            {{-- Category --}}
            <div class="col-md-4 mb-3">
                <label>Category</label>
                <select name="category_id" required class="form-control">
                    @foreach($category as $cateitem)
                        <option value="{{ $cateitem->id }}"
                            {{ $post->category_id == $cateitem->id ? 'selected' : '' }}>
                            {{ $cateitem->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Post Title --}}
            <div class="col-md-4 mb-3">
                <label>Post Title</label>
                <input type="text" 
                       name="name" 
                       id="name"
                       value="{{ $post->name }}" 
                       class="form-control">
            </div>

            {{-- Slug --}}
            <div class="col-md-4 mb-3">
                <label>Slug</label>
                <input type="text" 
                       name="slug" 
                       id="slug"
                       value="{{ $post->slug }}" 
                       class="form-control">
            </div>

            {{-- Current Featured Image --}}
            <div class="col-md-4 mb-3">
                <label>Current Featured Image</label><br>
                @if($post->image)
                    <img src="{{ asset('uploads/post/'.$post->image) }}" 
                         width="120" 
                         style="object-fit:cover;">
                @else
                    <span class="text-muted">No Image Uploaded</span>
                @endif
            </div>

            {{-- Change Image --}}
            <div class="col-md-4 mb-3">
                <label>Change Featured Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            {{-- Sort Order --}}
            <div class="col-md-4 mb-3">
                <label>Sort Order</label>
                <input type="number" 
                       name="sort_order" 
                       value="{{ $post->sort_order ?? 0 }}" 
                       class="form-control">
            </div>

            {{-- Canonical URL --}}
            <div class="col-md-12 mb-3">
                <label>Canonical URL</label>
                <input type="text" 
                       name="canonical_url" 
                       value="{{ $post->canonical_url }}" 
                       class="form-control">
            </div>

            {{-- Description --}}
            <div class="col-md-12 mb-3">
                <label>Description</label>
                <textarea rows="6" 
                          id="my_summernote" 
                          name="description" 
                          class="form-control">{!! $post->description !!}</textarea>
            </div>

            {{-- YouTube --}}
            <div class="col-md-12 mb-3">
                <label>YouTube Embed Link</label>
                <input type="text" 
                       name="yt_iframe" 
                       value="{{ $post->yt_iframe }}" 
                       class="form-control">
            </div>

            <hr>

            <h5>SEO Settings</h5>

            {{-- Meta Title --}}
            <div class="col-md-12 mb-3">
                <label>Meta Title</label>
                <input type="text" 
                       name="meta_title" 
                       value="{{ $post->meta_title }}" 
                       class="form-control">
            </div>

            {{-- Meta Description --}}
            <div class="col-md-6 mb-3">
                <textarea name="meta_description" 
                          class="form-control">{!! $post->meta_description !!}</textarea>
            </div>

            {{-- Meta Keywords --}}
            <div class="col-md-6 mb-3">
                <textarea name="meta_keyword" 
                          class="form-control">{!! $post->meta_keyword !!}</textarea>
            </div>

            <hr>

            <h5>Post Settings</h5>

            {{-- Status Dropdown --}}
            <div class="col-md-4 mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="draft" 
                        {{ $post->status == 'draft' ? 'selected' : '' }}>
                        Draft
                    </option>
                    <option value="published" 
                        {{ $post->status == 'published' ? 'selected' : '' }}>
                        Published
                    </option>
                    <option value="archived" 
                        {{ $post->status == 'archived' ? 'selected' : '' }}>
                        Archived
                    </option>
                </select>
            </div>

            {{-- Featured --}}
            <div class="col-md-4 mb-3">
                <label>Featured Post</label><br>
                <input type="checkbox" 
                       name="is_featured" 
                       value="1"
                       {{ $post->is_featured ? 'checked' : '' }}>
            </div>

            {{-- Submit --}}
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    Update Post
                </button>
            </div>

        </form>
        </div>
    </div>
</div>

{{-- Auto Slug Script --}}
<script>
document.getElementById('name').addEventListener('keyup', function() {
    let slug = this.value
        .toLowerCase()
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'');

    document.getElementById('slug').value = slug;
});
</script>

@endsection