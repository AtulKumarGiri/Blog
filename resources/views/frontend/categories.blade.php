@extends('layouts.app')

@section('content')

<div class="py-5">
    <div class="container">

        <div class="mb-4 text-center">
            <h1 class="fw-bold">All Categories</h1>
            <p class="text-muted">Browse topics by category</p>

            <div class="search-box mt-4">
                <input type="text" id="globalSearch"
                       class="form-control"
                       placeholder="Search categories or posts...">
            </div>
        </div>

        <div class="row" id="searchResults">

            @foreach($categories as $category)
                <div class="col-md-4 mb-4">
                    <div class="sidebar-card p-4 text-center">

                        <h5 class="fw-bold">
                            {{ $category->name }}
                        </h5>

                        <a href="{{ url('tutorial/'.$category->slug) }}"
                           class="read-more">
                           View Posts →
                        </a>

                    </div>
                </div>
            @endforeach

        </div>

    </div>
</div>

@endsection