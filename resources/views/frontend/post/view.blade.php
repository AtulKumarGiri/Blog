@extends('layouts.app')

@section('content')

<div class="page-wrapper px-5 py-4">
<div class="container-fluid main-container">

    <div class="row">

        <!-- MAIN BLOG CONTENT -->
        <div class="col-lg-8">

            <!-- Breadcrumb -->
            <div class="mb-3 text-muted small">
                <a href="{{ url('/') }}" class="text-decoration-none">Home</a> 
                / 
                <a href="{{ url('tutorial/'.$post->category->slug) }}" class="text-decoration-none">
                    {{ $post->category->name }}
                </a>
                / 
                {{ $post->name }}
            </div>

            <!-- Blog Title -->
            <h1 class="blog-title mb-3">
                {{ $post->name }}
            </h1>

            <!-- Meta Info -->
            <div class="blog-meta mb-4">
                <span>{{ $post->created_at->format('d M Y') }}</span>
                <span>• 5 min read</span>
            </div>

            <!-- Featured Image -->
            @if($post->image)
                <img src="{{ asset($post->image) }}" 
                     class="img-fluid rounded-4 shadow-sm mb-4"
                     alt="{{ $post->name }}">
            @endif

            <!-- Blog Content -->
            <div class="blog-content card p-4 shadow-sm border-0">
                {!! $post->description !!}
            </div>

        </div>

        <!-- SIDEBAR -->
        <div class="col-lg-4">

            <!-- Categories -->
            <div class="sidebar-card mb-4">
                <h5 class="sidebar-title">Categories</h5>
                <ul class="sidebar-list">
                    @foreach($all_categories as $category)
                        <li>
                            <a href="{{ url('tutorial/'.$category->slug) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Latest Posts -->
            <div class="sidebar-card mb-4">
                <h5 class="sidebar-title">Latest Posts</h5>
                <ul class="sidebar-list">
                    @foreach($latest_posts as $latest)
                        <li>
                            <a href="{{ url('tutorial/'.$latest->category->slug.'/'.$latest->slug) }}">
                                {{ $latest->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Join Platform -->
            <div class="sidebar-card text-center">
                <h5 class="sidebar-title">Want to Publish?</h5>
                <p class="text-muted small">
                    Join our developer community and share your knowledge.
                </p>
                <a href="{{ url('/register') }}" class="btn primary-btn w-100">
                    Start Writing
                </a>
            </div>

        </div>

    </div>

</div>
</div>

@endsection