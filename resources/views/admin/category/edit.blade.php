@extends('layouts.master')

@section('title', 'Edit Category')

@section('content')

<div class="container-fluid px-4">
   <div class="card mt-4">
        <div class="card-header">
            <h4>Edit Category</h4>
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

            <form action="{{ url('admin/update-category/'.$category->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data"
                  class="row">
                @csrf
                @method('PUT')

                {{-- Category Name --}}
                <div class="col-md-4 mb-3">
                    <label>Category Name</label>
                    <input type="text" 
                           name="name" 
                           id="name"
                           value="{{ old('name', $category->name) }}" 
                           class="form-control">
                </div>

                {{-- Slug --}}
                <div class="col-md-4 mb-3">
                    <label>Slug</label>
                    <input type="text" 
                           name="slug" 
                           id="slug"
                           value="{{ old('slug', $category->slug) }}" 
                           class="form-control">
                </div>

                {{-- Parent Category --}}
                <div class="col-md-4 mb-3">
                    <label>Parent Category</label>
                    <select name="parent_id" class="form-control">
                        <option value="">-- None --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ $category->parent_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Description --}}
                <div class="col-md-12 mb-3">
                    <label>Description</label>
                    <textarea rows="5" 
                              id="my_summernote" 
                              name="description" 
                              class="form-control">{{ old('description', $category->description) }}</textarea>
                </div>

                {{-- Image --}}
                <div class="col-md-4 mb-3">
                    <label>Category Image</label>
                    <input type="file" name="image" class="form-control">

                    @if($category->image)
                        <div class="mt-2">
                            <img src="{{ asset('uploads/category/'.$category->image) }}" width="100">
                        </div>
                    @endif
                </div>

                {{-- Sort Order --}}
                <div class="col-md-4 mb-3">
                    <label>Sort Order</label>
                    <input type="number" 
                           name="sort_order" 
                           value="{{ old('sort_order', $category->sort_order) }}" 
                           class="form-control">
                </div>

                {{-- Canonical URL --}}
                <div class="col-md-4 mb-3">
                    <label>Canonical URL</label>
                    <input type="text" 
                           name="canonical_url" 
                           value="{{ old('canonical_url', $category->canonical_url) }}" 
                           class="form-control">
                </div>

                <hr>

                <h6>SEO Settings</h6>

                {{-- Meta Title --}}
                <div class="col-md-12 mb-3">
                    <label>Meta Title</label>
                    <input type="text" 
                           name="meta_title" 
                           value="{{ old('meta_title', $category->meta_title) }}" 
                           class="form-control">
                </div>

                {{-- Meta Description --}}
                <div class="col-md-6 mb-3">
                    <label>Meta Description</label>
                    <textarea name="meta_description" 
                              class="form-control">{{ old('meta_description', $category->meta_description) }}</textarea>
                </div>

                {{-- Meta Keywords --}}
                <div class="col-md-6 mb-3">
                    <label>Meta Keywords</label>
                    <textarea name="meta_keyword" 
                              class="form-control">{{ old('meta_keyword', $category->meta_keyword) }}</textarea>
                </div>

                <hr>

                <h6>Visibility Settings</h6>

                <div class="row">

                    {{-- Navbar Status --}}
                    <div class="col-md-3 mb-3">
                        <label>Show in Navbar</label><br>
                        <input type="checkbox" 
                               name="navbar_status" 
                               value="1"
                               {{ $category->navbar_status == 1 ? 'checked' : '' }}>
                    </div>

                    {{-- Featured --}}
                    <div class="col-md-3 mb-3">
                        <label>Featured Category</label><br>
                        <input type="checkbox" 
                               name="is_featured" 
                               value="1"
                               {{ $category->is_featured == 1 ? 'checked' : '' }}>
                    </div>

                    {{-- Active Status --}}
                    <div class="col-md-3 mb-3">
                        <label>Active Status</label><br>
                        <input type="checkbox" 
                               name="status" 
                               value="1"
                               {{ $category->status == 1 ? 'checked' : '' }}>
                    </div>

                    {{-- Update Button --}}
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            Update Category
                        </button>
                    </div>

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