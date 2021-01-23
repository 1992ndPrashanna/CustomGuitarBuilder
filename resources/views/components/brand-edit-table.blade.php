@php
    $name=$infoarray[1];
    $type=$infoarray[0];

@endphp

<div class="container-fluid py-10">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card">
                <div class="card-header">Edit {{$name}}</div>
                <div class="card-body">
                    {{-- image display + remove image form --}}

                    @if($edit->image_urls!="")
                    <div class="my-5 container-fluid mx-auto">
                        <form action="{{url('/products/guitar/'.strtolower(str_replace(" ","",$type)).'/removeimage/'.$edit->id)}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div>
                                    <img src="{{asset($edit->image_urls)}}" width="200" alt="">
                                </div>
                            </div>
                            <button class="btn-sm btn-danger">Remove Image</button>
                        </form>
                    </div>
                    @else
                        <div class="card-body">
                            <div>
                                <img src="{{asset($edit->image_urls)}}" width="200" alt="">
                            </div>
                        </div>
                    @endif
                    <form action="{{url('/products/guitar/'.strtolower(str_replace(" ","",$type)).'/update/'.$edit->id)}}" method="POST" enctype='multipart/form-data'>
                        @csrf
                        <input type="hidden" name="old_image" value="{{$edit->image_urls}}">
                        <div class="mb-3">
                            <label for="name">Brand Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$edit->name}}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="brand_image">Select Image</label>
                            <input type="file" class="form-control" name="brand_image" id="brand_image">
                        </div>                
                        <button class="btn btn-lg btn-success">Update {{$name}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>