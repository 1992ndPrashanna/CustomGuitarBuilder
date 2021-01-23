@php
    $name=$infoarray[1];
    $type=$infoarray[0];
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
                        <div class="mb-3">
                            <label for="type">{{$name}} Type</label>
                            <input type="text" class="form-control" name="type" id="type" value="{{$edit->type}}">
                        </div>
                        <label for="brand">{{$name}} Brand</label>
                            <div class="mb-3">
                                <select class="form-select" name="brand" id="brand">
                                        <option value="{{$edit->brand}}">{{$edit->fretBrand->name}} - Selected</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
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