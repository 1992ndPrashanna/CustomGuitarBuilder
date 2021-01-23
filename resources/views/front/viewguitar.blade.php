{{-- view guitar individually --}}
@extends('layouts.frontend')
    @section('title')
        {{$viewGuitar->topWood->type." Top ".$guitarModel}} - Sahana Guitars Made in Nepal
    @endsection

@section('content')

<style>
    body {
        scroll-behavior: smooth;
    }
    .carousel-item {
        height: 40rem;
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
        opacity: ;

    }
    .title {
        font-family: 'Bangers', cursive;
        color: #fff;
        text-shadow:
        -2px -2px 0 #000,
        2px -2px 0 #000,
        -2px 2px 0 #000,
        2px 2px 0 #000;  
    }

    .guitar-table {
        border:1px solid #000;
        border-radius: 25px;
    }

    table, th, td {
        border-bottom: 1px solid #dee2e6!important;
    }

</style>

@php
    $images_array=explode(",",$viewGuitar->image_urls);
    $length=sizeof($images_array);
    $description = $viewGuitar->model->description;
@endphp

{{-- <x-front-end-navigation-bar :pickups='$pickups' :pickupbrands="$pickup_brands" :models="$models"/> --}}
<div class="col-md-11 mx-auto" style="margin-top:100px;" >
    <div class="row">
        <div class="col-md-6">
            <div id="pickupImages" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    @for ($i = 0; $i < $length-1; $i++)
                    <li data-bs-target="#pickupImages" data-bs-slide-to="{{$i}}" class="active"></li>
                    @endfor               
                </ol>
                <div class="carousel-inner">
                    @for ($i = 0; $i < $length-1; $i++)
                    <div class="carousel-item @php if($i==0) echo "active"; @endphp" >
                        <div class="overlay-image" style="background-image: url({{asset($images_array[$i])}})"></div>
                        <div class="container">
                            <h1 class="title">{{$viewGuitar->topWood->type." Top - ".$guitarModel}}</h1>
                        </div>
                    </div>
                    @endfor
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
            {{-- end carousel --}}
        </div>
        <div class="col-md-6">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="description-tab" data-bs-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="specs-tab" data-bs-toggle="tab" href="#specs" role="tab" aria-controls="specs" aria-selected="false">Specification</a>
                </li>
               
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="home-tab" style="padding:20px;">
                    {{$description}}
                </div>
                <div class="tab-pane fade" id="specs" role="tabpanel" aria-labelledby="specs-tab">
                    {{-- guitar table --}}
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                   <b>Model</b>
                                </td>
                                <td>{{$viewGuitar->model->type}}</td>
                                <td><b>Frets</b></td>
                                <td>{{$viewGuitar->fret_count}}</td>
                            </tr>
                            <tr>
                                <td>
                                   <b>Body</b>
                                </td>
                                <td>{{$viewGuitar->bodyWood->type}}</td>
                                <td><b>Body Finish</b></td>
                                <td>{{$viewGuitar->bodyFinish->type}}</td>
                            </tr>
                            @if ($viewGuitar->top_wood!="" || $viewGuitar->top_wood!=NULL)
                            <tr>
                                <td>
                                   <b>Top</b>
                                </td>
                                <td>{{$viewGuitar->topWood->type}}</td>
                                <td><b>Top Finish</b></td>
                                <td>{{$viewGuitar->topFinish->type}}</td>
                            </tr> 
                            @endif
                            
                            <tr>
                                <td>
                                   <b>Neck</b>
                                </td>
                                <td colspan="3">{{$viewGuitar->neck_pieces." Piece, ".$viewGuitar->neckType->type.", "}}
                                @php
                                    echo $viewGuitar->neckWoods->neck_woods;
                                @endphp
                            </td>
                            </tr> 
                            <tr>
                                <td><b>Neck Finish</b></td>
                                <td>{{$viewGuitar->neckFinish->type}}</td>
                                <td><b>Fretboard</b></td>
                                <td>{{$viewGuitar->fretboardWood->type}}</td>
                            </tr>
                            <tr>
                                <td><b>Frets</b></td>
                                <td>{{$viewGuitar->fretsType->fretBrand->name." ".$viewGuitar->fretsType->type}}</td>
                                <td><b>Inlays</b></td>
                                <td>{{$viewGuitar->neckInlays->type}}</td>
                            </tr>
                            <tr>
                                <td><b>Custom Inlay</b></td>
                                @if ($viewGuitar->custom_inlay_option==0)
                                    <td>None</td>                                    
                                @else                                
                                    <td>
                                        {{$viewGuitar->customInlayOption->type." on 12th Fret"}}
                                    </td>                                    
                                @endif
                                <td><b>Fretboard Radius</b></td>
                                <td>{{$viewGuitar->fretRadius->type}}</td>
                            </tr>
                            <tr>                                
                                <td><b>Color and Finish</b></td>
                                @if ($viewGuitar->natural_finish!=0)
                                    <td>Clear Gloss Finish (natural finish)</td>
                                @elseif ($viewGuitar->standard_color!=0)
                                    <td>{{$viewGuitar->standardColor->type." Solid Color"}}</td>
                                @else 
                                    <td> {{$viewGuitar->transColor->type}}</td>
                                @endif
                                <td><b>Scale Length</b></td>
                                <td>{{$viewGuitar->scaleLength->type}}</td>
                            </tr>
                            <tr>
                                <td><b>Pickup Config</b></td>
                                <td>{{$viewGuitar->pickupConfiguration->type}}</td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: center;"><b>Pickups</b></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Neck Pickup</b>
                                </td>                                
                                    @if ($viewGuitar->neck_pickup==0)
                                        <td>N/A</td>
                                    @else
                                        <td>{{$viewGuitar->neckPickup->name}}</td>
                                    @endif
                                    <td>
                                        <b>Middle Pickup</b>
                                    </td>                                    
                                    @if ($viewGuitar->middle_pickup==0)
                                        <td>N/A</td>
                                    @else
                                        <td>{{$viewGuitar->middlePickup->name}}</td>
                                    @endif                                                                
                            </tr>
                            <tr>
                                <td>
                                    <b>Bridge Pickup</b>
                                </td>                                
                                    @if ($viewGuitar->bridge_pickup==0)
                                        <td>N/A</td>
                                    @else
                                        <td>{{$viewGuitar->bridgePickup->name}}</td>
                                    @endif 
                                <td>
                                </td>
                                <td>
                                </td>                                                            
                            </tr>
                            <tr>
                                <td>
                                    <b>Bridge</b>
                                </td>
                                <td colspan="1">
                                    {{$viewGuitar->guitarBridge->bridgeColor->type." ".$viewGuitar->guitarBridge->bridgeBrand->name." ".$viewGuitar->guitarBridge->bridgeType->type}}
                                </td>
                                <td><b>Electronics</b></td>
                                <td>{{$viewGuitar->guitarElectronics->type}}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>

              </div>
        </div>
    </div>
</div> {{-- end col-md-10 --}}

@endsection