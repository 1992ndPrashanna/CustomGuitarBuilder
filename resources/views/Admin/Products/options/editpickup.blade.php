<x-app-layout>
    {{-- 
        'brands','types','positions','activepassive','coverings','magnets'    
    --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products / Pickups / Add New Pickup') }}
        </h2>
    </x-slot>
    <x-pickup-options-bar/>
    @if(session('success'))
    <div class="alert alert-success alert-success fade show w-100" role="alert">
      {{session('success')}}
      <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>  
    @endif

        <div class="col-md-10 mx-auto" style="font-family: 'Source Sans Pro', sans-serif; font-size:20px;">
            <div class="card" >
                <div class="card-header">Editing</div>
                <div class="card-body">
                    <div class="col-md-8 mx-auto">
                        {{-- images uploaded --}}
                        <div class="row">
                            <h1 style="text-align: center;"> Uploaded Images</h1>
                        </div>
                        
                        @php
                            $img_array=explode(',',$edit->image_urls);
                            $loop_count=sizeof($img_array);
                            $i=0;
                        @endphp
                        <div class="row">
                        @for($i=0;$i<$loop_count-1;$i++)
                        <div class="col-md-3">         
                            <form action="{{url('/products/pickups/removeimage/'.$edit->id)}}" method="POST" enctype="multipart/form-data">
                                {{-- preview uploaded images --}}
                                @csrf
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="row">
                                    
                                    <div class="col-md-5">
                                        <input type="hidden" name="id" value="{{$edit->id}}">
                                        <input type="hidden" name="url" value="{{$img_array[$i]}}">
                                        <img src="{{asset($img_array[$i])}}" alt="">
                                    </div>
                                    
                                    
                                </div>
                                    
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-danger my-2">Remove</button>
                            </form>
                        </div>
                        @endfor
                    </div>
                        <hr>
                        {{-- edit other attributes --}}
                        <form action="{{url("/products/pickups/update/".$edit->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="my-4">
                                <label for="brand" class="form-label">Select Brand</label>
                                <select class="form-select form-select-lg" id="brand" name="brand">
                                    <option value="{{$edit->brand}}" selected>{{$edit->pickupBrand->brand}} - Currently Selected</option>
                                    @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->brand}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="my-4">
                                <label for="name" class="form-label">Current Pickup Name and Model</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$edit->name}}">
                            </div>

                            <div class="my-4">
                                <label for="position" class="form-label">Select Pickup Position</label>
                                <select name="position" id="position" class="form-select form-select-lg">
                                    <option value="{{$edit->position}}" selected>{{$edit->pickupPosition->type}} - Currently Selected</option>
                                    @foreach ($positions as $position)
                                    <option value="{{$position->id}}">{{$position->type}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="my-4">
                                <label for="type" class="form-label">Select Pickup Type</label>
                                <select name="type" id="type" class="form-select form-select-lg">
                                    <option value="{{$edit->type}}" selected>{{$edit->pickupType->type}} - Currently Selected</option>
                                    @foreach ($types as $type)
                                    <option value="{{$type->id}}">{{$type->type}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="my-4">
                                <label for="activepassive" class="form-label">Active or Passive Pickup</label>
                                <select name="activepassive" id="activepassive" class="form-select form-select-lg">
                                    <option value="{{$edit->active_passive}}" selected>{{$edit->activePassive->type}} - Currently Selected</option>
                                    @foreach ($activepassives as $activepassive)
                                    <option value="{{$activepassive->id}}" onchange="checkActivePassive()">{{$activepassive->type}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="my-4">
                                <label for="magnet" class="form-label">Pickup Magnet</label>
                                <select name="magnet" id="magnet" class="form-select form-select-lg" id="pickupMagnet">
                                    <option value="{{$edit->magnet_material}}" selected>{{$edit->pickupMagnet->type}} - Currently Selected</option>
                                    @foreach ($magnets as $magnet)
                                    <option value="{{$magnet->id}}">{{$magnet->type}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div id="notActiveOption">
                                <div class="my-4">
                                    <label for="conductors" class="form-label">Number of Conductors</label>
                                    <input type="text" class="form-control" id="conductors" name="conductors" value="{{$edit->conductors}}">
                                </div>
                            </div>

                            <div class="my-4">
                                <label for="strings" class="form-label">Strings</label>
                                <select name="strings" id="strings" class="form-select form-select-lg">
                                    <option value="{{$edit->strings}}">{{$edit->strings}} - Currently Selected</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>

                            <div class="my-4">
                                <label for="covering" class="form-label">Pickup Covering</label>
                                <select name="covering" id="covering" class="form-select form-select-lg">
                                    <option value="{{$edit->covering}}" selected>{{$edit->pickupCovering->type}}</option>
                                    @foreach ($coverings as $covering)
                                    <option value="{{$covering->id}}">{{$covering->type}}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- trix editor --}}
                            
                            <div class="my-2" style="font-size: 16px;">
                                <label for="description">Edit Description</label>
                                <input type="hidden" name="description" id="description" class="trix-description" value="{{$edit->description}}">
                                <trix-editor input="description" class="form-control" name></trix-editor>
                            </div>
                            
                            <div class="my-4">
                                <label for="images" class="form-label">Add More Image/s</label>
                                <input type="file" class="form-control" name="images[]" id="images" multiple>
                            </div>

                            <div class="my-4">
                                <label for="signature" class="form-label">Signature series?</label>
                                <select name="signature" id="signature" class="form-select form-select-lg">
                                    <option value="{{$edit->signatures_series}}" selected>{{$edit->signatures_series}} - Currently Selected</option>
                                    <option value="No" >No</option>
                                    <option value="Yes">Yes</option>
                                </select>
                            </div>

                            <div class="my-4">
                                <label for="signature" class="form-label">Signature Artists</label>
                                <input type="text" class="form-control" id="artists" name="artists" value="{{$edit->signature_artist}}">
                                <div id="signatureHelp" class="form-text" style="font-size: 14px;">Each artist's name should be separated by a comma.</div>
                            </div>

                            <div class="my-4">
                                <label for="website" class="form-label">Website</label>
                                <input type="text" class="form-control" name="website" id="website" value="{{$edit->website}}">
                            </div>

                            <div class="my-4">
                                <label for="price" class="form-label">Price (USD)</label>
                                <input type="text" class="form-control" name="price" id="price" value="{{$edit->price}}">
                            </div>

                            <div class="my-4">
                                <label for="stock" class="form-label">Stock</label>
                                <select name="stock" id="stock" class="form-select form-select-lg">
                                    <option value="{{$edit->stock}}" selected>{{$edit->stock}} - Currently Selected </option>
                                    <option value="In Stock" >In Stock</option>
                                    <option value="Out Of Stock">Out Of Stock</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-lg btn-success my-2">Update Pickup Information</button>
                            <button class="btn btn-lg btn-danger my-2">Cancel</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

  
<script type="text/javascript" src="{{URL::asset('js/trix.js')}}"></script>
</x-app-layout>





