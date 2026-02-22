@extends('layouts.app')

@section('content')

<div class="py-5">
    <div class="container">

        <div class="mb-4 text-center">
            <h1 class="fw-bold">All Blog Posts</h1>
            <p class="text-muted">Explore all published articles</p>

            <!-- Live Search -->
            <div class="search-box mt-4">
                <input type="text" id="globalSearch"
                       class="form-control"
                       placeholder="Search posts or categories...">
            </div>
        </div>

        <div class="row" id="searchResults">

            @foreach($posts as $post)
                <div class="col-lg-6 mb-4">
                    <div class="post-card p-4 h-100">

                        <a href="{{ url('tutorial/'.$post->category->slug.'/'.$post->slug) }}"
                           class="text-decoration-none">
                            <h4 class="post-title">
                                {{ $post->name }}
                            </h4>
                        </a>

                        <div class="post-meta mb-2">
                            {{ $post->created_at->format('d M Y') }}
                            • {{ $post->user->name ?? 'Admin' }}
                        </div>

                        <p class="post-excerpt">
                            {{ Str::limit(strip_tags($post->description),120) }}
                        </p>

                        <a href="{{ url('tutorial/'.$post->category->slug.'/'.$post->slug) }}"
                           class="read-more">
                           Read More →
                        </a>

                    </div>
                </div>
            @endforeach

        </div>

        <div class="mt-4">
            {{ $posts->links() }}
        </div>

    </div>
</div>

@endsection