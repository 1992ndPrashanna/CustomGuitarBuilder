@extends('layouts.frontend')
    @section('title')
        {{$modelName}} - Sahana Guitars Made in Nepal
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
            <h2 style="text-align: center;">All <i>{{$modelName}}</i> Guitars</h2>
        </div>  
        <div class="col-md-10 mx-auto">   
                   
            <div class="row row-cols-1 row-cols-md-3 g-4" >
                @foreach ($thisGuitarModel as $guitar)
                    @php
                      $images=explode(",",$guitar->image_urls);  
                    @endphp
                    <div class="col">
                        <div class="card" >
                            <a href="{{url($modelName.'/viewGuitar/'.$guitar->id)}}"><img src="{{asset($images[0])}}" class="card-img-top" alt=""></a>
                            <div class="card-body">
                            <a href="{{url($modelName.'/viewGuitar/'.$guitar->id)}}">
                                <h5 class="card-title" style="font-size: 15px;">{{$guitar->neck_pieces." Piece Neck"}}
                                
                                @if ($guitar->natural_finish!=0)
                                    <i>Natural Finish</i>
                                @elseif($guitar->standard_color!=0)
                                    <i>{{", ".$guitar->standardColor->type." "}}</i>
                                @elseif($guitar->translucent_color!=0)
                                    <i>{{", ".$guitar->transColor->type." "}}</i>
                                @endif    
                                {{", ".$guitar->topWood->type." Top "}}<b>{{$guitar->model->type." No. ".$guitar->id}}</b>{{" with ".$guitar->neckPickup->name}}                            

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