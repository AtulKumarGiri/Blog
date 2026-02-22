@extends('layouts.app')

@section('content')
@php use Illuminate\Support\Str; @endphp

<div class="page-wrapper px-5 py-4">
<div class="container-fluid main-container">

    <!-- HERO SECTION -->
    @if(isset($banner))
        <div class="hero-section row align-items-center">

            <div class="col-lg-6">
                <h1 class="hero-title">
                    {!! $banner->title !!}
                </h1>

                <p class="hero-desc">
                    {{ $banner->subtitle }}
                </p>

                @if($banner->button_text)
                    <a href="{{ $banner->button_link ?? '#' }}" 
                    class="btn primary-btn">
                        {{ $banner->button_text }}
                    </a>
                @endif
            </div>

            <div class="col-lg-6 text-center hero-img-wrapper">
                @if($banner->image)
                    <img src="{{ asset($banner->image) }}"
                        class="img-fluid hero-img"
                        alt="{{ $banner->title }}">
                @else
                    <img src="{{ asset('assets/images/home.png') }}"
                        class="img-fluid hero-img"
                        alt="Default Banner">
                @endif
            </div>

        </div>
        @endif

    <!-- CONTENT SECTION -->
    <div class="row mt-5">

        <!-- LEFT BLOG LIST -->
        <div class="col-lg-8">

            <!-- Trending Topics -->
            <h5 class="section-heading">Trending Topics</h5>

            <div class="trending-tags mb-4">
                <a href="{{ url('/') }}" class="tag active">All</a>

                @foreach($all_categories as $category)
                    <a href="{{ url('category/'.$category->slug) }}" class="tag">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            @foreach($latest_posts as $post)
                <div class="blog-card mb-4 position-relative">
                    <div class="row g-0">

                        <div class="col-md-4 position-relative">
                            @if($post->image)
                                <img src="{{ asset($post->image) }}"
                                    class="img-fluid rounded-start"
                                    alt="{{ $post->category->name }}">
                            @else
                                <img src="{{ asset('assets/images/default-blog.png') }}"
                                    class="img-fluid rounded-start"
                                    alt="Default">
                            @endif
                            <span class="category-badge">
                                {{ $post->category->name ?? 'General' }}
                            </span>
                        </div>

                        <div class="col-md-8 p-4">
                            <h4>
                                <a href="{{ url('tutorial/'.$post->category->slug.'/'.$post->slug) }}">
                                    {{ $post->name }}
                                </a>
                            </h4>

                            <p>
{{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($post->description)), 120) }}                            </p>

                            <div class="blog-meta">
                                <span class="badge-tag">
                                    {{ $post->category->name ?? 'General' }}
                                </span>

                                <span>
                                    {{ $post->created_at->diffForHumans() }}
                                </span>

                                <span>
                                    • 5 min read
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach           

        </div>

        <!-- RIGHT SIDEBAR -->
        <div class="col-lg-4">

            <!-- Popular Topics -->
            <div class="sidebar-card mb-4">
                <h5>Popular Topics</h5>
                <ul class="popular-list">
                    @foreach($all_categories as $category)
                        <li>
                            <a href="{{ url('category/'.$category->slug) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Latest Articles -->
            <div class="sidebar-card mb-4">
                <h5>Latest Articles</h5>
                <ul class="latest-list">
                    @foreach($latest_posts->take(5) as $post)
                        <li>
                            <a href="{{ url('post/'.$post->slug) }}">
                                {{ $post->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Social -->
            <div class="sidebar-card mb-4 text-center">
                <h5>Stay Connected</h5>
                <div class="social-icons mt-3">
                    <i class="bi bi-twitter"></i>
                    <i class="bi bi-linkedin"></i>
                    <i class="bi bi-facebook"></i>
                    <i class="bi bi-github"></i>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="sidebar-card">
                <h5>Subscribe to Newsletter</h5>
                <input type="email"
                       class="form-control mt-3"
                       placeholder="Enter your email">
                <button class="btn primary-btn w-100 mt-3">
                    Subscribe
                </button>
            </div>

        </div>

    </div>

</div>
</div>

@endsection
