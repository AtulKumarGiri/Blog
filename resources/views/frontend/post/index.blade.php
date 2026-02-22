@extends('layouts.app')

@section('content')

<div class="py-5">
    <div class="container">

        <!-- CATEGORY HERO -->
        <div class="category-hero mb-5">

            @if($category->image)
                <img src="{{ asset('uploads/category/'.$category->image) }}"
                     class="category-banner"
                     alt="{{ $category->name }}">
            @endif

            <div class="category-overlay">
                <h1 class="fw-bold mb-2">{{ $category->name }}</h1>
                <p class="text-light mb-0">
                    Explore latest posts under {{ $category->name }}
                </p>
            </div>
        </div>

        <div class="row">

            <!-- LEFT CONTENT -->
            <div class="col-lg-8">

                @forelse($posts as $postitem)

                    <div class="post-card mb-4 p-4">

                        <a href="{{ url('tutorial/'.$category->slug.'/'.$postitem->slug) }}"
                           class="text-decoration-none">

                            <h3 class="post-title mb-2">
                                {{ $postitem->name }}
                            </h3>
                        </a>

                        <div class="post-meta mb-3">
                            <span>{{ $postitem->created_at->format('d M Y') }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ $postitem->user->name ?? 'Admin' }}</span>
                        </div>

                        <p class="post-excerpt">
                            {{ Str::limit(strip_tags($postitem->description), 150) }}
                        </p>

                        <a href="{{ url('tutorial/'.$category->slug.'/'.$postitem->slug) }}"
                           class="read-more">
                            Read More →
                        </a>

                    </div>

                @empty

                    <div class="post-card p-4 text-center">
                        <h4>No Posts Available</h4>
                    </div>

                @endforelse

                <div class="mt-4">
                    {{ $posts->links() }}
                </div>

            </div>

            <!-- SIDEBAR -->
            <div class="col-lg-4">

                <div class="sidebar-card p-4 mb-4">
                    <h5 class="fw-bold mb-3">Categories</h5>

                    @foreach($allCategories as $cat)
                        <div class="mb-2">
                            <a href="{{ url('tutorial/'.$cat->slug) }}"
                               class="sidebar-link
                               {{ $cat->id == $category->id ? 'active-category' : '' }}">
                                {{ $cat->name }}
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="sidebar-card p-4">
                    <h5 class="fw-bold mb-3">Advertisement</h5>
                    <div class="ad-box">
                        Your Ad Space Here
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

@endsection