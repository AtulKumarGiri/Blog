@extends('layouts.app')

@section('title', $page->meta_title ?? $page->title)

@section('content')

@if($page->featured_image)
    <img src="{{ asset('assets/uploads/pages/'.$page->featured_image) }}" 
         class="img-fluid w-100 mb-4" style="height:280px; object-fit:cover;">
@endif

<div class="container">
    <h1>{{ $page->title }}</h1>

    <div>
        {!! $page->content !!}
    </div>
</div>

@endsection