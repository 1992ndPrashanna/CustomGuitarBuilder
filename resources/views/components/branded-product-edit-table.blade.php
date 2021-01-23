@php
    $name=$infoarray[1];
    $type=$infoarray[0];

    if($type=="bridge"){
        $bridge_colors=$infoarray[2];
        $bridge_types=$infoarray[3];
        $bridge_scales=$infoarray[4]; 
    }
    else{
        $bridge_colors=array();
        $bridge_types=array();
        $bridge_scale=array();
    }
@endphp

<div class="container-fluid col-md-11 py-10">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card">
                <div class="card-header">
                   Create {{$name}}
                </div>
                <div class="card-body">
                    <form action="{{url('products/guitar/'.strtolower(str_replace(" ","",$type)).'/update/'.$edit->id)}}" method="POST" enctype=multipart/form-data>
                        @csrf
                        
                        @if($type=="bridge")
                        <label for="brand">{{$name}} Scale</label>
                        <div class="mb-3">
                            <select class="form-select" name="scale" id="scale" >
                                    <option value="{{$edit->scale}}" selected>{{$edit->bridgeScale->type}} - Selected</option>
                                @foreach ($bridge_scales as $bridge_scale)
                                    <option value="{{$bridge_scale->id}}">{{$bridge_scale->type}}</option>
                                @endforeach
                            </select>
                        </div>
                                            
                        <label for="brand">{{$name}} Type</label>
                            <div class="mb-3">
                                <select class="form-select" name="type" id="type" >
                                        <option value="{{$edit->type}}">{{$edit->bridgeType->type}} - Selected</option>
                                    @foreach ($bridge_types as $bridge_type)
                                        <option value="{{$bridge_type->id}}">{{$bridge_type->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        
                        <label for="brand">{{$name}} Brand</label>
                            <div class="mb-3">
                                <select class="form-select" name="brand" id="brand" >
                                        <option value="{{$edit->brand}}">{{$edit->bridgeBrand->name}} - Selected</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- color selector --}}                            
                            <label for="color">{{$name}} Color</label>
                            <div class="mb-3">
                                <select class="form-select" name="color" id="color" >
                                        <option value="{{$edit->color}}">{{$edit->bridgeColor->type}} - Selected</option>
                                    @foreach ($bridge_colors as $color)
                                        <option value="{{$color->id}}">{{$color->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="strings">Strings</label>
                            <div class="mb-3">
                                <select class="form-select" name="strings" id="strings" >
                                        <option value="{{$edit->strings}}">{{$edit->strings}} - Selected</option>

                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>

                                </select>
                            </div>
                        @endif
                        @if($type=="tuners")
                        <div class="mb-3">
                            <label for="type">{{$name}} Type</label>
                            <input type="text" class="form-control" name="type" id="type" value="{{$edit->type}}">
                        </div>
                        <label for="brand">{{$name}} Brand</label>
                            <div class="mb-3">
                                <select class="form-select" name="brand" id="brand" >
                                        <option value="{{$edit->type}}">{{$edit->tunerBrand->name}} - Selected</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label class="form-label" for="description">Add/Edit Description</label>
                            <textarea name="description" id="description" cols="30" rows="3" class="form-control" placeholder="<?php if($edit->description=="") echo 'Add Description'; else echo $edit->description;?>"></textarea>
                        </div>
                        <button class="btn btn-lg btn-success">Update {{$name}}</button>
                    </form>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show w-100" role="alert" style="text-align: center;">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>  
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>