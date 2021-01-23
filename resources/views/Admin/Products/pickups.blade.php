@php
use app\http\controllers\PickupsController;
@endphp
<style>
table tr td {
        max-width: 400px;
        max-height:80px;
        overflow-x:hidden;
        overflow-y: hidden;
        padding:0px;
        margin:0px;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products /') }} @php
            echo PickupsController::getProductName()."s";
            @endphp
        </h2>
    </x-slot>

    <x-pickup-options-bar />

    <div class="container-sm my-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header d-flex justify-content-between">All Pickups List <a href="{{route('trashcan')}}" class="btn btn-sm btn-danger py-0 " style="margin: 0px;">View Trash</a></h5>
                    <div class="card-body" style="overflow-x:auto;">
                    <a href="{{route('create.pickup.form')}}" class="btn btn-lg btn-info" style="margin-bottom: 5px;">Add Pickup</a>
                        <table class="table table-hover table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Active/Passive</th>
                                    <th scope="col">Conductors</th>
                                    <th scope="col">Magnet</th>
                                    <th scope="col">Strings</th>
                                    <th scope="col">Coverings</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Images Preview</th>
                                    <th scope="col">Signature Series?</th>
                                    <th scope="col">Signature Artist(s)</th>
                                    <th scope="col">Website</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col" colspan="2">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($pickups as $pickup)
                                <tr>
                                    <td>{{$pickup->pickupBrand->brand}}</td>
                                    <td>{{$pickup->name}}</td>
                                    <td>{{$pickup->pickupPosition->type}}</td>
                                    <td>{{$pickup->pickupType->type}}</td>
                                    <td>{{$pickup->activePassive->type}}</td>
                                    <td>{{$pickup->conductors}}</td>
                                    <td>{{$pickup->pickupMagnet->type}}</td>
                                    <td>{{$pickup->strings}}</td>
                                    <td>{{$pickup->pickupCovering->type}}</td>
                                    <td>@if ($pickup->description!="")                                    
                                        {{substr($pickup->description,0,100)."..."}}
                                        @else 
                                            N/A
                                        @endif
                                    </td>
                                    {{-- load image previews --}}
                                    @php
                                        $url_list=explode(',',$pickup->image_urls);
                                        $i=0;
                                    @endphp
                                    <td>
                                    @foreach ($url_list as $url)
                                        @if ($url!="")
                                            <img src="{{asset($url)}}" width="50px" alt="">
                                        @endif 
                                    @endforeach
                                    </td>
                                    <td>{{$pickup->signatures_series}}</td>
                                    <td>{{$pickup->signature_artist}}</td>
                                    <td>{{$pickup->website}}</td>
                                    <td>{{$pickup->price}}</td>
                                    <td>{{$pickup->stock}}</td>
                                    <td><a href="{{url('/products/pickups/edit/'.$pickup->id)}}" class="btn btn-sm btn-info">Edit</a></td>
                                    <td><a href="{{url('/products/pickups/pickup/trash/'.$pickup->id)}}" class="btn btn-sm btn-danger">Delete</a></td>
                                </tr>
                                @endforeach

                            </tbody>
                            {{$pickups->links()}}
                        </table>

                    </div>
                </div>
            </div>
    </div>
    </div>
</x-app-layout>
