@extends('layouts.frontend')

@section('title')
    {{$viewPickup->name}}
@endsection

@section('content')

<style>

</style>

@php

    $exploded_images_array=explode(",",$viewPickup->image_urls);
    $exploded_description=explode(".",$viewPickup->description);
    $length=sizeof($exploded_images_array);
    
@endphp

{{-- <x-front-end-navigation-bar :pickups='$pickups' :pickupbrands="$pickup_brands" :models="$models" /> --}}
<div class="container-fluid d-flex mx-auto" style="margin-top:100px; max-height:70vh; max-width:90hw; width:90vw;height:70vh" >


    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="width: 100%;height:100%;">
        <div class="carousel-inner" style="width: 100%;height:100%">

            <div class="carousel-item active" style="width:100%; height:100%; background-image:url('{{URL::asset($exploded_images_array[0])}}');object-fit:cover;">
                <img src="{{asset($exploded_images_array[0])}}" class="d-block w-100" alt="..." style="max-width:100%;max-height:100%;min-height:100%; object-fit:contain;backdrop-filter:blur(15px);">
            </div>

            @for($i=1;$i<$length-1;$i++) 
            <div class="carousel-item" style="width:100%; height:100%; background-image:url('{{URL::asset($exploded_images_array[$i])}}');object-fit:cover;">
                <img src="{{asset($exploded_images_array[$i])}}" class="d-block w-100" alt="..." style="max-width:100%;max-height:100%;min-height:100%; object-fit:contain;backdrop-filter:blur(15px);">
            </div>
            @endfor
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
</div>
<div class="container-fluid">
    <div class="display-5" style="width:100%;text-align:center;border-bottom:1px solid #dfe0e1;">
        {{-- Pickup Model --}}
            About {{$viewPickup->name}}
        {{-- badges --}}
        <div class="" style="font-size: 20px; margin:5px;">
            @if ($viewPickup->stock=="In Stock")
            <span class="badge rounded-pill bg-success">{{$viewPickup->stock}}</span>
            @else
            <span class="badge rounded-pill bg-danger">{{$viewPickup->stock}}</span>
            @endif

            @if ($viewPickup->signatures_series=="Yes")
                <span class="badge rounded-pill bg-info text-dark">Signature Series</span>
            @endif
            @if ($viewPickup->pickupBrand->brand=="Sahana")
            <span class="badge rounded-pill bg-info text-dark">Made In Nepal</span>
            @endif
        </div>      
    </div> 
</div>
<div class="container-fluid d-flex" style="margin-top:auto; max-height:50vh; max-width:90hw; width:90vw;height:50vh;" >   
    <table class="table" style="width: 95%;height:100%; text-align:left;  padding:0px;background-color:#fff;">
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
<style>

</style>

<div class="container-fluid mt-20">
    <div class="display-5 mx-auto" style="width:90vw;text-align:center;border-bottom:1px solid #dfe0e1;">
        Description
    </div>
    <div>
        @php
        echo '<table class="table table-light mx-auto" style="max-height:100%;height:100%; width:90vw; max-width:90vw; text-align:justify;margin:0px;padding:0px; background-color:#fff;"><tbody><tr><td class="description" style="background-color: #fff;">'.$viewPickup->description.'</td></tr></tbody></table>';
    @endphp
    </div>
</div>

<div class="display-5 mx-auto mt-5" style="width:90vw;text-align:center;">
    Related Products
</div>

<div class="container-fluid mt-10" style="max-width: 90vw;" >
    <x-show-all-pickups :pickups='$pickups'/>
</div>
@endsection