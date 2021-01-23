@php
    $name=$infoarray[2];
    $type=$infoarray[1];
    $create_route=$infoarray[0];
    if($type=="bridge"){
        $bridge_colors=$infoarray[3];
        $bridge_types=$infoarray[4];
        $bridge_scales=$infoarray[5]; 
    }
    else{
        $bridge_colors=array();
        $bridge_types=array();
        $bridge_scale=array();
    }

    
@endphp

<div class="col-md-11 mt-10 mx-auto">
    <div class="row">
        <div class="col-md-9">
            {{$alldata->links()}}
            <table class="table table-hover table-bordered my-2" style="text-align: center; width:100%;">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">{{$name}} Type</th>
                        <th scope="col">Brand</th>
                        @if($type=="bridge")
                            <th scope="col">Strings</th>
                            <th scope="col">Color</th>
                            <th scope="col">Scale</th>
                        @endif
                        
                        <th scope="col">Description</th>
                        <th scope="col" colspan="2">Actions</th>
                    </tr>
                    
                </thead>
                <tbody>
                    @foreach ($alldata as $data)
                        <tr>
                            @if ($type=="bridge")
                                <td>{{$data->bridgeType->type}}</td>
                                <td>{{$data->bridgeBrand->name}}</td>
                                <td>{{$data->strings}}</td>
                                <td>{{$data->bridgeColor->type}}</td>
                                <td>{{$data->bridgeScale->type}}</td>
                            @elseif($type=="tuners")
                                <td>{{$data->type}}</td>
                                <td>{{$data->tunerBrand->name}}</td>
                            @else
                                <td>{{$data->type}}</td>
                                <td>{{$data->fretBrand->name}}</td>
                            @endif
                            <td>{{$data->description}}</td>
                            <td><a href="{{url('/products/guitar/'.str_replace(" ","",$type).'/edit/'.$data->id)}}" class="btn btn-info btn-sm">Edit</a></td>           
                            <td><button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#{{'delete-'.$data->id}}">Delete</button></td>
                        </tr>

                        <div class="modal fade" id="{{'delete-'.$data->id}}" tabindex="-1" aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="">Delete {{$data->type}} Permanently?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <strong>{{$data->type}}</strong> will be permanenly deleted!
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <a href="{{url('/products/guitar/'.str_replace(" ","",$type).'/delete/'.$data->id)}}" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                   Create {{$name}}
                </div>
                <div class="card-body">
                    <form action="{{route($create_route)}}" method="POST" enctype=multipart/form-data>
                        @csrf
                        
                        @if($type=="frets")
                        <div class="mb-3">
                            <label for="type">{{$name}} Type</label>
                            <input type="text" class="form-control" name="type" id="type" placeholder="Enter type">
                        </div>
                        <label for="brand">{{$name}} Brand</label>
                            <div class="mb-3">
                                <select class="form-select" name="brand" id="brand" >
                                        <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        @if($type=="bridge")
                        <label for="brand">{{$name}} Scale</label>
                        <div class="mb-3">
                            <select class="form-select" name="scale" id="scale" >
                                    <option value="">Select Scale</option>
                                @foreach ($bridge_scales as $bridge_scale)
                                    <option value="{{$bridge_scale->id}}">{{$bridge_scale->type}}</option>
                                @endforeach
                            </select>
                        </div>
                                            
                        <label for="brand">{{$name}} Type</label>
                            <div class="mb-3">
                                <select class="form-select" name="type" id="type" >
                                        <option value="">Select Type</option>
                                    @foreach ($bridge_types as $bridge_type)
                                        <option value="{{$bridge_type->id}}">{{$bridge_type->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        
                        <label for="brand">{{$name}} Brand</label>
                            <div class="mb-3">
                                <select class="form-select" name="brand" id="brand" >
                                        <option value="">Select Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- color selector --}}                            
                            <label for="color">{{$name}} Color</label>
                            <div class="mb-3">
                                <select class="form-select" name="color" id="color" >
                                        <option value="">Select Color</option>
                                    @foreach ($bridge_colors as $color)
                                        <option value="{{$color->id}}">{{$color->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="strings">Strings</label>
                            <div class="mb-3">
                                <select class="form-select" name="strings" id="strings" >
                                        <option value="">Select no. of strings</option>

                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>

                                </select>
                            </div>
                        @endif
                        @if($type=="tuners")
                        <div class="mb-3">
                            <label for="type">{{$name}} Type</label>
                            <input type="text" class="form-control" name="type" id="type" placeholder="Enter type">
                        </div>
                        <label for="brand">{{$name}} Brand</label>
                            <div class="mb-3">
                                <select class="form-select" name="brand" id="brand" >
                                        <option value="">Select Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                        <button class="btn btn-lg btn-success">Create {{$name}}</button>
                    </form>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show w-100" role="alert" style="text-align: center;">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div> 
                    @elseif(session('failure')) 
                        <div class="alert alert-success alert-dismissible fade show w-100" role="alert" style="text-align: center;">
                            <strong>{{session('failure')}}</strong>
                            <button type="button" class="btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div> 
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-dismissible alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>