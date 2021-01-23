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
    <style>
        ul { 
        list-style-type: disc; 
        list-style-position: inside; 
        }
        ol { 
        list-style-type: decimal; 
        list-style-position: inside; 
        }
        ul ul, ol ul { 
        list-style-type: circle; 
        list-style-position: inside; 
        margin-left: 15px; 
        }
        ol ol, ul ol { 
        list-style-type: lower-latin; 
        list-style-position: inside; 
        margin-left: 15px; 
        }
        trix-toolbar .trix-button-group--file-tools {
            display: none;
            }

        
    </style>

    @if(session('success'))
    <div class="alert alert-success alert-success fade show w-100" role="alert">
      {{session('success')}}
      <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>  
    @endif

        <div class="col-md-10 mx-auto" style="font-family: 'Source Sans Pro', sans-serif; font-size:20px;">
            <div class="card" >
                <div class="card-header" >Create Pickup</div>
                <div class="card-body">
                    <div class="col-md-8 mx-auto">
                        <form action="{{route('create.pickup')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="my-4">
                                <label for="brand" class="form-label">Select Brand</label>
                                <select class="form-select form-select-lg" id="brand" name="brand">
                                    <option value="" selected>View brands</option>
                                    @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->brand}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="my-4">
                                <label for="name" class="form-label">Pickup Name and Model</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>

                            <div class="my-4">
                                <label for="position" class="form-label">Select Pickup Position</label>
                                <select name="position" id="position" class="form-select form-select-lg">
                                    <option value="" selected>Click to view positions</option>
                                    @foreach ($positions as $position)
                                    <option value="{{$position->id}}">{{$position->type}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="my-4">
                                <label for="type" class="form-label">Select Pickup Type</label>
                                <select name="type" id="type" class="form-select form-select-lg">
                                    <option value="" selected>Click to view types</option>
                                    @foreach ($types as $type)
                                    <option value="{{$type->id}}">{{$type->type}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="my-4">
                                <label for="activepassive" class="form-label">Active or Passive Pickup</label>
                                <select name="activepassive" id="activepassive" class="form-select form-select-lg">
                                    <option value="" selected>Is pickup active or passive?</option>
                                    @foreach ($activepassives as $activepassive)
                                    <option value="{{$activepassive->id}}" onchange="checkActivePassive()">{{$activepassive->type}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div id="activePickupOptions">

                            </div>

                            <div class="my-4">
                                <label for="magnet" class="form-label">Pickup Magnet</label>
                                <select name="magnet" id="magnet" class="form-select form-select-lg" id="activePassive">
                                    <option value="" selected>Click to view pickup magnets</option>
                                    @foreach ($magnets as $magnet)
                                    <option value="{{$magnet->id}}">{{$magnet->type}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div id="notActiveOption">
                                <div class="my-4">
                                    <label for="conductors" class="form-label">Number of Conductors</label>
                                    <input type="text" class="form-control" id="conductors" name="conductors">
                                </div>
                            </div>

                            <div class="my-4">
                                <label for="strings" class="form-label">Strings</label>
                                <select name="strings" id="strings" class="form-select form-select-lg">
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>

                            <div class="my-4">
                                <label for="covering" class="form-label">Pickup Covering</label>
                                <select name="covering" id="covering" class="form-select form-select-lg">
                                    <option value="" selected>Click to view pickup coverings</option>
                                    @foreach ($coverings as $covering)
                                    <option value="{{$covering->id}}">{{$covering->type}}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- trix editor --}}
                            
                            <div class="my-2" style="font-size: 16px;">
                                <label for="description">Enter Pickup Description</label>
                                <input type="hidden" name="description" id="description" class="trix-description" value="">
                                <trix-editor input="description" class="form-control" name></trix-editor>
                            </div>
                            
                            <div class="my-4">
                                <label for="images" class="form-label">Select Image/s</label>
                                <input type="file" class="form-control" name="images[]" id="images" multiple>
                            </div>

                            <div class="my-4">
                                <label for="signature" class="form-label">Signature series?</label>
                                <select name="signature" id="signature" class="form-select form-select-lg">
                                    <option value="No" selected>No</option>
                                    <option value="Yes">Yes</option>
                                </select>
                            </div>

                            <div class="my-4">
                                <label for="signature" class="form-label">Signature Artists</label>
                                <input type="text" class="form-control" id="artists" name="artists" placeholder="Eg: Artist1, Artist2, Artist3">
                                <div id="signatureHelp" class="form-text" style="font-size: 14px;">Each artist's name should be separated by a comma.</div>
                            </div>

                            <div class="my-4">
                                <label for="website" class="form-label">Website</label>
                                <input type="text" class="form-control" name="website" id="website">
                            </div>

                            <div class="my-4">
                                <label for="price" class="form-label">Price (USD)</label>
                                <input type="text" class="form-control" name="price" id="price">
                            </div>

                            <div class="my-4">
                                <label for="stock" class="form-label">Stock</label>
                                <select name="stock" id="stock" class="form-select form-select-lg">
                                    <option value="In Stock" selected>In Stock</option>
                                    <option value="Out Of Stock">Out Of Stock</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-lg btn-success my-2">Add Pickup</button>
                            <button class="btn btn-lg btn-danger my-2">Cancel</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
  
{{-- <script type="text/javascript" src="{{URL::asset('js/trix.js')}}"></script> --}}
</x-app-layout>





