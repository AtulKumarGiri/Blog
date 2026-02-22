@extends('layouts.master')
@section('title', 'Add Post')

@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Add Post
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

        <form action="{{ url('admin/posts') }}" method="POST" enctype="multipart/form-data" class="row">
            @csrf

            {{-- Category --}}
            <div class="col-md-4 mb-3">
                <label>Category</label>
                <select name="category_id" class="form-control">
                    @foreach($category as $cateitem)
                        <option value="{{ $cateitem->id }}">
                            {{ $cateitem->name }}
                        </option>
                    @endforeach    
                </select>
            </div>

            {{-- Post Name --}}
            <div class="col-md-4 mb-3">
                <label>Post Title</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>

            {{-- Slug --}}
            <div class="col-md-4 mb-3">
                <label>Slug</label>
                <input type="text" name="slug" id="slug" class="form-control">
            </div>

            {{-- Featured Image --}}
            <div class="col-md-4 mb-3">
                <label>Featured Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            {{-- Sort Order --}}
            <div class="col-md-4 mb-3">
                <label>Sort Order</label>
                <input type="number" name="sort_order" value="0" class="form-control">
            </div>

            {{-- Canonical URL --}}
            <div class="col-md-4 mb-3">
                <label>Canonical URL</label>
                <input type="text" name="canonical_url" class="form-control">
            </div>

            {{-- Description --}}
            <div class="col-md-12 mb-3">
                <label>Description</label>
                <textarea rows="6" id="my_summernote" name="description" class="form-control"></textarea>
            </div>

            {{-- YouTube Link --}}
            <div class="col-md-12 mb-3">
                <label>YouTube Embed Link</label>
                <input type="text" name="yt_iframe" class="form-control">
            </div>

            <hr>

            <h5>SEO Settings</h5>

            {{-- Meta Title --}}
            <div class="col-md-12 mb-3">
                <label>Meta Title</label>
                <input type="text" name="meta_title" class="form-control">
            </div>

            {{-- Meta Description --}}
            <div class="col-md-6 mb-3">
                <label>Meta Description</label>
                <textarea name="meta_description" class="form-control"></textarea>
            </div>

            {{-- Meta Keywords --}}
            <div class="col-md-6 mb-3">
                <label>Meta Keywords</label>
                <textarea name="meta_keyword" class="form-control" placeholder="Meta Keywords"></textarea>
            </div>

            <hr>

            <h5>Post Settings</h5>

            {{-- Status Dropdown --}}
            <div class="col-md-4 mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="archived">Archived</option>
                </select>
            </div>

            {{-- Featured --}}
            <div class="col-md-4 mb-3">
                <label>Featured Post</label><br>
                <input type="checkbox" name="is_featured" value="1">
            </div>

            {{-- Submit --}}
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    Save Post
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