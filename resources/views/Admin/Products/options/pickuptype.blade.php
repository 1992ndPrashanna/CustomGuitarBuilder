@php
use App\Http\Controllers\PickupsController;
$pagename="Pickup Type";
$routename="create.pickup.type";
$pickup_type="";
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products /') }} @php
            echo PickupsController::getProductName()."s"." / ".$pagename;
            @endphp
        </h2>
    </x-slot>

    <x-pickup-options-bar />

    {{-- end options bar --}}

    {{-- load main page table and form --}}
    <div class="container my-5">

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <h5 class="card-header d-inline-flex  justify-content-between">{{$pagename}} <a href="{{url("/trashcan/#pickup_types")}}" class="btn btn-sm btn-danger py-0">View Trash</a></h5>
                    <div class="card-body" style="overflow-x:auto;">
                        <table class="table table-hover" style="overflow-x:auto;">
                            <thead class="thead-dark">
                                <tr>

                                    <th scope="col">Type</th>
                                    <th scope="col">Description</th>
                                    <th scope="col" colspan="2">Actions</th>
                                </tr>
                            </thead>
                            @foreach ($pickup_types as $pickup_type)
                            <tr>

                                <td><strong>{{$pickup_type->type}}</strong></td>
                                @if ($pickup_type->description!= NULL)
                                <td>{{$pickup_type->description}}</td>
                                @else
                                <td>--Description Not Available--</td>
                                @endif
                                <td><a href="{{url('/products/pickups/type/edit/'.$pickup_type->id)}}" class="btn btn-sm btn-dark">Edit</a></td>
                                <td><button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#<?php echo "Modal".$pickup_type->id;?>">
                                    Delete
                                  </button></td>
                                  
                                <!-- Modal -->
                                    <div class="modal fade" id="<?php echo "Modal".$pickup_type->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Delete "{{$pickup_type->type}}" ?</h5>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                            <a href="{{url('/products/pickups/type/trash/'.$pickup_type->id)}}" class="btn btn-sm btn-danger">Delete</a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                {{-- <td><a href="{{url('/products/pickups/type/trash/'.$pickup_type->id)}}" class="btn btn-sm btn-danger">Delete</a></td> --}}
                            </tr>
                            @endforeach
                            {{$pickup_types->links()}}
                        </table>
                    </div>
                </div>
            </div>
            {{-- add form --}}
            <div class="col-md-4  ">
                <div class="card">
                    <div class="card-header">
                        Add {{$pagename}}
                    </div>
                    <div class="card-body">
                        {{-- Add Product Form --}}
                        <form action="{{route('create.pickup.type')}}" method="POST">
                            @csrf

                            <x-pickup-create-form :pagename="$pagename" />
                            {{-- loaded from component above--}}
                    </div>
                </div>
                {{-- load alert bar --}}

</x-app-layout>

