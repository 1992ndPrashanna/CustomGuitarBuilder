@extends('layouts.frontend')

@section('title')
    {{$viewPickup->name}}
@endsection

@section('content')

<style>
    .carousel-item {
        height: 30rem;
        background-color: #000;
        color: #fff;
        position: relative;

    }
    .container{
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding-bottom: 50px;
    }

    .overlay-image{
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        top:0;
        background-position: center;
        background-size: contain;
        background-repeat:no-repeat;
        opacity: .6;

    }
</style>

@php

    $exploded_images_array=explode(",",$viewPickup->image_urls);
    $exploded_description=explode(".",strip_tags($viewPickup->description));
    $length=sizeof($exploded_images_array);
    $i=0
@endphp

{{-- <x-front-end-navigation-bar :pickups='$pickups' :pickupbrands="$pickup_brands" :models="$models" /> --}}
<div class="col-md-11 mx-auto" style="padding:10px; font-size:16px; margin-top:100px;" >
    <div class="row">
        <div class="col-md-6">
        {{-- start carousel --}}
        <div id="pickupImages" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                @for ($i = 0; $i < $length-1; $i++)
                <li data-bs-target="#pickupImages" data-bs-slide-to="{{$i}}" class="active"></li>
                @endfor               
            </ol>
            <div class="carousel-inner">
                @for ($i = 0; $i < $length-1; $i++)
                <div class="carousel-item @php if($i==0) echo "active"; @endphp" >
                    <div class="overlay-image" style="background-image: url({{asset($exploded_images_array[$i])}})"></div>
                    <div class="container">
                        <h1>{{$viewPickup->name}}</h1>
                        @if ($viewPickup->description!="")
                            <p>@php echo $exploded_description[0]."."; @endphp</p>
                        @endif
                        <a href="#description" class="btn btn-lg btn-primary">Read More</a>
                    </div>
                </div>

                @endfor
                {{-- <div class="carousel-item" style="background-image: url({{asset($exploded_images_array[1])}})">
                    <div class="container">
                        <h1>{{$viewPickup->name}}</h1>
                        <p>@if($viewPickup->description!=""){{strip_tags($exploded_description[1])}} @endif</p>
                        <a href="#description" class="btn btn-lg btn-primary">Read More</a>
                    </div>
                </div> --}}
            </div>
            <a href="#pickupImages" class="carousel-control-prev" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a href="#pickupImages" class="carousel-control-next" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>
    <div class="col-md-5" style="padding-left:auto;">
        <table class="table" style="text-align:left;background-color:#fff;height:100%;">
            <tbody>    
            <tr>
                <td><strong>Brand</strong></td>
                <td>{{$viewPickup->pickupBrand->brand}}</td>
                <td><strong>Model</strong></td>
                <td>{{$viewPickup->name}}</td>
            </tr>
            <tr>
                <td><strong>Position</strong></td>
                <td>{{$viewPickup->pickupPosition->type}}</td>
                <td><strong>Type</strong></td>
                <td>{{$viewPickup->pickupType->type}}</td>
            </tr>
            <tr>
                <td><strong>Active/Passive?</strong></td>
                <td>{{$viewPickup->activePassive->type}}</td>
                <td><strong>Conductors</strong></td>
                <td>{{$viewPickup->conductors}}</td>
            </tr>
            <tr>
                <td><strong>Magnet</strong></td>
                <td>{{$viewPickup->pickupMagnet->type}}</td>
                <td><strong>Strings</strong></td>
                <td>{{$viewPickup->strings}}</td>
            </tr>
            <tr>
                <td><strong>Covering</strong></td>
                <td>{{$viewPickup->pickupCovering->type}}</td>
                <td><strong>Price</strong></td>
                <td>{{$viewPickup->price}} USD</td>
            </tr>
            <tr>
                <td><strong>Signature Series?</strong></td>
                <td>{{$viewPickup->signatures_series}}</td>
                <td> <strong> Avalability </strong></td>
                <td @php
                    if($viewPickup->stock=="In Stock")
                    echo 'style="color: green;"';
                    else
                    echo 'style="color:red;"'
                @endphp>{{$viewPickup->stock}}</td>
            </tr>
                @if ($viewPickup->signatures_series!="No")
                    <tr>
                        <td>
                        <strong>Signature Artists</strong> 
                        </td>
                        <td colspan="4">
                            @php 
                                $artist_list=$viewPickup->signature_artist;
                                $artists_array=explode(",",$artist_list);
                            @endphp
                        <ul style="list-style-type:none; margin:0px;padding:0px;">
                            @foreach ($artists_array as $artist)
                                <li style="display: inline-block; margin:0px;margin-right:20px; padding:0px;">{{$artist }} </li>
                            @endforeach
                        </ul>
                        </td> 
                    </tr>
                @endif
            
                @if ($viewPickup->website!=NULL)
                <tr>
                    <td><strong>Website</strong></td>
                    <td><a href="{{$viewPickup->website}}">Visit {{$viewPickup->name}} Website</a></td>
                </tr>
                @endif            
            </tbody>
        </table>
    </div>
    </div>
</div>

<div class="col-md-11 mx-auto" style="border:1px solid #777; border-radius:10px; margin:10px; text-align:justify; padding:20px;">
    <div class="row">        
        @if($viewPickup->description!="")
            <h2 style="text-align: center;">About {{$viewPickup->name}}</h2>
            @php
                echo $viewPickup->description;
            @endphp
        @endif
    </div>
</div>

<div class="container-fluid mt-10" style="max-width: 90vw;" >
    <x-show-all-pickups :pickups='$pickups'/>
</div>

@endsection