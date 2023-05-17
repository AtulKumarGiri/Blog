@extends('layouts.app')

@section('content')
<div class="py-5 bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Blog</h4>
                <div class="underline"></div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci aut, ipsam temporibus voluptatibus explicabo necessitatibus dicta saepe earum dolor placeat velit quaerat eaque eius commodi odit? Minima in illum porro iure ad aliquam, possimus eum, praesentium quo corrupti facere beatae. Iure, explicabo facilis. Animi sed, voluptatum suscipit tenetur consequatur soluta? Laudantium laboriosam, possimus accusantium maiores dolor voluptatem perferendis ipsam voluptatum non eius! Asperiores a quas odit quidem commodi eligendi velit atque nisi! Obcaecati quam harum dolor, explicabo labore sed blanditiis?</p>
            </div>
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="border-area text-center p-3">
            <h3>Advertise Here</h3>
        </div>
    </div>
</div>

<div class="py-5 bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>All Categories List</h4>
                <div class="underline"></div>
            </div>
            @foreach($all_categories as $all_cateitem)
            <div class="col-md-3">
                <div class="card card-body mb-3">
                    <a href="{{url('tutorial/'.$all_cateitem->slug) }}" class="text-decoration-none">
                        <h5 class="text-dark mb-0">{{$all_cateitem->name}}</h5>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Latest Posts</h4>
                <div class="underline"></div>
            </div>
            <div class="col-md-8">
                @foreach($latest_posts as $latest_post_item)
                <div class="card card-body mb-3">
                    <a href="{{url('tutorial/'.$latest_post_item->slug.'/'.$latest_post_item->slug) }}" class="text-decoration-none">
                        <h5 class="text-dark mb-0">{{$latest_post_item->name}}</h5>
                    </a>
                    <h6>Posted On: {{$latest_post_item->created_at->format('d-m-y')}}</h6>
                </div>
                @endforeach
            </div>
            <div class="col-md-4">
                <div class="py-5">
                    <div class="container">
                        <div class="border-area text-center p-3">
                            <h3>Advertise Here</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection