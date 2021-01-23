@extends('layouts.frontend')

@section('title')
    Pickups - Sahana Guitars
@endsection

@section('content')
    <style>
        .card img {
            height: 200px;
            object-fit: cover;
        }

        .card:hover, .card-body a:hover {      
            transform: scale(1.01);
            text-decoration: underline;
        }

        /* .card-body a:hover {
            text-decoration: underline;
        } */

        .card a {
            text-decoration: none;
            color:#000;
        }
    </style>
{{-- <x-front-end-navigation-bar :pickups='$pickups' :pickupbrands="$pickup_brands" :models="$models"/> --}}
<div class="container" style="margin-top:100px;margin-bottom:50px;">
    <div class="row mb-3">
        <h2 style="text-align: center;">All Pickups</h2>
    </div>  
    <div class="col-md-10 mx-auto">                  
        <div class="row row-cols-1 row-cols-md-3 g-4" >
            @foreach ($all_pickups as $pickup)
                @php
                    $images = explode(",",$pickup->image_urls);
                    $urlname=str_replace([' ','(','&',')','$'.'@','-','_','#','!'],'',$pickup->name);
                    $pickup_view_url='/view/'.$urlname.'/'.$pickup->id;
                    $description=substr(strip_tags($pickup->description),0,50)."...";
                @endphp
                <div class="col">
                    <div class="card" >
                        <a href="{{$pickup_view_url}}"><img src="{{asset($images[0])}}" class="card-img-top" alt=""></a>
                        <div class="card-body">
                        <a href="{{$pickup_view_url}}">
                            <h5 class="card-title" style="font-size: 15px; text-align:center;">
                                <b>{{$pickup->name}}</b>
                            </h5> 
                            
                        </a>                           
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection