@php
use app\http\controllers\PickupTypeController;
use app\http\controllers\PickupActiveController;
use app\http\controllers\PickupCoveringController;
use app\http\controllers\PickupMagnetController;
use app\http\controllers\PickupPositionController;
use app\http\controllers\PickupBrandController;
@endphp


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products / Pickups / Edit Pickup Options') }}
        </h2>
    </x-slot>

    <x-pickup-options-bar />

    <div class="container">
        <div class="col-md-10 mx-auto mt-12">
            <div class="card">
                {{-- success message --}}
                @if(session('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                
                <h5 class="card-header">
                    Update {{$update->type}}
                </h5>
                <div class="card-body">

                    <form action="{{url('/products/pickups/'.$category.'/update/'.$update->id)}}" method="POST" 
                        @php
                            if ($category=="brand"){
                                echo 'enctype="multipart/form-data"';
                            }
                        @endphp
                        >
                        {{--NOTE: $category holds the pickup options like "type","covering","magnet","position" ,etc, which is returned with the view. Not to be confused with product category, or any such. This was done so same view can be used as update form for all pickup options.
                    TL;DR "$category" holds option names. 
                --}}
                        @csrf

                        

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name={{$category == "brand"? "brand":"type"}} id="type" value="{{$category == "brand"? $update->brand :$update->type}}">
                            </div>
                        </div>
                        @if ($category!="brand")   
                            <div class="form-group my-2">

                                <textarea class="form-control" name="description" rows="3">{{$update->description}}</textarea>

                            </div>
                        @endif
                        @if ($category == "brand")
                        {{-- old image name in hidden text input --}}
                        <input type="hidden" name="old_image" value="{{$update->brand_image}}">
                        <div class="form-group my-2">
                            <label for="brand_image" class="form-check-label">Upload New Brand Image</label>
                            <input type="file" class="form-control" name="brand_image" id="brand_image">
                        </div>   
                        <div class="form-group m-5">
                            <img src="{{asset($update->brand_image)}}" width="100px" alt="">
                        </div>
                        @endif
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update {{$update->type}}</button>
                                <a href="{{url()->previous()}}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                    {{-- End Form --}}
                    {{-- Delete Image Button --}}
                    @if(session('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{session('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    {{-- eror message --}}


                @error('type')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
                @error('description')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
                @error('brand')
                    <div class="text-danger">
                    {{$message}}
                    </div>
                @enderror
                @error('brand_image')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        {{-- end card --}}



    </div>
    </div>
</x-app-layout>
