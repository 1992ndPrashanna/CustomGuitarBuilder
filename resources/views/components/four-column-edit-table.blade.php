@php
    $name=$infoarray[1];
    $type=$infoarray[0];
@endphp

{{-- for "type, description" tables --}}

<div class="col-md-11 container-fluid mt-10">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card">
                <div class="card-header">
                    Edit {{$name}}
                </div>
                <div class="card-body">
                    <form action="{{url('/products/guitar/'.str_replace(" ","",$type).'/update/'.$edit->id)}}"  method="POST" @php
                        if($type=="custom inlay")
                            echo "enctype='multipart/form-data'";
                    @endphp>
                        @csrf
                        <div class="mb-3">
                            <label for="type" class="form-label">Edit {{$name}} Type</label>
                            <input class="form-control" type="text" name="type" id="type" value="{{$edit->type}}">
                        </div>
                        
                        @if($type=="payment options")
                        <div class="my-2" style="font-size: 16px;">
                            <label for="description">Enter Payment Options Details</label>
                            <input type="hidden" name="description" id="description" class="trix-description" value="{{$edit->description}}">
                            <trix-editor input="description" class="form-control" name></trix-editor>
                        </div>
                        
                        @elseif ($type!="payment options" || $type!="bridge color" && $type!="bridge scale" && $type!="bridge")
                            <div class="mb-3">
                                <label for="description" class="form-label">Edit Description</label>
                                <textarea name="description" id="description" cols="10" rows="3" class="form-control">{{$edit->description}}</textarea>
                            </div>
                        @endif
                        

                        @if ($type=="custom inlay")
                        <input type="hidden" name="old_image" value="{{$edit->images}}">
                        <div class="mb-3">
                            <label for="guitar_model">Model</label>
                            <select class="form-select" name="guitar_model" id="guitar_model">
                                <option value="{{$edit->model}}"> {{$edit->guitarModel->guitar_model}} - Selected</option>
                                @foreach ($guitarmodels as $guitar_model)
                                    <option value="{{$guitar_model->id}}">{{$guitar_model->guitar_model}}</option>
                                @endforeach
                            </select>
                        </div>
                            <label>Image Preview</label>
                            <div class="mb-3">
                                <img src="{{asset($edit->images)}}" alt="">
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Upload New {{$name}} Image (Optional)</label>
                                <input class="form-control" type="file" name="images" id="images">
                            </div>
                        @endif
                        {{-- end custom inlay --}}
                        <button class="btn btn-lg btn-success">Update {{$name}}</button>
                        <a href="{{url('/products/guitar/'.str_replace(" ","",$type))}}" class="btn btn-lg btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>