@php
use App\Http\Controllers\PickupsController;
$pagename="Active or Passive Pickups";
$routename='create.active.passive';

@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products /') }} @php
            echo PickupsController::getProductName()."s"." / ". $pagename;
            @endphp
        </h2>
    </x-slot>

    <x-pickup-options-bar />

    <div class="container my-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <h5 class="card-header d-flex justify-content-between">{{$pagename}} <a href="{{url('trashcan/#active_passive')}}" class="btn btn-sm btn-danger py-0">View Trash</a></h5>
                    <div class="card-body">
                        <table class="table table-hover" style="overflow-x:auto;">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Type</th>
                                    <th scope="col">Description</th>
                                    <th scope="col" colspan="2">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($active_passives as $active_passive)
                                <tr>
                                    <td><strong>{{$active_passive->type}}</strong></td>
                                    @if ($active_passive->description!= NULL)
                                    <td>{{$active_passive->description}}</td>
                                    @else
                                    <td>N/A</td>
                                    @endif
                                    <td><a href="{{url('/products/pickups/activepassive/edit/'.$active_passive->id)}}" class="btn btn-sm btn-dark">Edit</a></td>
                                    <td><a href="{{url('/products/pickups/activepassive/trash/'.$active_passive->id)}}" class="btn btn-sm btn-danger">Delete</a></td>
                                </tr>
                                @endforeach

                            </tbody>
                            {{$active_passives->links()}}
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
                        <form action="{{route('create.active.passive')}}" method="POST">
                            @csrf

                            <x-pickup-create-form :pagename="$pagename" />
                            {{-- loaded from component above--}}
                    </div>
                </div>
</x-app-layout>
