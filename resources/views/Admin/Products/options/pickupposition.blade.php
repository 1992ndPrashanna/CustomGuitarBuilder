@php
use App\Http\Controllers\PickupsController;
$pagename="Pickup Position";
$routename="'create.pickup.position'";
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products /') }} @php
            echo PickupsController::getProductName()."s / ".$pagename;
            @endphp
        </h2>
    </x-slot>

    <x-pickup-options-bar />

    <div class="container my-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <h5 class="card-header d-flex justify-content-between">{{$pagename}}<a href="{{url("/trashcan/#pickup_positions")}}" class="btn btn-sm btn-danger py-0">View Trash</a> </h5>
                    <div class="card-body" style="overflow-x:auto;">
                        <table class="table table-hover" style="overflow-x:auto;">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Position</th>
                                    <th scope="col">Description</th>
                                    <th scope="col" colspan="2">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($pickup_positions as $pickup_position)
                                <tr>

                                    <td><strong>{{$pickup_position->type}}</strong></td>
                                    @if ($pickup_position->description!= NULL)
                                    <td>{{$pickup_position->description}}</td>
                                    @else
                                    <td>N/A</td>
                                    @endif
                                    <td><a href="{{url('/products/pickups/position/edit/'.$pickup_position->id)}}" class="btn btn-sm btn-dark">Edit</a></td>
                                    <td><a href="{{url('/products/pickups/position/trash/'.$pickup_position->id)}}" class="btn btn-sm btn-danger">Delete</a></td>

                                </tr>
                                @endforeach

                            </tbody>
                            {{$pickup_positions->links()}}
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
                        <form action="{{route('create.pickup.position')}}" method="POST">
                            @csrf

                            <x-pickup-create-form :pagename="$pagename" />
                            {{-- loaded from component above--}}

                    </div>
                </div>
</x-app-layout>
