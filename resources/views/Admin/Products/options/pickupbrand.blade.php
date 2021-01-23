@php
    $pagename="Pickup Brand"
@endphp
<style>
    button {
        margin: 0px;
    }
    table th tr td {
        padding-left: 2px;
    }
    .image_container img {
        width: 100%;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products / Pickups / Brands') }}
        </h2>
    </x-slot>
    <x-pickup-options-bar/>
    <div class="container mt-5 pb-5">
        <div class="row">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header h5">Pickup Brands</div>
                    <div class="card-body" style="">
                        <div class="row row-cols-1 row-cols-md-3 ">
                            @foreach ($pickup_brands as $pickup_brand)
                            <div class="col mb-4" style="max-width: 400px;"">
                                <div class="card h-100"  style="max-width: 350px;min-width:200px; max-height=200px; min-height:200px; border:1px solid rgba(0,0,0,.5);">
                                    <div class="image_container d-flex justify-content-center px-3" style="max-width: 350px;min-width:200px; max-height=200px; min-height:200px; ">
                                        <img class="align-self-center" src="{{asset($pickup_brand->brand_image)}}" alt="" style="max-height:200px;">
                                    </div>
                                    <div class="card-body" style=" color:#000; padding:0px;">
                                        <h5 class="card-title" style="text-align:center; margin:1px;">{{$pickup_brand->brand}}</h5>
                                    </div>
                                    <div class="button_group d-flex justify-content-center my-1">
                                        <a href="{{url('/products/pickups/brand/edit/'.$pickup_brand->id)}}" class="btn btn-sm btn-info mr-3">Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#<?php echo "modal".$pickup_brand->id;?>">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                                
                              </div>        
                            <!-- Modal -->
                            
                            @endforeach            
                        </div>
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
                        <form action="{{route('create.pickup.brand')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <x-pickup-create-form :pagename="$pagename"/>
                    </div>
                </div>
            

</x-app-layout>

<!-- Button trigger modal -->

{{--modal for each  pickup brand--}}
@foreach ($pickup_brands as $pup_brand)
  <!-- Modal -->
  <div class="modal fade" id="<?php echo "modal".$pup_brand->id;?>" tabindex="-1" aria-labelledby="<?php echo "label".$pup_brand->id;?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="<?php echo 'label'.$pup_brand->id;?>">Deleting {{$pup_brand->brand}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Are you sure you want to delete "{{$pup_brand->brand}}"?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <a href="{{url('/products/pickups/brand/trash/'.$pup_brand->id)}}" class="btn btn btn-danger">Delete</a>
        </div>
      </div>
    </div>
  </div>
    
@endforeach